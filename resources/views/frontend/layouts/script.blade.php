<!-- Vendor JS -->

{{-- <script src="{{ asset('4/assets/js/jquery-3.6.0.min.js') }}"></script> --}}
<script src="{{ asset('4/assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Bootstrap Bundle JS -->
<script src="{{ asset('frontend/xx/assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Feather Icon JS -->
<script src="{{ asset('frontend/xx/assets/js/feather.min.js') }}"></script>

<!-- select JS -->
<script src="{{ asset('frontend/xx/assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- Datepicker JS -->
<script src="{{ asset('frontend/xx/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('frontend/xx/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Owl Carousel JS -->
<script src="{{ asset('frontend/xx/assets/js/owl.carousel.min.js') }}"></script>

<!-- Counter JS -->
<script src="{{ asset('frontend/xx/assets/js/counter.js') }}"></script>

<!-- Animation JS -->
<script src="{{ asset('frontend/xx/assets/js/aos.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('frontend/xx/assets/js/script.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
</script>
<script>
    // JavaScript to toggle the dropdown
    function toggleDropdown(event) {
        event.preventDefault(); // Prevent the default link behavior
        const dropdownContent = event.target.nextElementSibling;
        dropdownContent.classList.toggle("showx");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropdownx a')) {
            const dropdowns = document.querySelectorAll(".dropdown-contentx");
            dropdowns.forEach(dropdown => {
                if (dropdown.classList.contains("showx")) {
                    dropdown.classList.remove("showx");
                }
            });
        }
    };
</script>
<script>
    function toggleDropdown() {
        document.querySelector('.options').style.display =
            document.querySelector('.options').style.display === 'block' ? 'none' : 'block';
    }

    function changeLanguage(lang) {
        window.location.href = "{{ route('language', '') }}/" + lang;
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // التحقق من تحميل jQuery أولاً
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded');
            return;
        }

        // تهيئة datetimepicker مع إعدادات محسنة
        $('.datetimepicker').datetimepicker({
            format: 'Y-m-d H:i',
            minDate: 0,
            step: 30,
            defaultTime: '09:00',
            validateOnBlur: false,
            scrollInput: false
        });

        // تحسين تجربة البحث
        const searchForm = document.querySelector('.search-box-one form');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                const searchInput = this.querySelector('input[name="search"]');
                if (!searchInput.value.trim()) {
                    e.preventDefault();
                    searchInput.focus();
                    // إضافة تأثير visual للتنبيه
                    searchInput.style.border = '2px solid #ff4757';
                    setTimeout(() => {
                        searchInput.style.border = '';
                    }, 2000);
                }
            });
        }
    });
</script>


</body>
<!-- template js -->
