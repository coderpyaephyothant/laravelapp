<!-- Humberger Begin -->
@php
                $link = url()->current();
                $address = explode('/',$link);
                $path = end($address);

            @endphp
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="{{route('user#uicart')}}"><i class="fas fa-shopping-cart"></i> <span>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : 0 }}</span></a></li>
        </ul>
    </div>
    <div class="humberger__menu__widget">
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
            <li @if ($path == 'uiUpdate')
            class="active"
            @endif><a href="{{route('user#uiupdate')}}">Home</a></li>
            <li @if ($path == 'uiShop')
            class="active"
            @endif><a  href="{{route('user#uishop')}}">Shop</a></li>
            <li @if ($path == 'uicart')
            class="active"
            @endif><a href="{{route('user#uicart')}}">Cart</a> </li>
            <li><a href="#contact_us">Contact Us</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
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
                            <li id="greeting" class="greeting">
                            </li>
                            @if (Auth::check())
                            <li>

                                    {{substr(auth()->user()->name,0,10)}}

                            </li>
                            @endif
                        <li class="cicon"><a href="{{route('user#uicart')}}"><i class="fas fa-shopping-cart"></i> <span>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : 0 }}</span></a></li>

                        </ul>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
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
                                <button type="submit" class="" style="background-color: transparent; border-style:hidden;"><i class="fas fa-lock"></i> Logout</button>

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
                        <a href="{{route('user#uiupdate')}}"><h3 style="color: #198754">Oppa's Pizza</h3></a>

                    </div>
                </div>

                <div class="col-lg-6 ">
                    <nav class="header__menu">
                        <ul>
                            <li @if ($path == 'uiUpdate')
                            class="active"
                            @endif><a href="{{route('user#uiupdate')}}">Home</a></li>
                            <li @if ($path == 'uiShop')
                            class="active"
                            @endif><a  href="{{route('user#uishop')}}">Shop</a></li>
                            <li @if ($path == 'uicart')
                            class="active"
                            @endif><a href="{{route('user#uicart')}}">Cart</a> </li>
                            <li><a href="#contact_us">Contact Us</a></li>
                        </ul>

                    </nav>

                </div>

            {{-- {{$path}} --}}
                 <!-- Breadcrumb Section Begin -->

                    <nav class="" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        @if ($path == 'uiUpdate')
                        <li class="breadcrumb-item" ></li>
                        @else
                        <li class="breadcrumb-item" ><a href="{{route('user#uiupdate')}}">Home</a></li>
                        @endif
                        @if ($path == 'uiShop')
                        <li class="breadcrumb-item"><a href="{{route('user#uishop')}}">Shop</a></li>
                        @endif
                        @if ($path == 'uiProducts')
                        <li class="breadcrumb-item"><a href="{{route('user#uishop')}}">Shop</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user#uiproducts')}}">Products</a></li>
                        @endif
                        @if ($path == 'uicart')
                        <li class="breadcrumb-item"><a href="{{route('user#uishop')}}">Shop</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user#uicart')}}">Cart</a></li>
                        @endif
                        </ol>
                    </nav>

    <!-- Breadcrumb Section End -->

    {{-- cart --}}
    {{-- <div class="col-lg-3 ">
        <div class="header__cart">
            <ul>
                <li><a href="{{route('user#uicart')}}"><i class="fas fa-shopping-cart"></i> <span>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : 0 }}</span></a></li>
            </ul>
        </div>
    </div> --}}




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
                @if (Session::has('please'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{Session::get('please')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('sent'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{Session::get('sent')}}
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
