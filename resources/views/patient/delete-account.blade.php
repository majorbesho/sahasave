  @extends('frontend.layouts.master')

  @section('content')
      <!-- Breadcrumb -->
      <div class="breadcrumb-bar">
          <div class="container">
              <div class="row align-items-center inner-banner">
                  <div class="text-center col-md-12 col-12">
                      <nav aria-label="breadcrumb" class="page-breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="index.html"><i class="isax isax-home-15"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Patient</li>
                              <li class="breadcrumb-item active">Settings</li>
                          </ol>

                          <h2 class="breadcrumb-title">Settings</h2>

                      </nav>
                  </div>
              </div>
          </div>
          <div class="breadcrumb-bg">
              <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img" class="breadcrumb-bg-01">
              <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img" class="breadcrumb-bg-02">
              <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-03">
              <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-04">
          </div>
      </div>
      <!-- /Breadcrumb --> <!-- Page Content -->
      <div class="content doctor-content">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4 col-xl-3 theiaStickySidebar">

                      <!-- Profile Sidebar -->
                      @include('patient.sidebar')
                  </div>
                  <!-- / Profile Sidebar -->

                  <!-- Change Password -->
                  <div class="col-lg-8 col-xl-9">
                      <nav class="mb-1 settings-tab">
                          <ul class="nav nav-tabs-bottom" role="tablist">
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link" href="profile-settings.html">Profile</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link" href="change-password.html">Change Password</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link" href="two-factor-authentication.html">2 Factor Authentication</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link active" href="delete-account.html">Delete Account</a>
                              </li>
                          </ul>
                      </nav>
                      <div class="mb-0 card">
                          <div class="card-body">
                              <div class="pb-3 mb-3 border-bottom">
                                  <h5>Delete Account</h5>
                              </div>
                              <h6 class="fs-16">Are you sure you want to delete your account?</h6>
                              <p>Refers to the action of permanently removing a user's account and associated data from a
                                  system, service and platform.</p>
                              <a href="#" class="btn btn-md btn-primary-gradient rounded-pill" data-bs-toggle="modal"
                                  data-bs-target="#del-acc">Delete Account</a>
                          </div>
                      </div>
                  </div>
                  <!-- /Change Password -->

              </div>
          </div>

      </div>
      <!-- /Page Content -->
  @endsection
