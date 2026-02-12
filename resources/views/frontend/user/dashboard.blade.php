@extends('frontend.layouts.master')


@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
<section>
    <div class="container"  style="margin-top: 50px;">
        <div class="container light-style flex-grow-1 container-p-y">
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">

                    @include('frontend.user.sidebar')

                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                                <form action="" method="post">
                                        @csrf
                                    <div class="card-body media align-items-center">


                                          {{-- <div class="avatar-preview">
                                @if (auth()->user()->photo)
                                <div id="imagePreview" style="background-image: url({{$user->photo}});">
                                </div>
                                @else
                                <div id="imagePreview"
                                style="background-image: url({{Helper::userDefaultImage()}});">
                                </div>

                                @endif

                            </div> --}}

                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                            class="d-block ui-w-80">
                                        <div class="media-body ml-4 pt-2">
                                            <label class="btn btn-outline-primary">
                                                Upload new photo
                                                <input type="file" class="account-settings-fileinput">
                                            </label> &nbsp;
                                            <button type="button" class="btn btn-default md-btn-flat">Reset</button>
                                            <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <div class="form-group">

                                            {{-- 'email',
                                            'password',
                                            'status',
                                            'photo',
                                            'phone',
                                            'phone_verfiy',
                                            'nationality',
                                            'dateOfbarth',
                                            'address',
                                            'provider',
                                            'provider_id',
                                            'is_verified',
                                            'referral_code',
                                            'ref_by',
                                            'no_of_refs',
                                            'ref_level_id',
                                            'onesignal_device_id',
                                            'emp_code' --}}

                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control mb-1" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">E-mail</label>
                                            <input type="text" class="form-control mb-1" value="{{ $user->email }}">
                                            <div class="alert alert-warning mt-3">
                                                Your email is not confirmed. Please check your inbox.<br>
                                                <a href="javascript:void(0)">Resend confirmation</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Company</label>
                                            <input type="text" class="form-control" value="{{ $user->phone }}">
                                        </div>
                                    </div>

                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="account-change-password">
                                <form action="" method="post">
                                    @csrf
                                <div class="card-body pb-2">
                                    {{-- <div class="form-group">
                                        <label class="form-label">Current password</label>
                                        <input type="password" class="form-control">
                                    </div> --}}
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Repeat new password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="account-info">
                                <form action="" method="post">
                                    @csrf
                                    <div class="card-body pb-2">
                                        <div class="form-group">
                                            <label class="form-label">Bio</label>
                                            <textarea class="form-control"
                                                rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nunc arcu, dignissim sit amet sollicitudin iaculis, vehicula id urna. Sed luctus urna nunc. Donec fermentum, magna sit amet rutrum pretium, turpis dolor molestie diam, ut lacinia diam risus eleifend sapien. Curabitur ac nibh nulla. Maecenas nec augue placerat, viverra tellus non, pulvinar risus.</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Birthday</label>
                                            <input type="text" class="form-control" value="May 3, 1995">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Country</label>
                                            <select class="custom-select">
                                                <option>USA</option>
                                                <option selected>Canada</option>
                                                <option>UK</option>
                                                <option>Germany</option>
                                                <option>France</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body pb-2">
                                        <h6 class="mb-4">Contacts</h6>
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" value="+0 (123) 456 7891">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Website</label>
                                            <input type="text" class="form-control" value>
                                        </div>
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="account-social-links">
                                <form action="" method="post">
                                    @csrf
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Twitter</label>
                                        <input type="text" class="form-control" value="https://twitter.com/user">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" class="form-control" value="https://www.facebook.com/user">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Google+</label>
                                        <input type="text" class="form-control" value>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" value>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Instagram</label>
                                        <input type="text" class="form-control" value="https://www.instagram.com/user">
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="account-connections">
                                <form action="" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <button type="button" class="btn btn-twitter">Connect to
                                            <strong>Twitter</strong></button>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <h5 class="mb-2">
                                            <a href="javascript:void(0)" class="float-right text-muted text-tiny"><i
                                                    class="ion ion-md-close"></i> Remove</a>
                                            <i class="ion ion-logo-google text-google"></i>
                                            You are connected to Google:
                                        </h5>
                                        <a href="mailto:info@savesaha.com">info@savesaha.com</a>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-facebook">Connect to
                                            <strong>Facebook</strong></button>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-instagram">Connect to
                                            <strong>Instagram</strong></button>
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="account-notifications">
                                <form action="" method="post">
                                    @csrf
                                    <div class="card-body pb-2">
                                        <h6 class="mb-4">Activity</h6>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input" checked>
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Email me when someone comments on my article</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input" checked>
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Email me when someone answers on my forum
                                                    thread</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input">
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Email me when someone follows me</span>
                                            </label>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body pb-2">
                                        <h6 class="mb-4">Application</h6>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input" checked>
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">News and announcements</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input">
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Weekly product updates</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input" checked>
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Weekly blog digest</span>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right mt-3">
                {{-- <button type="button" class="btn btn-primary">Save changes</button>&nbsp;
                <button type="button" class="btn btn-default">Cancel</button> --}}
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>



    {{-- <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">

    </div> --}}
    <!-- Ec breadcrumb end -->

    <!-- User profile section -->
    {{-- <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                    <div class="ec-sidebar-wrap ec-border-box">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-vendor-block">
                                <!-- <div class="ec-vendor-block-bg"></div>
                                            <div class="ec-vendor-block-detail">
                                                <img class="v-img" src="assets/images/user/1.jpg" alt="vendor image">
                                                <h5>Mariana Johns</h5>
                                            </div> -->
                                <div class="ec-vendor-block-items">
                                    <ul>
                                        @include('frontend.user.sidebar')

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ec-vendor-block-profile">
                                        <div class="ec-vendor-block-img space-bottom-30">
                                            <div class="ec-vendor-block-bg">
                                                <a href="#" class="btn btn-lg btn-primary"
                                                    data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal"
                                                    data-bs-target="#edit_modal">Edit Detail</a>
                                            </div>
                                            <div class="ec-vendor-block-detail">
                                                <img class="v-img" src="assets/images/user/1.jpg" alt="vendor image">
                                                <h5 class="name">{{ $user->name }}</h5>
                                                <p>{{ $user->title }}</p>
                                            </div>
                                            <p>Hello <span>{{ $user->name }}!!</span></p>
                                            <p>From your account you can easily view and track orders. You can manage
                                                and change your account information like address, contact information
                                                and history of orders.</p>
                                        </div>
                                        <h5>Account Information</h5>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                    <h6>E-mail address <a href="javasript:void(0)"
                                                            data-link-action="editmodal" title="Edit Detail"
                                                            data-bs-toggle="modal" data-bs-target="#edit_modal"><i
                                                                class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Email 1 : </strong>{{ $user->email }}</li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                    <h6>Contact nubmer<a href="javasript:void(0)"
                                                            data-link-action="editmodal" title="Edit Detail"
                                                            data-bs-toggle="modal" data-bs-target="#edit_modal"><i
                                                                class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Phone Nubmer 1 : </strong>{{ $user->tele }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                                    <h6>Address<a href="javasript:void(0)" data-link-action="editmodal"
                                                            title="Edit Detail" data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a>
                                                    </h6>
                                                    <ul>
                                                        <li><strong>Home : </strong>{{ $user->adderss }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address">
                                                    <h6>Shipping Address<a href="javasript:void(0)"
                                                            data-link-action="editmodal" title="Edit Detail"
                                                            data-bs-toggle="modal" data-bs-target="#edit_modal"><i
                                                                class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Office : </strong>{{ $user->adderss }}.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End User profile section -->







    {{-- <div class="mt-minus-150 pb-120">
        <div class="container">


            <div class="row">
                <div class="col-lg-4 ">
                    <div class="user-card">
                        <div class="user-card user-prof">
                            <div class="avatar-upload">
                                <div class="obj-el">
                                    <img src="{{ asset('frontend4/assets/images/elements/team-obj.png') }}" alt="image">
                                </div>
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                            </div>
                        </div>


                        <h3 class="user-card__name">{{ $user->name }}</h3>

                    </div>
                    <!-- user-card end -->
                    <div class="user-action-card">
                        <ul class="user-action-list">
                            @include('frontend.user.sidebar')
                        </ul>
                    </div>
                    <!-- user-action-card end -->
                </div>


                <div class="col-lg-8 mt-lg-0 mt-5">
                    {{-- {{ route('profile.update',auth()->id()) }} --}

                    <form action="{{ route('editinfo', auth()->id()) }}" method="POST">
                        @csrf
                        <div class="user-info-card">
                            <div class="user-info-card__header">
                                <h3 class="user-info-card__title">Personal Details</h3>
                            </div>
                            <ul class="user-info-card__list">
                                <li>
                                    <span class="caption">Name</span>
                                    <input type="text" name="name" placeholder="{{ $user->name }}">
                                </li>
                                <li>
                                    <span class="caption">Date of Birth</span>
                                    <input type="date" name="dateOfbarth" placeholder="{{ $user->dateOfbarth }}">
                                </li>
                                <li>
                                    <span class="caption">Address</span>
                                    <input type="text" name="address" placeholder="{{ $user->address }}">
                                </li>
                                <li>
                                    <span class="caption">nationality</span>
                                    <input type="text" name="nationality" placeholder="{{ $user->nationality }}">
                                </li>
                                <li>
                                    <span class="caption">phone</span>
                                    <input type="text" name="phone" placeholder="{{ $user->phone }}">
                                </li>
                            </ul>
                        </div>


                        <!-- user-info-card end -->

                        <!-- user-info-card end -->
                        <div class="user-info-card">
                            <div class="user-info-card__header">
                                <h3 class="user-info-card__title">Email Addresses</h3>
                            </div>
                            <ul class="user-info-card__list">
                                <li>
                                    <span class="caption">Email</span>
                                    <span class="value"><a href=" "
                                            style="color: #000;">{{ $user->email }}</a></span>
                                </li>
                            </ul>
                            <button type="submit" class="btn btn-success"><i class="far fa-edit"></i> Edit</button>
                        </div>
                    </form>



                    <div class="user-info-card">
                        <div class="user-info-card__header">
                            <h3 class="user-info-card__title">Security</h3>
                        </div>
                        <ul class="user-info-card__list">
                            <li>
                                <label for="oldPasswordInput" class="form-label">Old Password</label>
                                <input name="old_password" type="password"
                                    class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Old Password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </li>
                            <li>
                                <label for="newPasswordInput" class="form-label">New Password</label>
                                <input name="new_password" type="password"
                                    class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </li>

                            <li>
                                <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                <input name="new_password_confirmation" type="password" class="form-control"
                                    id="confirmNewPasswordInput" placeholder="Confirm New Password">
                            </li>

                        </ul>
                    </div>


                </div>


                <!-- user-info-card end -->

            </div>

        </div>
    </div> --}}

    </div>
@endsection
