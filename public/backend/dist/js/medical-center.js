// ملف JavaScript الخاص بلوحة تحكم المركز الطبي

$(document).ready(function () {
    // تهيئة جميع أدوات Select2
    $('.select2').select2({
        dir: "rtl",
        language: {
            noResults: function () {
                return "لم يتم العثور على نتائج";
            }
        }
    });

    // إدارة حالة تذكرني في الجداول
    $('table').on('change', '.select-all', function () {
        var isChecked = $(this).prop('checked');
        $(this).closest('table').find('.select-row').prop('checked', isChecked);
    });

    // إظهار/إخفاء الأقسام
    $('.toggle-section').click(function () {
        var target = $(this).data('target');
        $(target).slideToggle();
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
    });

    // تأكيد الحذف
    $('.delete-confirm').click(function (e) {
        if (!confirm('هل أنت متأكد من الحذف؟ لا يمكن التراجع عن هذا الإجراء.')) {
            e.preventDefault();
        }
    });

    // تحديث الإحصائيات تلقائياً كل دقيقة
    function updateDashboardStats() {
        $.ajax({
            url: '/medical-center/dashboard/stats',
            type: 'GET',
            success: function (data) {
                // تحديث البطاقات
                $('#total-doctors').text(data.total_doctors);
                $('#today-appointments').text(data.today_appointments);
                $('#monthly-revenue').text(data.monthly_revenue.toLocaleString());
                $('#pending-appointments').text(data.pending_appointments);
            }
        });
    }

    // تحديث الإحصائيات كل 60 ثانية
    setInterval(updateDashboardStats, 60000);

    // البحث الفوري
    var searchTimeout;
    $('.live-search').keyup(function () {
        clearTimeout(searchTimeout);
        var searchTerm = $(this).val();
        var table = $(this).data('table');

        searchTimeout = setTimeout(function () {
            filterTable(searchTerm, table);
        }, 500);
    });

    function filterTable(searchTerm, tableId) {
        var table = $('#' + tableId);
        var rows = table.find('tbody tr');

        rows.hide();

        rows.filter(function () {
            var text = $(this).text().toLowerCase();
            return text.indexOf(searchTerm.toLowerCase()) > -1;
        }).show();
    }
});

// وظائف عامة
function toggleStatus(url, id, currentStatus, element) {
    var newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    var action = currentStatus === 'active' ? 'تعطيل' : 'تفعيل';

    if (confirm('هل تريد ' + action + ' هذا العنصر؟')) {
        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                status: newStatus
            },
            success: function (response) {
                if (response.success) {
                    // تحديث الزر
                    var icon = element.find('i');
                    if (newStatus === 'active') {
                        element.removeClass('btn-danger').addClass('btn-success');
                        icon.removeClass('fa-ban').addClass('fa-check');
                        element.attr('title', 'تعطيل');
                    } else {
                        element.removeClass('btn-success').addClass('btn-danger');
                        icon.removeClass('fa-check').addClass('fa-ban');
                        element.attr('title', 'تفعيل');
                    }

                    // تحديث البادج
                    element.closest('tr').find('.status-badge')
                        .removeClass('bg-success bg-danger')
                        .addClass('bg-' + (newStatus === 'active' ? 'success' : 'danger'))
                        .text(newStatus === 'active' ? 'نشط' : 'غير نشط');
                }
            }
        });
    }
}

// تصدير البيانات
function exportData(format) {
    var filters = getCurrentFilters();
    filters.format = format;

    window.location.href = '/medical-center/export?' + $.param(filters);
}

function getCurrentFilters() {
    var filters = {};
    $('.filter-input').each(function () {
        if ($(this).val()) {
            filters[$(this).attr('name')] = $(this).val();
        }
    });
    return filters;
}