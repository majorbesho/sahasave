<div class="footer-one__bottom-text">
    <p>© Copyright 2025 <a href="{{ route('home') }}">SahaSave.com .</a> All Rights Reserved</p>
</div>

<script src="{{ asset('4/dashboard/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('4/dashboard/assets/js/fonts.js') }}"></script>
<script src="{{ asset('4/dashboard/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('4/dashboard/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('4/dashboard/assets/js/wow.min.js') }}"></script>
<script>
    new WOW().init();
</script>
<script src="{{ asset('4/dashboard/assets/js/dashboard.js') }}"></script>
<script>
    // إضافة قائمة منسدلة للرسائل
    const messagesLink = document.querySelector('.messages-link');
    const messagesDropdown = document.createElement('div');
    messagesDropdown.className = 'messages-dropdown';
    messagesDropdown.innerHTML = `
    <div class="dropdown-content">
        <a href="#">رسالة جديدة 1</a>
        <a href="#">رسالة جديدة 2</a>
        <a href="#">رسالة جديدة 3</a>
    </div>
`;
    messagesLink.appendChild(messagesDropdown);

    messagesLink.addEventListener('click', (e) => {
        e.preventDefault();
        messagesDropdown.classList.toggle('show');
    });

    // إضافة قائمة منسدلة للتنبيهات
    const notificationsLink = document.querySelector('.notifications-link');
    const notificationsDropdown = document.createElement('div');
    notificationsDropdown.className = 'notifications-dropdown';
    notificationsDropdown.innerHTML = `
    <div class="dropdown-content">
        <a href="#">تنبيه جديد 1</a>
        <a href="#">تنبيه جديد 2</a>
    </div>
`;
    notificationsLink.appendChild(notificationsDropdown);

    notificationsLink.addEventListener('click', (e) => {
        e.preventDefault();
        notificationsDropdown.classList.toggle('show');
    });
</script>
