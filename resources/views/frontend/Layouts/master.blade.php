<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li>
                <a{{--  href="{{ route('user.favorites') }}" --}}>
                    <span class="icon_heart_alt"></span>
                    @if ($favoriteCount > 0)
                        <div class="tip">{{ $favoriteCount }}</div>
                    @endif
                    </a>
            </li>

            <li><a href="{{ route('frontend.cart') }}"><span class="icon_bag_alt"></span>
                    <div class="tip">{{ $cartCount }}</div>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="/"><img src="{{ asset('img/logo.png') }}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <div class="dropdown2">

                        @if (Auth::user()->photo)
                            <div class="avatar-icon"
                                style="background-image: url('{{ asset('storage/' . Auth::user()->photo) }}'); ">
                            </div>
                        @else
                            <div class="avatar-icon"
                                style="background-color: #ccc; display: flex; align-items: center; justify-content: center;">
                                👤
                            </div>
                        @endif


                        <div class="dropdown-menu">
                            <div class="dropdown-header">

                                <div class="username">{{ Auth::user()->name ?? 'User' }}</div>
                            </div>
                            <a href="#" class="dropdown-link">Order History</a>
                            <a href="#" class="dropdown-link">BubbleMail</a>
                            <a href="#" class="dropdown-link">Account Settings</a>
                            @if (Auth::user()->role === 'admin' or Auth::user()->role === 'editor')
                                <a href="{{ route('backend.index') }}" class="dropdown-link">Switch to
                                    selling</a>
                            @endif

                            <button class="dropdown-button">Sell Your Art</button>
                            <div class="dropdown-footer">
                                <a href="#">RB Blog</a>



                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                            this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Login</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="/"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="/Home">Home</a></li>
                            <li><a href="#">Women’s</a></li>
                            <li><a href="#">Men’s</a></li>
                            <li><a href="{{ route('frontend.Shop') }}">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('frontend.ProductDetails') }}">Product Details</a></li>
                                    <li><a href="/cart">Shop Cart</a></li>
                                    <li><a href="./checkout.html">Checkout</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="/Contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="dropdown2">
                                        @if (Auth::user()->photo)
                                            <div class="avatar-icon"
                                                style="background-image: url('{{ asset('storage/' . Auth::user()->photo) }}'); ">
                                            </div>
                                        @else
                                            <div class="avatar-icon"
                                                style="background-color: #ccc; display: flex; align-items: center; justify-content: center;">
                                                👤
                                            </div>
                                        @endif


                                        <div class="dropdown-menu">
                                            <div class="dropdown-header">

                                                <div class="username">{{ Auth::user()->name ?? 'User' }}</div>
                                            </div>
                                            <a href="#" class="dropdown-link">Order History</a>
                                            <a href="#" class="dropdown-link">BubbleMail</a>
                                            <a href="/profile" class="dropdown-link">Account Settings</a>
                                            @if (Auth::user()->role === 'admin' or Auth::user()->role === 'editor')
                                                <a href="{{ route('backend.index') }}" class="dropdown-link">Switch to
                                                    selling</a>
                                            @endif

                                            <button class="dropdown-button">Sell Your Art</button>
                                            <div class="dropdown-footer">
                                                <a href="#">RB Blog</a>



                                                <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}">Login</a>
                                @endif
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                            <ul class="header__right__widget">
                                <li><span class="icon_search search-switch"></span></li>
                                <li>
                                    <a href="{{ route('user.favorites') }}">
                                        <span class="icon_heart_alt"></span>
                                        @if ($favoriteCount > 0)
                                            <div class="tip">{{ $favoriteCount }}</div>
                                        @endif
                                    </a>
                                </li>
                                <li><a href="{{ route('frontend.cart') }}"><span class="icon_bag_alt"></span>
                                        <div class="tip">{{ $cartCount }}</div>
                                    </a></li>
                            </ul>


                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Alert Message -->
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
        .alert {
            transition: opacity 0.4s ease-out;
            text-align: center;
        }
    </style>
    @if (session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div id="success-message" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="/"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="footer__payment">
                            <a href="#"><img src="{{ asset('img/payment/payment-1.png') }}"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('img/payment/payment-2.png') }}"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('img/payment/payment-3.png') }}"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('img/payment/payment-4.png') }}"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('img/payment/payment-5.png') }}"
                                    alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Quick links</h6>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="/Contact">Contact</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="footer__widget">
                        <h6>Account</h6>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Orders Tracking</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-8">
                    <div class="footer__newslatter">
                        <h6>NEWSLETTER</h6>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright__text">
                        <p>Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | <i class="fa fa-heart"
                                aria-hidden="true"></i> by <a href="https://google.com" target="_blank">google</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form action="{{ route('frontend.Shop') }}" method="GET" class="search-model-form">
                <input type="text" name="Search" value="{{ Request::input('Search') }}" id="search-input"
                    placeholder="Search here.....">
            </form>
        </div>
    </div>

    <script></script>


    <!-- JS Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
