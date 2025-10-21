@extends('broker.minlayout.master')


@section('content')

    <style>
        .chat-sec {
            display: flex;
            height: calc(100vh - 150px);
        }

        .left-sidebar {
            width: 350px;
            border-right: 1px solid #eee;
        }

        .chat-messages {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .chat-footer {
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .empty-chat {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .empty-chat-content {
            text-align: center;
        }

        .empty-chat-content i {
            font-size: 50px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .avatar-online::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background-color: #4CAF50;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .user-list-item {
            border-bottom: 1px solid #f5f5f5;
            transition: all 0.3s;
        }

        .user-list-item:hover {
            background-color: #f9f9f9;
        }

        .new-message-count {
            background-color: #7367F0;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .chats-right .message-content {
            background-color: #7367F0;
            color: white;
            border-radius: 10px 10px 0 10px;
        }

        .message-content {
            padding: 10px 15px;
            background-color: #f5f5f5;
            border-radius: 10px 10px 10px 0;
            margin: 5px 0;
            display: inline-block;
            max-width: 70%;
        }
    </style>



    <div class="col-lg-8 col-xl-9">

        <div class="main-chat-blk">

            <div class="main-wrapper">
                <div class="page-wrapper chat-page-wrapper" style="padding-top: 0px;">
                    <div class="container">
                        <div class="content doctor-content" style="padding-top: 0px;">
                            <div class="chat-sec">
                                <!-- sidebar group -->
                                <div class="sidebar-group left-sidebar chat_sidebar">
                                    <div id="chats" class="left-sidebar-wrap sidebar active slimscroll">
                                        <div class="slimscroll-active-sidebar">
                                            <!-- Left Chat Title -->
                                            <div class="left-chat-title all-chats">
                                                <div class="setting-title-head">
                                                    <h4>المحادثات</h4>
                                                </div>
                                                <div class="add-section">
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#newChatModal">بدء محادثة جديدة</button>
                                                </div>
                                            </div>
                                            <!-- /Left Chat Title -->

                                            <!-- Recent Chats -->
                                            <div class="sidebar-body chat-body" id="chatsidebar">
                                                <ul class="user-list">
                                                    @foreach ($conversations as $conversation)
                                                        @php
                                                            // تحديد المستخدم الآخر في المحادثة
                                                            $otherUser =
                                                                auth()->id() == $conversation->sender_id
                                                                    ? $conversation->receiver
                                                                    : $conversation->sender;
                                                            $lastMessage = $conversation->messages->first();
                                                        @endphp

                                                        <li class="user-list-item">
                                                            <a href="{{ route('broker.chat.show', $conversation->id) }}">
                                                                <div
                                                                    class="avatar {{ $otherUser->isOnline() ? 'avatar-online' : '' }}">
                                                                    <img src="{{ $otherUser->profile_image ?? asset('dashboard/assets/img/doctors-dashboard/profile-01.jpg') }}"
                                                                        alt="image">
                                                                </div>
                                                                <div class="users-list-body">
                                                                    <div>
                                                                        <h5>{{ $otherUser->name }}</h5>
                                                                        <p>{{ Str::limit($lastMessage->message, 30) }}</p>
                                                                    </div>
                                                                    <div class="last-chat-time">
                                                                        <small
                                                                            class="text-muted">{{ $lastMessage->created_at->diffForHumans() }}</small>
                                                                        @if (!$lastMessage->read && $lastMessage->sender_id != auth()->id())
                                                                            <div class="new-message-count">1</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /sidebar group -->

                                <!-- Chat Area -->
                                <div class="chat chat-messages" id="middle">
                                    <div class="slimscroll">
                                        <div class="chat-inner-header">
                                            <div class="chat-header">
                                                @if (isset($conversation))
                                                    @php
                                                        $otherUser =
                                                            auth()->id() == $conversation->sender_id
                                                                ? $conversation->receiver
                                                                : $conversation->sender;
                                                    @endphp
                                                    <div class="user-details">
                                                        <div class="d-lg-none">
                                                            <ul class="list-inline mt-2 me-2">
                                                                <li class="list-inline-item">
                                                                    <a class="text-muted px-0 left_sides"
                                                                        href="{{ route('broker.chat.index') }}">
                                                                        <i class="fas fa-arrow-left"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <figure
                                                            class="avatar {{ $otherUser->isOnline() ? 'avatar-online' : '' }}">
                                                            <img src="{{ $otherUser->profile_image ?? asset('dashboard/assets/img/doctors-dashboard/profile-01.jpg') }}"
                                                                alt="image">
                                                        </figure>
                                                        <div class="mt-1">
                                                            <h5>{{ $otherUser->name }}</h5>
                                                            <small class="last-seen">
                                                                {{ $otherUser->isOnline() ? 'متصل الآن' : 'آخر ظهور: ' . $otherUser->last_seen->diffForHumans() }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if (isset($conversation))
                                            <div class="chat-body">
                                                <div class="messages">
                                                    @foreach ($messages as $message)
                                                        <div
                                                            class="chats {{ $message->sender_id == auth()->id() ? 'chats-right' : '' }}">
                                                            <div class="chat-avatar">
                                                                <img src="{{ $message->sender->profile_image ?? asset('dashboard/assets/img/doctors-dashboard/profile-01.jpg') }}"
                                                                    class="dreams_chat" alt="image">
                                                            </div>
                                                            <div class="chat-content">
                                                                <div
                                                                    class="chat-profile-name {{ $message->sender_id == auth()->id() ? 'text-end justify-content-end' : '' }}">
                                                                    <h6>{{ $message->sender->name }}<span>{{ $message->created_at->format('h:i A') }}</span>
                                                                    </h6>
                                                                </div>
                                                                <div class="message-content">
                                                                    @if ($message->attachment)
                                                                        @if (in_array(pathinfo($message->attachment, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                                            <img src="{{ Storage::url($message->attachment) }}"
                                                                                alt="Attachment" style="max-width: 200px;">
                                                                        @else
                                                                            <a href="{{ Storage::url($message->attachment) }}"
                                                                                download>
                                                                                <i class="fa fa-file"></i> تحميل الملف
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                    {{ $message->message }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="chat-footer">
                                                <form action="{{ route('broker.chat.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="conversation_id"
                                                        value="{{ $conversation->id }}">

                                                    <div class="smile-foot">
                                                        <div class="chat-action-btns">
                                                            <div class="chat-action-col">
                                                                <a class="action-circle" href="#"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <label class="dropdown-item">
                                                                        <span><i class="fa-solid fa-image"></i></span> صورة
                                                                        <input type="file" name="attachment"
                                                                            style="display: none;" accept="image/*">
                                                                    </label>
                                                                    <label class="dropdown-item">
                                                                        <span><i class="fa-solid fa-file-lines"></i></span>
                                                                        ملف
                                                                        <input type="file" name="attachment"
                                                                            style="display: none;">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="text" name="message" class="form-control chat_form"
                                                        placeholder="اكتب رسالتك هنا...">

                                                    <div class="form-buttons">
                                                        <button class="btn send-btn" type="submit">
                                                            <i class="isax isax-send-25"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div class="chat-body empty-chat">
                                                <div class="empty-chat-content">
                                                    <i class="fa-regular fa-comments"></i>
                                                    <h4>اختر محادثة لبدء الدردشة</h4>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /Chat Area -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal لبدء محادثة جديدة -->
    <div class="modal fade" id="newChatModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">بدء محادثة جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('broker.chat.start') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="receiver_type">نوع المستخدم</label>
                            <select class="form-control" id="receiver_type" name="receiver_type" required>
                                <option value="">اختر نوع المستخدم</option>
                                <option value="carrier">الناقل</option>
                                <option value="shipper">الشاحن</option>
                                <option value="broker">broker</option>
                                <option value="admin">المشرف</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="receiver_id">المستخدم</label>
                            <select class="form-control" id="receiver_id" name="receiver_id" required disabled>
                                <option value="">اختر نوع المستخدم أولاً</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">بدء المحادثة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ثم مكتبات تعتمد على jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>

    <script>
        $(document).ready(function() {
            // إزالة alert الزائدة
            console.log('Chat script loaded');

            // تحميل المستخدمين حسب النوع المحدد
            $('#receiver_type').change(function() {
                const type = $(this).val();
                if (type) {
                    $('#receiver_id').prop('disabled', false);
                    $.get(`/broker/chat/users/${type}`, function(users) {
                        console.log('Received users:', users); // للت debugging
                        $('#receiver_id').empty();
                        $('#receiver_id').append('<option value="">اختر المستخدم</option>');

                        if (users.length > 0) {
                            users.forEach(user => {
                                $('#receiver_id').append(
                                    `<option value="${user.id}">${user.name}</option>`);
                            });
                        } else {
                            $('#receiver_id').append('<option value="">لا يوجد مستخدمين</option>');
                        }
                    }).fail(function(xhr, status, error) {
                        console.error('Error fetching users:', error);
                        $('#receiver_id').empty();
                        $('#receiver_id').append('<option value="">خطأ في تحميل البيانات</option>');
                    });
                } else {
                    $('#receiver_id').prop('disabled', true);
                    $('#receiver_id').empty();
                    $('#receiver_id').append('<option value="">اختر نوع المستخدم أولاً</option>');
                }
            });

            // تهيئة slimscroll
            $('.slimscroll').slimScroll({
                height: '100%',
                position: 'right',
                size: "5px",
                color: '#ccc',
                wheelStep: 10,
                touchScrollStep: 100
            });

            // التمرير لأسفل عند تحميل الصفحة
            $('.chat-body').scrollTop($('.chat-body')[0].scrollHeight);

            // إرسال النموذج بالضغط على Enter
            $('.chat_form').keypress(function(e) {
                if (e.which == 13) {
                    $(this).closest('form').submit();
                    return false;
                }
            });

            // تحديث حالة القراءة عند فتح المحادثة
            @if (isset($conversation))
                markMessagesAsRead({{ $conversation->id }});
            @endif

            function markMessagesAsRead(conversationId) {
                $.post('/broker/chat/mark-as-read', {
                    conversation_id: conversationId,
                    _token: '{{ csrf_token() }}'
                }).fail(function(xhr, status, error) {
                    console.error('Error marking as read:', error);
                });
            }
        });
    </script>
@endpush
{{--
<script src="{{ asset('dashboard/assets/js/theme-script-1.js') }}"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.min-1.css') }}">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/fontawesome/css/fontawesome.min-1.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/fontawesome/css/all.min-1.css') }}">

<!-- Iconsax CSS-->
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/iconsax-1.css') }}">

<!-- Feathericon CSS -->
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/feather-1.css') }}">

<!-- Swiper CSS -->
<link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/swiper/swiper.min.css') }}">

<!-- Main CSS -->
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/custom-1.css') }}">


<div class="col-lg-8 col-xl-9">

    <div class="main-chat-blk"> --}}

<!-- Main Wrapper -->
{{-- <div class="main-wrapper">



                <div class="page-wrapper chat-page-wrapper" style="padding-top: 0px;">
                    <div class="container">

                        <div class="content doctor-content" style="padding-top: 0px;">

                            <div class="chat-sec">

                                <!-- sidebar group -->
                                <div class="sidebar-group left-sidebar chat_sidebar">

                                    <!-- Chats sidebar -->
                                    <div id="chats" class="left-sidebar-wrap sidebar active slimscroll">

                                        <div class="slimscroll-active-sidebar">

                                            <!-- Left Chat Title -->
                                            <div class="left-chat-title all-chats">
                                                <div class="setting-title-head">
                                                    <h4> All Chats</h4>
                                                </div>
                                                <div class="add-section">
                                                    <!-- Chat Search -->
                                                    <form>
                                                        <div class="user-chat-search">
                                                            <span class="form-control-feedback"><i
                                                                    class="fa-solid fa-magnifying-glass"></i></span>
                                                            <input type="text" name="chat-search" placeholder="Search"
                                                                class="form-control">
                                                        </div>
                                                    </form>
                                                    <!-- /Chat Search -->
                                                </div>
                                            </div>
                                            <!-- /Left Chat Title -->

                                            <!-- Top Online Contacts -->
                                            <div class="top-online-contacts">
                                                <div class="fav-title">
                                                    <h6>Online Now</h6>
                                                    <a href="javascript:void(0);">View All</a>
                                                </div>
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="top-contacts-box">
                                                                <div class="profile-img online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-01.jpg') }}"
                                                                        alt="Img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="top-contacts-box">
                                                                <div class="profile-img online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-04.jpg') }}"
                                                                        alt="Img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="top-contacts-box">
                                                                <div class="profile-img online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-03.jpg') }}"
                                                                        alt="Img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="top-contacts-box">
                                                                <div class="profile-img online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-08.jpg') }}"
                                                                        alt="Img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="top-contacts-box">
                                                                <div class="profile-img online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                                        alt="Img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="top-contacts-box">
                                                                <div class="profile-img online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-07.jpg') }}"
                                                                        alt="Img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Top Online Contacts -->

                                            <div class="sidebar-body chat-body" id="chatsidebar">

                                                <!-- Left Chat Title -->
                                                <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                                    <div class="fav-title pin-chat">
                                                        <h6>Pinned Chat</h6>
                                                    </div>
                                                </div>
                                                <!-- /Left Chat Title -->

                                                <ul class="user-list">
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div class="avatar avatar-online">
                                                                <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-01.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Adrian Marshall</h5>
                                                                    <p>Have you called them?</p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">Just Now</small>
                                                                    <div class="chat-pin">
                                                                        <i class="fa-solid fa-thumbtack me-2"></i>
                                                                        <i class="fa-solid fa-check-double green-check"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div class="avatar ">
                                                                <img src="{{ asset('dashboard/assets/img/doctors-dashboard/doctor-profile-img.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Dr Joseph Boyd</h5>
                                                                    <p><i class="isax isax-video5 me-1"></i>Video</p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">Yesterday</small>
                                                                    <div class="chat-pin">
                                                                        <i class="fa-solid fa-thumbtack"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div class="avatar avatar-online">
                                                                <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-04.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Dr Edalin Hendry</h5>
                                                                    <p><i
                                                                            class="fa-solid fa-file-lines me-1"></i>Prescription.doc
                                                                    </p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">10:20 PM</small>
                                                                    <div class="chat-pin">
                                                                        <i class="fa-solid fa-thumbtack me-2"></i>
                                                                        <i
                                                                            class="fa-solid fa-check-double green-check"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!-- Left Chat Title -->
                                                <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                                    <div class="fav-title pin-chat">
                                                        <h6>Recent Chat</h6>
                                                    </div>
                                                </div>
                                                <!-- /Left Chat Title -->
                                                <ul class="user-list">
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div class="avatar avatar-online">
                                                                <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-02.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Kelly Stevens</h5>
                                                                    <p>Have you called them?</p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">Just Now</small>
                                                                    <div class="new-message-count">2</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div>
                                                                <div class="avatar avatar-online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-05.jpg') }}"
                                                                        alt="image">
                                                                </div>
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Robert Miller</h5>
                                                                    <p><i class="isax isax-video5 me-1"></i>Video</p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">Yesterday</small>
                                                                    <div class="chat-pin">
                                                                        <i class="fa-solid fa-check"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div class="avatar">
                                                                <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-08.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Emily Musick</h5>
                                                                    <p><i class="fa-solid fa-file-lines me-1"></i>Project
                                                                        Tools.doc
                                                                    </p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">10:20 PM</small>

                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div>
                                                                <div class="avatar avatar-online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-03.jpg') }}"
                                                                        alt="image">
                                                                </div>
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Samuel James</h5>
                                                                    <p><i class="fa-solid fa-microphone me-1"></i>Audio</p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">12:30 PM</small>
                                                                    <div class="chat-pin">
                                                                        <i
                                                                            class="fa-solid fa-check-double green-check"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div>
                                                                <div class="avatar ">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-02.jpg') }}"
                                                                        alt="image">
                                                                </div>
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Dr Shanta Neill</h5>
                                                                    <p class="missed-call-col"><i
                                                                            class="isax isax-call5-flip me-1"></i>Missed
                                                                        Call</p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">Yesterday</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div>
                                                                <div class="avatar avatar-online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-07.jpg') }}"
                                                                        alt="image">
                                                                </div>
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Peter Anderson</h5>
                                                                    <p>Have you called them?</p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">23/03/24</small>
                                                                    <div class="chat-pin">
                                                                        <i class="fa-solid fa-check"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="user-list-item">
                                                        <a href="javascript:void(0);">
                                                            <div>
                                                                <div class="avatar">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                                        alt="image">
                                                                </div>
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div>
                                                                    <h5>Catherine Gracey</h5>
                                                                    <p><i class="fa-solid fa-image me-1"></i>Photo</p>
                                                                </div>
                                                                <div class="last-chat-time">
                                                                    <small class="text-muted">20/03/24</small>
                                                                    <div class="chat-pin">
                                                                        <i class="fa-solid fa-check-double"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- / Chats sidebar -->
                                </div>
                                <!-- /Sidebar group -->

                                <!-- Chat -->
                                <div class="chat chat-messages" id="middle">
                                    <div class="slimscroll">
                                        <div class="chat-inner-header">
                                            <div class="chat-header">
                                                <div class="user-details">
                                                    <div class="d-lg-none">
                                                        <ul class="list-inline mt-2 me-2">
                                                            <li class="list-inline-item">
                                                                <a class="text-muted px-0 left_sides" href="#"
                                                                    data-chat="open">
                                                                    <i class="fas fa-arrow-left"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <figure class="avatar avatar-online">
                                                        <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                            alt="image">
                                                    </figure>
                                                    <div class="mt-1">
                                                        <h5>Dr Edalin Hendry</h5>
                                                        <small class="last-seen">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="chat-options ">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-outline-light chat-search-btn"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Search">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a class="btn btn-outline-light no-bg" href="#"
                                                                data-bs-toggle="dropdown">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item ">Close Chat </a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#mute-notification">Mute
                                                                    Notification</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#disappearing-messages">Disappearing
                                                                    Message</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#clear-chat">Clear Message</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#change-chat">Delete Chat</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#report-user">Report</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#block-user">Block</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Chat Search -->
                                                <div class="chat-search">
                                                    <form>
                                                        <span class="form-control-feedback"><i
                                                                class="fa-solid fa-magnifying-glass"></i></span>
                                                        <input type="text" name="chat-search"
                                                            placeholder="Search Chats" class="form-control">
                                                        <div class="close-btn-chat"><i class="fa fa-close"></i></div>
                                                    </form>
                                                </div>
                                                <!-- /Chat Search -->
                                            </div>
                                        </div>
                                        <div class="chat-body">
                                            <div class="messages">
                                                <div class="chats chats-right">
                                                    <div class="chat-avatar">
                                                        <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="chat-profile-name text-end justify-content-end">
                                                            <h6>Andrea Kearns<span>8:16 PM</span></h6>
                                                            <div class="chat-action-btns ms-3">
                                                                <div class="chat-action-col">
                                                                    <a class="#" href="#"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </a>
                                                                    <div
                                                                        class="dropdown-menu chat-drop-menu dropdown-menu-end">
                                                                        <a href="#"
                                                                            class="dropdown-item message-info-left">Message
                                                                            Info
                                                                        </a>
                                                                        <a href="#" class="dropdown-item">Reply</a>
                                                                        <a href="#" class="dropdown-item">React</a>
                                                                        <a href="#"
                                                                            class="dropdown-item">Forward</a>
                                                                        <a href="#" class="dropdown-item">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="message-content">
                                                            <a href="javascript:void(0);">Hello Doctor, </a> could you tell
                                                            a diet
                                                            plan that suits for me?
                                                            <div class="emoj-group  right-emoji-group">
                                                                <ul>
                                                                    <li class="emoj-action"><a
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-regular fa-face-smile"></i></a>
                                                                        <div class="emoj-group-list">
                                                                            <ul>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-01.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-02.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-03.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-04.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-05.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li><a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#forward-message"><i
                                                                                class="fa-solid fa-share"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat-line">
                                                    <span class="chat-date">Today, March 25</span>
                                                </div>
                                                <div class="chats">
                                                    <div class="chat-avatar">
                                                        <img src="{{ asset('dashboard/assets/img/doctors-dashboard/doctor-profile-img.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="chat-profile-name">
                                                            <h6>Edalin Hendry<span>9:45 AM <i
                                                                        class="fa-solid fa-check-double green-check"></i></span>
                                                            </h6>
                                                            <div class="chat-action-btns ms-3">
                                                                <div class="chat-action-col">
                                                                    <a class="#" href="#"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </a>
                                                                    <div
                                                                        class="dropdown-menu chat-drop-menu dropdown-menu-end">
                                                                        <a href="#"
                                                                            class="dropdown-item message-info-left">Message
                                                                            Info
                                                                        </a>
                                                                        <a href="#" class="dropdown-item">Reply</a>
                                                                        <a href="#" class="dropdown-item">React</a>
                                                                        <a href="#"
                                                                            class="dropdown-item">Forward</a>
                                                                        <a href="#" class="dropdown-item">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="message-content ">
                                                            <div class="emoj-group">
                                                                <ul>
                                                                    <li class="emoj-action"><a
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-regular fa-face-smile"></i></a>
                                                                        <div class="emoj-group-list">
                                                                            <ul>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-01.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-02.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-03.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-04.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-05.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li><a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#forward-message"><i
                                                                                class="fa-solid fa-share"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="chat-voice-group">
                                                                <ul>
                                                                    <li><a href="javascript:void(0);"><span><img
                                                                                    src="{{ asset('dashboard/assets/img/icons/play-01.svg') }}"
                                                                                    alt="image"></span></a></li>
                                                                    <li><img src="{{ asset('dashboard/assets/img/icons/voice.svg') }}"
                                                                            alt="image"></li>
                                                                    <li>0:05</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats chats-right">
                                                    <div class="chat-avatar">
                                                        <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="chat-profile-name text-end justify-content-end">
                                                            <h6>Andrea Kearns<span>9:47 AM</span></h6>
                                                            <div class="chat-action-btns ms-2">
                                                                <div class="chat-action-col">
                                                                    <a class="#" href="#"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </a>
                                                                    <div
                                                                        class="dropdown-menu chat-drop-menu dropdown-menu-end">
                                                                        <a href="#"
                                                                            class="dropdown-item message-info-left">Message
                                                                            Info
                                                                        </a>
                                                                        <a href="#" class="dropdown-item">Reply</a>
                                                                        <a href="#" class="dropdown-item">React</a>
                                                                        <a href="#"
                                                                            class="dropdown-item">Forward</a>
                                                                        <a href="#" class="dropdown-item">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="message-content award-link chat-award-link">
                                                            <a href="javascript:void(0);"
                                                                class="mb-1">https://www.youtube.com/watch?v=GCmL3mS0Psk</a>
                                                            <img src="{{ asset('dashboard/assets/img/sending-img.jpg') }}"
                                                                alt="img">
                                                            <div class="emoj-group right-emoji-group">
                                                                <ul>
                                                                    <li class="emoj-action"><a
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-regular fa-face-smile"></i></a>
                                                                        <div class="emoj-group-list">
                                                                            <ul>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-01.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-02.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-03.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-04.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-05.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li><a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#forward-message"><i
                                                                                class="fa-solid fa-share"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats">
                                                    <div class="chat-avatar">
                                                        <img src="{{ asset('dashboard/assets/img/doctors-dashboard/doctor-profile-img.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="chat-profile-name">
                                                            <h6>Edalin Hendry<span>9:50 AM <i
                                                                        class="fa-solid fa-check-double green-check"></i></span>
                                                            </h6>
                                                            <div class="chat-action-btns ms-3">
                                                                <div class="chat-action-col">
                                                                    <a class="#" href="#"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </a>
                                                                    <div
                                                                        class="dropdown-menu chat-drop-menu dropdown-menu-end">
                                                                        <a href="#"
                                                                            class="dropdown-item message-info-left">Message
                                                                            Info
                                                                        </a>
                                                                        <a href="#" class="dropdown-item">Reply</a>
                                                                        <a href="#" class="dropdown-item">React</a>
                                                                        <a href="#"
                                                                            class="dropdown-item">Forward</a>
                                                                        <a href="#" class="dropdown-item">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="message-content fancy-msg-box">
                                                            <div class="emoj-group">
                                                                <ul>
                                                                    <li class="emoj-action"><a
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-regular fa-face-smile"></i></a>
                                                                        <div class="emoj-group-list">
                                                                            <ul>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-01.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-02.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-03.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-04.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-05.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#forward-message"><i
                                                                                class="fa-solid fa-share"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="download-col">
                                                                <ul class="nav mb-0">
                                                                    <li>
                                                                        <div class="image-download-col">
                                                                            <a href="assets/img/media/media-02.jpg')}}"
                                                                                data-fancybox="gallery" class="fancybox">
                                                                                <img src="{{ asset('dashboard/assets/img/media/media-02.jpg') }}"
                                                                                    alt="Img">
                                                                            </a>

                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="image-download-col ">
                                                                            <a href="assets/img/media/media-03.jpg')}}"
                                                                                data-fancybox="gallery" class="fancybox">
                                                                                <img src="{{ asset('dashboard/assets/img/media/media-03.jpg') }}"
                                                                                    alt="Img">
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="image-download-col image-not-download">
                                                                            <a href="assets/img/media/media-01.jpg')}}"
                                                                                data-fancybox="gallery" class="fancybox">
                                                                                <img src="{{ asset('dashboard/assets/img/media/media-01.jpg') }}"
                                                                                    alt="Img">
                                                                                <span>10+</span>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="chats chats-right">
                                                    <div class="chat-avatar">
                                                        <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="chat-profile-name text-end justify-content-end">
                                                            <h6>Andrea Kearns<span>8:16 PM</span></h6>
                                                            <div class="chat-action-btns ms-3">
                                                                <div class="chat-action-col">
                                                                    <a class="#" href="#"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </a>
                                                                    <div
                                                                        class="dropdown-menu chat-drop-menu dropdown-menu-end">
                                                                        <a href="#"
                                                                            class="dropdown-item message-info-left">Message
                                                                            Info
                                                                        </a>
                                                                        <a href="#" class="dropdown-item">Reply</a>
                                                                        <a href="#" class="dropdown-item">React</a>
                                                                        <a href="#"
                                                                            class="dropdown-item">Forward</a>
                                                                        <a href="#" class="dropdown-item">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="message-content review-files">
                                                            <div class="file-download d-flex align-items-center mb-0">
                                                                <div
                                                                    class="file-type d-flex align-items-center justify-content-center me-2">
                                                                    <i class="fa-solid fa-location-dot"></i>
                                                                </div>
                                                                <div class="file-details">
                                                                    <span class="file-name">My Location</span>
                                                                    <ul>
                                                                        <li><a href="javascript:void(0);">Download</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="emoj-group right-emoji-group">
                                                                <ul>
                                                                    <li class="emoj-action"><a
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-regular fa-face-smile"></i></a>
                                                                        <div class="emoj-group-list">
                                                                            <ul>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-01.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-02.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-03.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-04.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-05.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li><a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#forward-message"><i
                                                                                class="fa-solid fa-share"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="like-chat-grp">
                                                            <ul>
                                                                <li class="like-chat"><a href="javascript:void(0);">2<img
                                                                            src="{{ asset('dashboard/assets/img/icons/like.svg') }}"
                                                                            alt="Icon"></a>
                                                                </li>
                                                                <li class="comment-chat"><a
                                                                        href="javascript:void(0);">2<img
                                                                            src="{{ asset('dashboard/assets/img/icons/heart.svg') }}"
                                                                            alt="Icon"></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats chats-right">
                                                    <div class="chat-avatar">
                                                        <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="chat-profile-name text-end justify-content-end">
                                                            <h6>Andrea Kearns<span>8:16 PM</span></h6>
                                                            <div class="chat-action-btns ms-3">
                                                                <div class="chat-action-col">
                                                                    <a class="#" href="#"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </a>
                                                                    <div
                                                                        class="dropdown-menu chat-drop-menu dropdown-menu-end">
                                                                        <a href="#"
                                                                            class="dropdown-item message-info-left">Message
                                                                            Info
                                                                        </a>
                                                                        <a href="#" class="dropdown-item">Reply</a>
                                                                        <a href="#" class="dropdown-item">React</a>
                                                                        <a href="#"
                                                                            class="dropdown-item">Forward</a>
                                                                        <a href="#" class="dropdown-item">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="message-content">
                                                            Thank you for your support
                                                            <div class="emoj-group right-emoji-group">
                                                                <ul>
                                                                    <li class="emoj-action"><a
                                                                            href="javascript:void(0);"><i
                                                                                class="fa-regular fa-face-smile"></i></a>
                                                                        <div class="emoj-group-list">
                                                                            <ul>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-01.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-02.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-03.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-04.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li><a href="javascript:void(0);"><img
                                                                                            src="{{ asset('dashboard/assets/img/icons/emoj-icon-05.svg') }}"
                                                                                            alt="Icon"></a></li>
                                                                                <li class="add-emoj"><a
                                                                                        href="javascript:void(0);"></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#forward-message"><i
                                                                                class="fa-solid fa-share"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats chats-right">
                                                    <div class="chat-avatar text-end justify-content-end">
                                                        <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content chat-cont-type">
                                                        <div class="chat-profile-name chat-type-wrapper">
                                                            <p>Andrea Kearns Typing...</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="chats forward-chat-msg">
                                                    <div class="chat-avatar">
                                                        <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="chat-profile-name">
                                                            <h6>Andrea Kearns<span>8:16 PM</span></h6>
                                                            <div class="chat-action-btns ms-3">
                                                                <div class="chat-action-col">
                                                                    <a class="#" href="#"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </a>
                                                                    <div
                                                                        class="dropdown-menu chat-drop-menu dropdown-menu-end">
                                                                        <a href="#"
                                                                            class="dropdown-item message-info-left">Message
                                                                            Info
                                                                        </a>
                                                                        <a href="#" class="dropdown-item">Reply</a>
                                                                        <a href="#" class="dropdown-item">React</a>
                                                                        <a href="#"
                                                                            class="dropdown-item">Forward</a>
                                                                        <a href="#" class="dropdown-item">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="message-content">
                                                            Thank you for your support
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-footer">
                                        <form>
                                            <div class="smile-foot">
                                                <div class="chat-action-btns">
                                                    <div class="chat-action-col">
                                                        <a class="action-circle" href="#"
                                                            data-bs-toggle="dropdown">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="#" class="dropdown-item "><span><i
                                                                        class="fa-solid fa-file-lines"></i></span>Document</a>
                                                            <a href="#" class="dropdown-item"><span><i
                                                                        class="fa-solid fa-camera"></i></span>Camera</a>
                                                            <a href="#" class="dropdown-item"><span><i
                                                                        class="fa-solid fa-image"></i></span>Gallery</a>
                                                            <a href="#" class="dropdown-item"><span><i
                                                                        class="fa-solid fa-volume-high"></i></span>Audio</a>
                                                            <a href="#" class="dropdown-item"><span><i
                                                                        class="fa-solid fa-location-dot"></i></span>Location</a>
                                                            <a href="#" class="dropdown-item"><span><i
                                                                        class="fa-solid fa-user"></i></span>Contact</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="smile-foot emoj-action-foot">
                                                <a href="#" class="action-circle"><i
                                                        class="fa-regular fa-face-smile"></i></a>
                                                <div class="emoj-group-list-foot down-emoji-circle">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img
                                                                    src="{{ asset('dashboard/assets/img/icons/emoj-icon-01.svg') }}"
                                                                    alt="Icon"></a>
                                                        </li>
                                                        <li><a href="javascript:void(0);"><img
                                                                    src="{{ asset('dashboard/assets/img/icons/emoj-icon-02.svg') }}"
                                                                    alt="Icon"></a>
                                                        </li>
                                                        <li><a href="javascript:void(0);"><img
                                                                    src="{{ asset('dashboard/assets/img/icons/emoj-icon-03.svg') }}"
                                                                    alt="Icon"></a>
                                                        </li>
                                                        <li><a href="javascript:void(0);"><img
                                                                    src="{{ asset('dashboard/assets/img/icons/emoj-icon-04.svg') }}"
                                                                    alt="Icon"></a>
                                                        </li>
                                                        <li><a href="javascript:void(0);"><img
                                                                    src="{{ asset('dashboard/assets/img/icons/emoj-icon-05.svg') }}"
                                                                    alt="Icon"></a>
                                                        </li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i
                                                                    class="fa-solid fa-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="smile-foot">
                                                <a href="#" class="action-circle"><i
                                                        class="isax isax-microphone-2"></i></a>
                                            </div>
                                            <input type="text" class="form-control chat_form"
                                                placeholder="Type your message here...">
                                            <div class="form-buttons">
                                                <button class="btn send-btn" type="submit">
                                                    <i class="isax isax-send-25"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /Chat -->


                            </div>
                        </div>
                    </div>
                </div>

                <!-- /Main Wrapper -->

                <!-- Voice Call Modal -->
                <div class="modal fade call-modal" id="voice_call">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <!-- Outgoing Call -->
                                <div class="call-box incoming-box">
                                    <div class="call-wrapper">
                                        <div class="call-inner">
                                            <div class="call-user">
                                                <img alt="User Image"
                                                    src="{{ asset('dashboard/assets/img/doctors/doctor-thumb-02.jpg') }}"
                                                    class="call-avatar">
                                                <h4>Darren Elder</h4>
                                                <span>Connecting...</span>
                                            </div>
                                            <div class="call-items">
                                                <a href="javascript:void(0);" class="btn call-item call-end"
                                                    data-bs-dismiss="modal" aria-label="Close"><i
                                                        class="material-icons">call_end</i></a>
                                                <a href="voice-call-1.html" class="btn call-item call-start"><i
                                                        class="material-icons">call</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Outgoing Call -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Voice Call Modal -->

                <!-- Video Call Modal -->
                <div class="modal fade call-modal" id="video_call">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">

                                <!-- Incoming Call -->
                                <div class="call-box incoming-box">
                                    <div class="call-wrapper">
                                        <div class="call-inner">
                                            <div class="call-user">
                                                <img class="call-avatar"
                                                    src="{{ asset('dashboard/assets/img/doctors/doctor-thumb-02.jpg') }}"
                                                    alt="User Image">
                                                <h4>Darren Elder</h4>
                                                <span>Calling ...</span>
                                            </div>
                                            <div class="call-items">
                                                <a href="javascript:void(0);" class="btn call-item call-end"
                                                    data-bs-dismiss="modal" aria-label="Close"><i
                                                        class="material-icons">call_end</i></a>
                                                <a href="video-call-1.html" class="btn call-item call-start"><i
                                                        class="material-icons">videocam</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Incoming Call -->

                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
{{-- </div>

</div>
<script src="{{ asset('dashboard/assets/js/jquery-3.7.1.min-1.js') }}"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('dashboard/assets/js/bootstrap.bundle.min-1.js') }}"></script>

<!-- Swiper JS -->
<script src="{{ asset('dashboard/assets/plugins/swiper/swiper.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('dashboard/assets/js/script-1.js') }}"></script>
<!-- Video Call Modal -->
@endsection --}}
