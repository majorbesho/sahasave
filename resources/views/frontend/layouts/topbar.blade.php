


<div class="xs-sidebar-group info-group info-sidebar">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">X</a>
            </div>
            <div class="sidebar-textwidget">
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="logo">
                            <a href="index.html"><img src="{{asset('4/assets/images/resources/sidebar-logo.png')}}" alt=""></a>
                        </div>
                        <div class="content-box">
                            <h4>About Us</h4>
                            <div class="inner-text">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                                    roots in a piece of classical Latin literature from 45 BC, making it over
                                    2000 years old.
                                </p>
                            </div>
                        </div>

                        <div class="form-inner">
                            <h4>Get a free quote</h4>
                            <form action="index.html" method="post">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Name" required="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" required="">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="Message..."></textarea>
                                </div>
                                <div class="form-group message-btn">
                                    <button class="thm-btn" type="submit" data-loading-text="Please wait...">
                                        Submit Now
                                        <i class="icon-right-arrow21"></i>
                                        <span class="hover-btn hover-bx"></span>
                                        <span class="hover-btn hover-bx2"></span>
                                        <span class="hover-btn hover-bx3"></span>
                                        <span class="hover-btn hover-bx4"></span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="sidebar-contact-info">
                            <h4>Contact Info</h4>
                            <ul>
                                <li>
                                    <span class="icon-location1"></span> 88 broklyn street, New York
                                </li>
                                <li>
                                    <span class="icon-phone"></span>
                                    <a href="tel:123456789">+1 555-9990-153</a>
                                </li>
                                <li>
                                    <span class="fa fa-envelope"></span>
                                    <a href="mailto:info@example.com">info@example.com</a>
                                </li>
                            </ul>
                        </div>


                        <div class="thm-social-link1">
                            <ul class="social-box">
                                <li class="facebook">
                                    <a href="#"><i class="icon-facebook-f" aria-hidden="true"></i></a>
                                </li>
                                <li class="twitter">
                                    <a href="#"><i class="icon-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li class="linkedin">
                                    <a href="#"><i class="icon-instagram" aria-hidden="true"></i></a>
                                </li>
                                <li class="gplus">
                                    <a href="#"><i class="icon-linkedin" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--
<div id="top-bar .d-sm-none">
    <div class="container clearfix">
        <div class="top-login row justify-content-between">
            <div class="col-12 col-md-auto">
                <!-- Top Links
                ============================================= -->
                <div class="top-links on-click">
                    <ul class="top-links-container">


                        @if (Auth::guest())
                        <li class="top-links-item"><a href="{{route('user.auth')}}"> login</a></li>
                        <li class="top-links-item"><a href="{{route('user.auth')}}"> sign up</a></li>
                        @endif
                        @if (Auth::check())
                        <li class="top-links-item"><a href="{{route('allgroupOfProduct')}}"><i class="fa-solid fa-gift fa-flip fa-lg"></i></a></li>
                        <li class="top-links-item"><a href="{{route('home')}}"><i class="fa-solid fa-house fa-lg"></i></a></li>
                        <li class="top-links-item"><a href="{{route('dashboard')}}"><i class="fa-solid fa-user fa-lg"></i></a>
                            <li class="top-links-item"><a href="{{route('user.logout')}}"><i class="fa-solid fa-right-from-bracket"></i></a>

                        @endif

                          <div class="top-links-section">
                                <form id="top-login" autocomplete="off"  method="post" action="{{ route('login.submit') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input  id="email" type="text" class="form-control
                                        @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required
                                        autocomplete="email" autofocus
                                        placeholder="Email address"
                                        >
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>`
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control @error('password')
                                        is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                        name="remember"
                                        {{ old('remember') ? 'checked' : '' }}
                                        id="top-login-checkbox">
                                        <label class="form-check-label" for="top-login-checkbox">Remember Me</label>
                                    </div>
                                    <button class="btn btn-danger w-100" type="submit"> {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif

                                </form>
                            </div>
                        </li>



                      <li class="top-links-item"><a href="index.html"><i class="fa-solid fa-globe fa-lg"></i></a></li>
                    </ul>
                </div><!-- .top-links end -->
            </div>
        </div>
    </div>
</div> --}}

