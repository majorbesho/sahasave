import http from 'k6/http';
import { check, sleep } from 'k6';

export const options = {
    // Simulating typical traffic
    vus: 10,
    duration: '15s',
    thresholds: {
        http_req_duration: ['p(95)<2000'], // 95% of requests must complete below 2s
    },
};

export default function () {
    // Assuming local server on port 8000. Change this if your server is elsewhere.
    const BASE_URL = 'http://127.0.0.1:8000';

    // 1. Homepage (Cached Featured Doctors)
    const resHome = http.get(BASE_URL + '/');
    check(resHome, {
        'Home status is 200': (r) => r.status === 200,
    });

    // 2. Medical Centers (Cached Cities & Specialties)
    const resCenters = http.get(BASE_URL + '/medical-centers');
    check(resCenters, {
        'Centers status is 200': (r) => r.status === 200,
    });

    sleep(1);
}
