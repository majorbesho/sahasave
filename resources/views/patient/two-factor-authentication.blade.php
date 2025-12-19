  @extends('frontend.layouts.master')

  @section('content')
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
      <!-- /Breadcrumb -->
      <!-- Page Content -->
      <div class="content doctor-content">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4 col-xl-3 theiaStickySidebar">

                      <!-- Profile Sidebar -->
                      @include('patient.sidebar')
                  </div>

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
                                  <a class="nav-link active" href="two-factor-authentication.html">2 Factor
                                      Authentication</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link" href="delete-account.html">Delete Account</a>
                              </li>
                          </ul>
                      </nav>
                      <div class="mb-0 card">
                          <div class="card-body">
                              <div
                                  class="flex-wrap gap-3 pb-3 mb-3 border-bottom d-flex align-items-center justify-content-between">
                                  <h5>2 Factor Authentication</h5>
                                  <div class="status-toggle">
                                      <input type="checkbox" id="status_2" class="check" checked="">
                                      <label for="status_2" class="checktoggle">checkbox</label>
                                  </div>
                              </div>
                              <div class="card">
                                  <div class="card-body">
                                      <form
                                          action="https://SehaSave.com.dreamstechnologies.com/laravel/template/public/two-factor-authentication">
                                          <div class="mb-3">
                                              <h6 class="mb-1">Set up using an Email</h6>
                                              <p class="fs-14">Enter your Email which we send you code</p>
                                          </div>
                                          <div class="pb-3 mb-3 border-bottom">
                                              <label class="form-label">Email Address <span
                                                      class="text-danger">*</span></label>
                                              <div class="gap-2 d-flex align-items-center w-100">
                                                  <div class="flex-grow-1">
                                                      <input type="text" class="form-control">
                                                  </div>
                                                  <div>
                                                      <button
                                                          class="btn btn-md btn-primary-gradient rounded-pill">Continue</button>
                                                  </div>
                                              </div>
                                          </div>
                                          <label class="form-label">Enter the code generated by Email</label>
                                          <div method="get" class="digit-group login-form-control"
                                              data-group-name="digits" data-autosubmit="false" autocomplete="off">
                                              <div class="otp-box setting-otp">
                                                  <div class="mb-2">
                                                      <input type="text" id="digit-1" name="digit-1"
                                                          data-next="digit-2" maxlength="1">
                                                      <input type="text" id="digit-2" name="digit-2"
                                                          data-next="digit-3" data-previous="digit-1" maxlength="1">
                                                      <input type="text" id="digit-3" name="digit-3"
                                                          data-next="digit-4" data-previous="digit-2" maxlength="1">
                                                      <input type="text" id="digit-4" name="digit-4"
                                                          data-next="digit-5" data-previous="digit-3" maxlength="1">
                                                  </div>
                                              </div>
                                          </div>
                                          <button type="submit"
                                              class="btn btn-md btn-primary-gradient rounded-pill">Submit</button>
                                      </form>
                                  </div>
                              </div>
                              <div class="mb-0 card">
                                  <div class="card-body">
                                      <form
                                          action="https://SehaSave.com.dreamstechnologies.com/laravel/template/public/two-factor-authentication">
                                          <div class="mb-3">
                                              <h6 class="mb-1">Set up using an SMS</h6>
                                              <p class="fs-14">Enter your phone number which we send you code</p>
                                          </div>
                                          <div class="pb-3 mb-3 border-bottom">
                                              <label class="form-label">Phone Number <span
                                                      class="text-danger">*</span></label>
                                              <div class="gap-2 d-flex align-items-center w-100">
                                                  <div class="flex-grow-1">
                                                      <input type="text" class="form-control">
                                                  </div>
                                                  <div>
                                                      <a href="#"
                                                          class="btn btn-md btn-primary-gradient rounded-pill"
                                                          data-bs-target="#success-modal"
                                                          data-bs-toggle="modal">Continue</a>
                                                  </div>
                                              </div>
                                          </div>
                                          <label class="form-label">Enter the code generated by SMS</label>
                                          <div method="get" class="digit-group login-form-control"
                                              data-group-name="digits" data-autosubmit="false" autocomplete="off">
                                              <div class="otp-box setting-otp">
                                                  <div class="mb-2">
                                                      <input type="text" id="digit-1" name="digit-1"
                                                          data-next="digit-2" maxlength="1">
                                                      <input type="text" id="digit-2" name="digit-2"
                                                          data-next="digit-3" data-previous="digit-1" maxlength="1">
                                                      <input type="text" id="digit-3" name="digit-3"
                                                          data-next="digit-4" data-previous="digit-2" maxlength="1">
                                                      <input type="text" id="digit-4" name="digit-4"
                                                          data-next="digit-5" data-previous="digit-3" maxlength="1">
                                                  </div>
                                              </div>
                                          </div>
                                          <button type="submit"
                                              class="btn btn-md btn-primary-gradient rounded-pill">Submit</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- /Change Password -->

              </div>
          </div>

      </div>
      <!-- /Page Content -->
  @endsection
