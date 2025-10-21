<style>
    .header {
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 10px 0;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* تنسيق الشعار */
    .logo a {
        font-size: 24px;
        font-weight: bold;
        color: #333333;
        text-decoration: none;
    }

    /* تنسيق قسم الإجراءات (الإحصائيات، الرسائل، التنبيهات) */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    /* تنسيق الإحصائيات، الرسائل، التنبيهات */
    .statistics,
    .messages,
    .notifications {
        position: relative;
    }

    .statistics-link,
    .messages-link,
    .notifications-link {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #555555;
        text-decoration: none;
    }

    .statistics-link:hover,
    .messages-link:hover,
    .notifications-link:hover {
        color: #007bff;
    }

    .statistics-count,
    .messages-count,
    .notifications-count {
        background-color: #ff4d4d;
        color: #ffffff;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 50%;
        position: absolute;
        top: -8px;
        right: -8px;
    }

    /* تنسيق صورة المستخدم */
    .user-profile .user-link {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #333333;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-name {
        font-size: 16px;
    }

    .messages-dropdown,
    .notifications-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        display: none;
        z-index: 1000;
    }

    .messages-dropdown.show,
    .notifications-dropdown.show {
        display: block;
    }

    .dropdown-content {
        padding: 10px;
        width: 100%;
    }

    .dropdown-content a {
        display: block;
        padding: 8px 16px;
        color: #333333;
        text-decoration: none;
    }

    .dropdown-content a:hover {
        background-color: #f8f9fa;
    }

    .fas {
        font-size: 30px;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
<!-- Sidebar -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <!-- العنوان أو الشعار -->
            <div class="logo">
                <a href="#">Shipper Dashboard</a>
            </div>

            <!-- قسم الإحصائيات والرسائل والتنبيهات -->
            <div class="header-actions">
                <!-- الإحصائيات -->
                <div class="statistics">
                    <a href="#" class="statistics-link">
                        <i class="fas fa-chart-line"></i>
                        <span class="statistics-count">5</span>
                    </a>
                </div>

                <!-- الرسائل -->
                <div class="messages">
                    <a href="#" class="messages-link">
                        <i class="fas fa-envelope"></i>
                        <span class="messages-count">3</span>
                    </a>
                </div>

                <!-- التنبيهات -->
                <div class="notifications">
                    <a href="#" class="notifications-link">
                        <i class="fas fa-bell"></i>
                        <span class="notifications-count">2</span>
                    </a>
                </div>

                {{-- <!-- صورة المستخدم -->
                <div class="user-profile">
                    <a href="#" class="user-link">
                        <img src="user-avatar.jpg" alt="User Avatar" class="user-avatar">
                        @php
                            $namelast = explode(' ', auth('shipper')->user()->name);
                        @endphp

                        <span class="user-name">{{ $namelast }}</span>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</header>
