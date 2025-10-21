@extends('shipper.minlayout.master')


@section('content')
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

        <div class="main-chat-blk">

            <!-- Main Wrapper -->
            <div class="main-wrapper">



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
                                                    @foreach ($conversations as $conversation)
                                                        <li class="user-list-item">
                                                            <a href="{{ route('broker.chat.show', $conversation->id) }}"
                                                                class="user-list-item">
                                                                <div class="avatar avatar-online">
                                                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                                        alt="User Image">
                                                                </div>
                                                                <div class="users-list-body">
                                                                    <div>
                                                                        <h5>{{ optional($conversation->sender)->name ?? 'User' }}
                                                                        </h5>
                                                                        <p>{{ $conversation->messages->last()?->message ?? 'No messages yet' }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="last-chat-time">
                                                                        <small class="text-muted">Just Now</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endforeach
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
                                            <div class="messages" id="chat-messages">
                                                @forelse ($messages as $message)
                                                    <div
                                                        class="chats {{ $message->sender_type === auth()->getDefaultDriver() ? 'chats-right' : '' }}">
                                                        <div class="chat-avatar">
                                                            <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                                                alt="image">
                                                        </div>
                                                        <div class="chat-content">
                                                            <div
                                                                class="chat-profile-name {{ $message->sender_type === auth()->getDefaultDriver() ? 'text-end justify-content-end' : '' }}">
                                                                <h6>{{ $message->sender_type . ' #' . $message->sender_id }}<span>
                                                                        {{ $message->created_at->format('H:i A') }} </span>
                                                                </h6>
                                                            </div>
                                                            <div class="message-content">
                                                                {{ $message->message }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="text-center text-muted">لا توجد رسائل بعد.</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-footer">
                                        <form id="chat-form">
                                            @csrf
                                            <input type="hidden" name="conversation_id"
                                                value="{{ $conversation->id }}">

                                            <div class="chat-footer">
                                                <form>
                                                    <div class="smile-foot emoj-action-foot">
                                                        <a href="#" class="action-circle"><i
                                                                class="fa-regular fa-face-smile"></i></a>
                                                    </div>
                                                    <input type="text" name="message" id="chat-input"
                                                        class="form-control chat_form"
                                                        placeholder="Type your message here...">
                                                    <div class="form-buttons">
                                                        <button class="btn send-btn" type="submit">
                                                            <i class="isax isax-send-25"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </form>

                                        {{-- <form>
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
                                        </form> --}}
                                    </div>
                                    <div class="chat-profile-name chat-type-wrapper" id="typing-indicator"
                                        style="display: none;">
                                        <p id="typing-text"></p>
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
            </div>
        </div>

    </div>
    <script src="{{ asset('dashboard/assets/js/jquery-3.7.1.min-1.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('dashboard/assets/js/bootstrap.bundle.min-1.js') }}"></script>

    <!-- Swiper JS -->
    <script src="{{ asset('dashboard/assets/plugins/swiper/swiper.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('dashboard/assets/js/script-1.js') }}"></script>


    @section('scripts')
        <script src="https://js.pusher.com/7.2/pusher.min.js "></script>
        <script>
            const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
                encrypted: true
            });

            // الانضمام إلى قناة المحادثة
            const channel = pusher.subscribe('private-chat.{{ $conversation->id }}');
            channel.bind('message.sent', function(data) {
                const senderType = "{{ auth()->getDefaultDriver() }}";

                const isMyMessage = data.message.sender_type === senderType;

                const messageHtml = `
            <div class="chats ${isMyMessage ? 'chats-right' : ''}">
                <div class="chat-content">
                    <div class="chat-profile-name ${isMyMessage ? 'text-end justify-content-end' : ''}">
                        <h6>${data.message.sender_type} #${data.message.sender_id}<span> ${new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })}</span></h6>
                    </div>
                    <div class="message-content">
                        ${data.message.message}
                    </div>
                </div>
            </div>
        `;

                $('#chat-messages').append(messageHtml);
                $('.chat-body').scrollTop($('.chat-body')[0].scrollHeight);
            });

            // إرسال الرسالة عبر AJAX
            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.post("{{ route('broker.chat.send') }}", formData, function(response) {
                    $('#chat-input').val('');
                });
            });
        </script>

        <script>
            const input = $('#chat-input');

            input.on('input', function() {
                if (input.val().length > 0) {
                    Echo.private('chat.{{ $conversation->id }}')
                        .whisper('typing', {
                            user: "{{ auth()->getDefaultDriver() }}",
                            typing: true
                        });
                }
            });

            // استقبال مؤشر الكتابة
            Echo.private('chat.{{ $conversation->id }}')
                .listenForWhisper('typing', (e) {
                    if (!e.typing) return;

                    $('#typing-indicator').show();
                    $('#typing-text').text(e.user + ' Typing...');

                    setTimeout(() => {
                        $('#typing-indicator').hide();
                    }, 3000); // اختفاء المؤشر بعد 3 ثوانٍ
                });
        </script>
    @endsection

    <!-- Video Call Modal -->
@endsection
