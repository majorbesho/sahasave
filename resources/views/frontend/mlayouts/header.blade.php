<!-- scroll-to-top start -->
{{-- <div class="scroll-to-top">
    <span class="scroll-icon">
  <i class="las la-arrow-up"></i>
</span>
</div> --}}
<!-- scroll-to-top end -->




<div class="gen-bottom-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('home') }}">

                        <img src="{{ asset('frontend4/images/color-logo.png') }}" class="img-fluid logo" alt="SmartBox"
                            width="250px" height="150">

                        {{-- <img class="img-fluid logo" src="images/logo-1.png" alt="streamlab-image"> --}}
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div id="gen-menu-contain" class="gen-menu-contain">
                            <ul id="gen-main-menu" class="navbar-nav ml-auto">
                                <li class="menu-item active">
                                    <a href="#" aria-current="page">Home</a>
                                    <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                    {{-- <ul class="sub-menu">
                                            <li class="menu-item active">
                                                <a href="index.html" aria-current="page">Main Home</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="movies-home.html" aria-current="page">Movies Home</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="tv-shows-home.html" aria-current="page">Tv Shows Home</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="video-home.html" aria-current="page">Video Home</a>
                                            </li>
                                        </ul> --}}
                                </li>
                                <li class="menu-item">
                                    <a href="#">Movies</a>
                                    <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                    {{-- <ul class="sub-menu">
                                            <li class="menu-item menu-item-has-children">
                                                <a href="#">Movies List</a>
                                                <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                <ul class="sub-menu">
                                                    <li class="menu-item">
                                                        <a href="movies-load-more.html">Load More</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="movies-infinite-scroll.html">Infinite scroll</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="movies-pagination.html">Pagination</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children">
                                                <a href="#">Movies Style</a>
                                                <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                <ul class="sub-menu">
                                                    <li class="menu-item">
                                                        <a href="movies-style-1.html">Style 1</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="movies-style-2.html">Style 2</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="movies-style-3.html">Style 3</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="single-movie.html">Single Movie</a>
                                            </li>
                                        </ul> --}}
                                </li>
                                <li class="menu-item">
                                    <a href="#">Tv Shows</a>
                                    <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                    {{-- <ul class="sub-menu">
                                            <li class="menu-item menu-item-has-children">
                                                <a href="#">Tv Shows List</a>
                                                <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                <ul class="sub-menu">
                                                    <li class="menu-item">
                                                        <a href="tv-shows-load-more.html">Load More</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="tv-shows-infinite-scroll.html">Infinite scroll</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="tv-shows-pagination.html">Pagination</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children">
                                                <a href="#">Tv Shows Style</a>
                                                <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                <ul class="sub-menu">
                                                    <li class="menu-item">
                                                        <a href="tv-shows-style-1.html">Style 1</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="tv-shows-style-2.html">Style 2</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="tv-shows-style-3.html">Style 3</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="single-tv-shows.html">Single Tv Shows</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="single-episode.html">Single Episode</a>
                                            </li>
                                        </ul> --}}
                                </li>
                                <li class="menu-item">
                                    <a href="#">Video</a>
                                    <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                    {{-- <ul class="sub-menu">
                                            <li class="menu-item menu-item-has-children">
                                                <a href="#">Video</a>
                                                <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                <ul class="sub-menu">
                                                    <li class="menu-item">
                                                        <a href="video-load-more.html">Load More</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="video-infinite-scroll.html">Infinite scroll</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="video-pagination.html">Pagination</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children">
                                                <a href="#">Videos Style</a>
                                                <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                <ul class="sub-menu">
                                                    <li class="menu-item">
                                                        <a href="videos-style-1.html">Style 1</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="videos-style-2.html">Style 2</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="videos-style-3.html">Style 3</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="single-videos.html">Single videos</a>
                                            </li>
                                        </ul> --}}
                                </li>
                                <li class="menu-item">
                                    <a href="#">Pages</a>
                                    <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                    {{-- <ul class="sub-menu">
                                            <li class="menu-item menu-item-has-children">
                                                <a href="#">Blog</a>
                                                <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                <ul class="sub-menu">
                                                    <li class="menu-item menu-item-has-children">
                                                        <a href="#">Blog With Sidebar</a>
                                                        <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                        <ul class="sub-menu">
                                                            <li class="menu-item">
                                                                <a href="blog-left-sidebar.html">blog left sidebar</a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="blog-right-sidebar.html">blog right sidebar</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children">
                                                <a href="#">Pricing</a>
                                                <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                <ul class="sub-menu">
                                                    <li class="menu-item">
                                                        <a href="pricing-style-1.html">Style 1</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="pricing-style-2.html">Style 2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="contact-us.html">Contact Us</a>
                                            </li>
                                        </ul> --}}
                                </li>
                                <li class="menu-item">
                                    <div>
                                        <input type="checkbox" class="checkbox" id="checkbox">
                                        <label for="checkbox" class="checkbox-label">
                                            <i class="fas fa-moon"></i>
                                            <i class="fas fa-sun"></i>
                                            <span class="ball"></span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="gen-header-info-box">
                        <div class="gen-menu-search-block">
                            <a href="javascript:void(0)" id="gen-seacrh-btn"><i class="fa fa-search"></i></a>
                            <div class="gen-search-form">
                                <form role="search" method="get" class="search-form" action="#">
                                    <label>
                                        <span class="screen-reader-text"></span>
                                        <input type="search" class="search-field" placeholder="Search …" value=""
                                            name="s">
                                    </label>
                                    <button type="submit" class="search-submit"><span
                                            class="screen-reader-text"></span></button>
                                </form>
                            </div>
                        </div>
                        <div class="gen-account-holder">
                            <a href="javascript:void(0)" id="gen-user-btn"><i class="fa fa-user"></i></a>
                            <div class="gen-account-menu">
                                <ul class="gen-account-menu">
                                    <!-- Pms Menu -->

                                    @if (Auth::check())
                                        <li>
                                            <a href="{{ route('user.logout') }}"><i class="fa fa-user"></i>
                                                Logout </a>
                                        </li>
                                    @elseif (Auth::guest())
                                        <li>
                                            <a href="{{ route('user.auth') }}l"><i class="fas fa-sign-in-alt"></i>
                                                login </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.auth') }}"><i class="fa fa-user"></i>
                                                Sign Up </a>
                                        </li>
                                    @endif



                                    <!-- Library Menu -->
                                    <li>
                                        <a href="library.html">
                                            <i class="fa fa-indent"></i>
                                            Library </a>
                                    </li>
                                    <li>
                                        <a href="library.html"><i class="fa fa-list"></i>
                                            Movie Playlist </a>
                                    </li>
                                    <li>
                                        <a href="library.html"><i class="fa fa-list"></i>
                                            Tv Show Playlist </a>
                                    </li>
                                    <li>
                                        <a href="library.html"><i class="fa fa-list"></i>
                                            Video Playlist </a>
                                    </li>
                                    {{-- <li>
                                        <a href="upload-video.html"> <i class="fa fa-upload"></i>
                                            Upload Video </a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="gen-btn-container">
                            <a href="register.html" class="gen-button">
                                <div class="gen-button-block">
                                    <span class="gen-button-line-left"></span>
                                    <span class="gen-button-text">Subscribe</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                </nav>
            </div>
        </div>
    </div>
</div>


{{-- <div class="header__top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="left d-flex align-items-center">
                            <a href="tel:+971502746822"><i class="las la-phone-volume"></i> Customer Support</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="right">
                            <div class="product__cart">
                                @if (Auth::check())
                                <a href="{{route('cart')}}" class="amount__btn">
                                    <i class="las la-shopping-basket"></i>
                                    <span class="cart__num" id="cart_count">
                                        {{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}
                                    </span>
                                </a>
                                @else
                                <a  href="#popup1" class="amount__btn">
                                    <i class="las la-shopping-basket"></i>
                                    <span class="cart__num">
                                        0
                                    </span>
                                </a>
                                @endif
                            </div>
                            @if (Auth::check())
                            <a href="{{route('dashboard')}}" class="user__btn" >
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
        </div> --}}
<!-- header__top end -->
{{--    <div class="header__bottom">
            <div class="container">
                <nav class="navbar navbar-expand-xl p-0 align-items-center">
                    <a class="site-logo site-title" href="{{route('home')}}">
                        <!--<img src="{{asset('frontend4/images/color-logo.png')}}" class="logo4" alt="SmartBox">-->
                        <img src="{{asset('frontend4/images/color-logo.png')}}" class="logo4" alt="SmartBox" width="250px" height="150">
                        <span class="logo-icon"><i class="flaticon-fire"></i></span>
                    </a>
                    <button class="navbar-toggler ms-auto"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                        <span class="menu-toggle"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav main-menu ms-auto">
                            <li>
                                <a href="{{route('home')}}">Home</a>
                                 <ul class="sub-menu">
                                    <li><a href="{{route('about')}}">Home</a></li>
                                    <li><a href="{{route('get-contact-us')}}">Contact Us </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('home')}}#campaigns">Campaigns</a>

                            </li>
                            @if (Auth::check())
                             <li><a href="{{route('product.library')}}">Product Library</a></li>
                             @endif
                            {{-- <li><a href="{{route('allbox')}}">Open Box </a></li> --}}
{{-- <li><a href="{{route('winners')}}">Winners</a></li> --}}


{{-- <li><a href="{{route('media')}}">Media</a></li>
                            <li><a href="{{route('blogs')}}">Blogs</a></li>

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
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- header__bottom end --> --}}
