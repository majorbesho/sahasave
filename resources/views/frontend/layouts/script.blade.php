<!-- Vendor JS -->


<!-- في نهاية body قبل </body> -->

<!-- jQuery (مرة واحدة فقط) -->
<script src="{{ asset('frontend/xx/assets/js/jquery-3.7.1.min.js') }}"></script>

<!-- Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>

<!-- المكتبات الأخرى (مرة واحدة) -->
<script src="{{ asset('frontend/xx/assets/js/feather.min.js') }}"></script>
<script src="{{ asset('frontend/xx/assets/js/slick.js') }}"></script>
<script src="{{ asset('frontend/xx/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('frontend/xx/assets/js/aos.js') }}"></script>
<script src="{{ asset('frontend/xx/assets/js/owl.carousel.min.js') }}"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- DateTimePicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

<!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Custom Scripts -->
<script src="{{ asset('frontend/xx/assets/js/script.js') }}"></script>

<!-- كود البحث المخصص -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // كود البحث في الـ Header
        const searchToggle = document.querySelector('.searchbar a');
        const searchBox = document.querySelector('.togglesearch');

        if (searchToggle && searchBox) {
            const searchStyles = `
            .togglesearch {
                position: absolute;
                top: 100%;
                right: 0;
                width: 300px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 15px;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: all 0.3s ease;
                z-index: 1000;
            }
            .togglesearch.show {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            .togglesearch .input-group {
                display: flex;
                gap: 10px;
            }
            .togglesearch .form-control {
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                padding: 10px 15px;
                flex: 1;
            }
            .togglesearch .btn {
                background: #007bff;
                color: white;
                border: none;
                border-radius: 8px;
                padding: 10px 20px;
                cursor: pointer;
            }
        `;

            const styleSheet = document.createElement('style');
            styleSheet.textContent = searchStyles;
            document.head.appendChild(styleSheet);

            searchToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                searchBox.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (!searchBox.contains(e.target) && !searchToggle.contains(e.target)) {
                    searchBox.classList.remove('show');
                }
            });

            searchBox.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // تهيئة datetimepicker
        if (typeof jQuery !== 'undefined' && jQuery.fn.datetimepicker) {
            $('.datetimepicker').datetimepicker({
                format: 'Y-m-d H:i',
                minDate: 0,
                step: 30,
                defaultTime: '09:00',
                validateOnBlur: false,
                scrollInput: false
            });
        }

        // تحسين تجربة البحث في الـ Hero
        const searchForm = document.querySelector('.search-box-one form');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                const searchInput = this.querySelector('input[name="search"]');
                if (searchInput && !searchInput.value.trim()) {
                    e.preventDefault();
                    searchInput.focus();
                    searchInput.style.border = '2px solid #ff4757';
                    setTimeout(() => {
                        searchInput.style.border = '';
                    }, 2000);
                }
            });
        }

        // دالة تغيير اللغة
        window.changeLanguage = function(lang) {
            window.location.href = "{{ url('language') }}/" + lang;
        };
    });
</script>
