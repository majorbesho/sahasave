
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
</div>

