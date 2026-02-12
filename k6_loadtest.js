import http from 'k6/http';
import { check, sleep } from 'k6';
import { randomIntBetween } from 'https://jslib.k6.io/k6-utils/1.2.0/index.js';
import { parseHTML } from 'k6/html';

// بيانات وهمية محدثة بناءً على قاعدة البيانات
const doctorSchedules = {
    '2': 1,
    '5': 19,
    '6': 37,
    '7': 55,
    '8': 73
};
const doctorIds = Object.keys(doctorSchedules);

export let options = {
    scenarios: {
        constant_arrival_rate: {
            executor: 'constant-arrival-rate',
            rate: 2,
            timeUnit: '1s',
            duration: '30s',
            preAllocatedVUs: 2,
            maxVUs:40,
        },
    },
    thresholds: {
        http_req_failed: ['rate<0.01'],
        http_req_duration: ['p(95)<3000'],
    },
};

// دالة لجلب الـ CSRF token
function extractCsrfToken(response) {
    const doc = parseHTML(response.body);
    let token = doc.find('meta[name="csrf-token"]').attr('content');
    if (!token) {
        token = doc.find('input[name="_token"]').attr('value');
    }
    return token;
}

export default function () {
    const baseUrl = 'http://127.0.0.1:8000';

    // 1. تسجيل الدخول
    let res = http.get(`${baseUrl}/login`);
    let csrfToken = extractCsrfToken(res);

    res = http.post(`${baseUrl}/login`, {
        email: 'patient@gmail.com',
        password: '11111111',
        _token: csrfToken,
    });

    check(res, {
        'Logged in successfully': (r) => r.status === 200 || r.url.includes('/dashboard') || r.url.includes('/patient/dashboard'),
    });

    if (res.status !== 200 && !res.url.includes('/dashboard')) {
        console.log('Login failed');
        return;
    }

    // تحديث الـ token بعد تسجيل الدخول (أحياناً يتغير الـ session)
    csrfToken = extractCsrfToken(res);

    const doctorId = doctorIds[randomIntBetween(0, doctorIds.length - 1)];
    const scheduleId = doctorSchedules[doctorId];

    // تاريخ مستقبلي
    const futureDate = new Date();
    futureDate.setDate(futureDate.getDate() + randomIntBetween(1, 7));
    const date = futureDate.toISOString().split('T')[0];

    // أوقات عشوائية (يجب أن تتوافق مع منطق الـ slots)
    const times = ['09:00', '10:30', '14:00', '15:30', '17:00'];
    const time = times[randomIntBetween(0, times.length - 1)];

    // 2. جلب صفحة الحجز (الخطوة الثانية) لاستخراج الـ token والتأكد من الوصول
    const bookingPageRes = http.get(`${baseUrl}/appointments/checkout/${scheduleId}_${date.replace(/-/g, '')}_${time.replace(':', '')}`);

    check(bookingPageRes, {
        'Checkout page loaded': (r) => r.status === 200,
    });

    if (bookingPageRes.status === 200) {
        const storeCsrfToken = extractCsrfToken(bookingPageRes);

        // 3. إرسال طلب الحجز (POST)
        const payload = {
            doctor_id: doctorId,
            schedule_id: scheduleId,
            appointment_date: date,
            appointment_time: time,
            appointment_for: 'self',
            reason: `Automated load test booking from VU ${__VU}`,
            has_insurance: '0',
            _token: storeCsrfToken,
        };

        const headers = {
            'X-CSRF-TOKEN': storeCsrfToken,
            'Accept': 'application/json',
        };

        const bookingRes = http.post(`${baseUrl}/appointments/store`, payload, { headers: headers });

        check(bookingRes, {
            'Booking endpoint reached': (r) => r.status === 200 || r.status === 302,
            'Booking success redirect': (r) => r.url.includes('/confirmation'),
        });
    }

    // 4. اختبار البحث (لرفع الحمل)
    const searchRes = http.get(`${baseUrl}/doctors/search?search=Dr&location=&date=`);

    check(searchRes, {
        'Search page loaded': (r) => r.status === 200,
    });

    sleep(randomIntBetween(1, 2));
}
