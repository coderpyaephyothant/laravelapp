<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : 0 }}</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <img src="{{asset('ui/img/language.png')}}" alt="">
            <div>English</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Burmese</a></li>
                <li><a href="#">English</a></li>
            </ul>
        </div>
        @if (Auth::check())


        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <div class="header__top__right__auth">
                <a href="" type="submit"><i class="fas fa-lock"></i> Logout</a>
            </div>
        </form>
        @else

        <div class="header__top__right__auth">
            <a href="{{ route('login') }}"><i class="fas fa-user"></i> Login</a>
        </div>

        @endif
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{route('user#uiupdate')}}">Home</a></li>
            <li class=""><a  href="{{route('user#uishop')}}">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="./blog.html">Blog</a></li>
            <li><a href="./contact.html">Contact Us</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    {{-- <div class="header__top__right__social">
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
        <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
    </div> --}}
    <div class="humberger__menu__contact">
        <ul>
            <li></i> welcome from oppa's pizza myanmar.</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li id="greeting">
                            </li>
                            <li>
                                @if (Auth::check())
                                    {{auth()->user()->name}}
                                @endif
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        {{-- <div class="header__top__right__social">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                        </div> --}}
                        <div class="header__top__right__language">
                            <img src="{{asset('ui/img/hero/lg.jpg')}}" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Burmese</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        @if (Auth::check())


                            <div class="header__top__right__auth">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                <button class="" style="background-color: transparent; border-style:hidden;"><i class="fas fa-lock"></i> Logout</button>

                            </div>


                        @else

                        <div class="header__top__right__auth">
                            <a href="{{ route('login') }}"><i class="fas fa-user"></i> Login</a>
                        </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
                <div class="col-lg-3 ">
                    <div class="header__logo">
                        <h3 style="color: #198754">Oppa's Pizza</h3>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{route('user#uiupdate')}}">Home</a></li>
                            <li class=""><a  href="{{route('user#uishop')}}">Shop</a></li>
                            <li><a href="{{route('user#uicart')}}">Cart</a> </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact Us</a></li>
                        </ul>
                    </nav>

        <!-- Breadcrumb Section Begin -->
                    @php
                        $link = url()->current();
                        $address = explode('/',$link);
                        $path = end($address);

                    @endphp
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user#uiupdate')}}">Home</a></li>
                        @if ($path == 'uishop')
                        <li class="breadcrumb-item"><a href="{{route('user#uishop')}}">Shop</a></li>
                        @endif
                        @if ($path == 'uiproducts')
                        <li class="breadcrumb-item"><a href="{{route('user#uiproducts')}}">Products</a></li>
                        @endif
                        @if ($path == 'uicart')
                        <li class="breadcrumb-item"><a href="{{route('user#uicart')}}">Cart</a></li>
                        @endif

                        </ol>
                    </nav>
        <!-- Breadcrumb Section End -->
                </div>
                <div class="col-lg-3 ">
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{route('user#uicart')}}"><i class="fas fa-shopping-cart"></i> <span>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : 0 }}</span></a></li>
                        </ul>
                    </div>
                </div>



            <div class="col-12">
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{Session::get('success')}}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (Session::has('outOcStock'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>{{Session::get('outOcStock')}}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('deleted'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{Session::get('deleted')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('inc'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{Session::get('inc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
             </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
