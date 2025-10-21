<!-- scroll-to-top start -->
{{-- <div class="scroll-to-top">
    <span class="scroll-icon">
  <i class="las la-arrow-up"></i>
</span>
</div> --}}
<!-- scroll-to-top end -->


<div class="header__top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="left d-flex align-items-center">
                    <a href="{{ route('contact') }}"><i class="las la-phone-volume"></i> Customer Support</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="right">
                    <div class="product__cart">
                        @if (Auth::check())
                            <a href="{{ route('cart') }}" class="amount__btn">
                                <i class="las la-shopping-basket"></i>
                                <span class="cart__num" id="cart_count">
                                    {{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}
                                </span>
                            </a>
                        @else
                            <a href="#popup1" class="amount__btn">
                                <i class="las la-shopping-basket"></i>
                                <span class="cart__num">
                                    0
                                </span>
                            </a>
                        @endif
                    </div>
                    @if (Auth::check())
                        <a href="{{ route('dashboard') }}" class="user__btn">
                            <i class="las la-user"></i>
                        </a>
                    @else
                        <a href="#popup1" class="user__btn">
                            <i class="las la-user"></i>
                        </a>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
<!-- header__top end -->
<div class="header__bottom">
    <div class="container">
        <nav class="navbar navbar-expand-xl p-0 align-items-center">
            <a class="site-logo site-title" href="{{ route('home') }}">
                <!--<img src="{{ asset('frontend4/images/color-logo.png') }}" class="logo4" alt="SmartBox">-->
                <img src="{{ asset('frontend4/images/color-logo.png') }}" class="logo4" alt="SmartBox" width="250px"
                    height="150">
                <span class="logo-icon"><i class="flaticon-fire"></i></span>
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="menu-toggle"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav main-menu ms-auto">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                        {{-- <ul class="sub-menu">
                                    <li><a href="{{route('about')}}">Home</a></li>
                                    <li><a href="{{route('get-contact-us')}}">Contact Us </a></li>
                                </ul> --}}
                    </li>
                    <li>
                        <a href="{{ route('home') }}#campaigns">Campaigns</a>

                    </li>
                    @if (Auth::check())
                        <li><a href="{{ route('product.library') }}">Product Library</a></li>
                    @endif
                    {{-- <li><a href="{{route('allbox')}}">Open Box </a></li> --}}
                    {{-- <li><a href="{{route('winners')}}">Winners</a></li> --}}


                    {{-- <li><a href="{{route('media')}}">Media</a></li>
                            <li><a href="{{route('blogs')}}">Blogs</a></li> --}}

                    @if (Auth::check())
                        <li><a href="{{ route('user.logout') }}">Logout</a></li>
                    @elseif (Auth::guest())
                        <li><a href="{{ route('user.auth') }}">Login/Register</a></li>
                    @endif
                </ul>
                <div class="nav-right">
                    {{-- @if (Auth::check())
                            <a href="{{route('allbox')}}" class="cmn-btn style--three btn--sm">
                                <img src="{{asset('frontend4/images/icon/btn/tag.png')}}" alt="icon" class="me-2"> Participate
                            </a>
                            @else
                            <a  href="#popup1" class="cmn-btn style--three btn--sm">
                                <img src="{{asset('frontend4/images/icon/btn/tag.png')}}" alt="icon" class="me-2"> Participate
                            </a>
                            @endif --}}
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- header__bottom end -->
