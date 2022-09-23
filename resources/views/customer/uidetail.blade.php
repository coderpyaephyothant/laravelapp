@extends('customer.uilayout.uistyle')

@section('content')

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
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                        </div>
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
    @php
        $link = url()->current();
        $address = explode('/',$link);
        $path = end($address);

    @endphp
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
                            <li @if ($path == 'uiupdate')
                            class="active"
                            @endif><a href="{{route('user#uiupdate')}}">Home</a></li>
                            <li @if ($path == 'uishop')
                            class="active"
                            @endif><a  href="{{route('user#uishop')}}">Shop</a></li>
                            <li @if ($path == 'uicart')
                            class="active"
                            @endif><a href="{{route('user#uicart')}}">Cart</a> </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact Us</a></li>
                        </ul>
                    </nav>

       <!-- Breadcrumb Section Begin -->
       <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('user#uiupdate')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('user#uishop')}}">Shop</a></li>
        @foreach ($mainDetail as $item)
        <li class="breadcrumb-item"><a href="{{route('user#uishop')}}">{{$item['pizza_name']}}</a></li>
        @endforeach
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


<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    @foreach ($mainDetail as $item)
                    <div class="product__details__pic__item" id="inOutZoom">
                        <img id="inoutimg"  style="border-radius: 3%;" class="product__details__pic__item--large"
                            src="{{asset('uploadedImages/'.$item['image'])}}" alt="">
                    </div>
                    @endforeach
                    {{-- <div class="product__details__pic__slider owl-carousel">
                        @foreach ($sameCats as $item)
                        <div >
                            <img
                        src="{{asset('uploadedImages/'.$item['image'])}}" alt="" >
                        </div>
                        @endforeach

                    </div> --}}
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                @foreach ($mainDetail as $item)
                <div class="product__details__text">
                    <h3>{{$item['pizza_name']}}</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                    <span class="product__details__price">{{$item['price'] - $item['discount_price']}} </span>  <span class="text-secondary" style="font-size: 25px;text-decoration:line-through;">{{$item['price']}}</span>
                    <p>{{$item['description']}}</p>

                    {{-- <span class="dropdown" >
                        <a style="margin-bottom: 5px !important;" class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Medium
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="#">Large</a>
                          <a class="dropdown-item" href="#">Small</a>
                          <a class="dropdown-item" href="#">Tiny</a>
                        </div>
                      </span> --}}
                      <form action="{{route('user#addToCart',$item['pizza_id'])}}" method="post">
                        @csrf
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input name="quantity" type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <button type="submit" style="margin-left: 5px; border-style:hidden;" class="primary-btn">ADD TO CARD</button>
                      </form>
                    {{-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> --}}
                    <ul>
                        <li><b>Availability</b> @if ($item['publish_status'] == 1)
                            <span>In Stock</span>
                        @else
                            <span class="text-danger">Not Now</span>
                        @endif</li>
                        <li><b>By 1 Get 1</b> @if ($item['buy_one_get_one'] == 1)
                            <span>Yes</span>
                        @else
                            <span>Comming Soon</span>
                        @endif</li>
                        <li><b>Category</b><span>{{$item['category_name']}}</span></li>
                        <li><b>Type</b><span>{{$item['type_name']}}</span></li>
                        <li><b>Waiting Time</b><span>{{$item['waiting_time']}} Minutes</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Pizzas</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($sameTyps as $item)
            <div class="col-lg-4">

                <div class="product__discount__item">
                    <form action="{{route('user#addToCart',$item['pizza_id'])}}" method="post">
                            @csrf
                            <div class="product__discount__item__pic set-bg"
                                data-setbg="{{asset('uploadedImages/'.$item['image'])}}">

                                <ul class="product__item__pic__hover">
                                    <button class="" style="background-color: transparent; border-style:hidden;" type="submit"><li ><i class="fas fa-shopping-cart"></i></li></button>
                                {{-- finally i solved button bug! :) --}}
                                </ul>
                            </div>
                    </form>
                    <div class="product__discount__item__text">
                        {{-- <span></span> --}}
                        <h5><a href="{{route('user#uidetail',$item['pizza_id'])}}">{{$item['pizza_name']}}</a></h5>
                        <div class="product__item__price">{{$item['price'] - $item['discount_price']}}<span style="text-decoration: line-through">{{$item['price']}}</span></div>
                    </div> <br>
                </div>

            </div>
            @endforeach
        </div>

        {{-- sample  --}}

        {{-- end sample --}}

    </div>
</section>
<!-- Related Product Section End -->

<!-- Latest Pizzas Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Latest Pizzas</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($pizzas as $item)
            <div class="col-lg-4">

                <div class="product__discount__item">
                    <form action="{{route('user#addToCart',$item['pizza_id'])}}" method="post">
                            @csrf
                            <div class="product__discount__item__pic set-bg"
                                data-setbg="{{asset('uploadedImages/'.$item['image'])}}">

                                <ul class="product__item__pic__hover">
                                    <button class="" style="background-color: transparent; border-style:hidden;" type="submit"><li ><i class="fas fa-shopping-cart"></i></li></button>
                                {{-- finally i solved button bug! :) --}}
                                </ul>
                            </div>
                    </form>
                    <div class="product__discount__item__text">
                        {{-- <span></span> --}}
                        <h5><a href="{{route('user#uidetail',$item['pizza_id'])}}">{{$item['pizza_name']}}</a></h5>
                        <div class="product__item__price">{{$item['price'] - $item['discount_price']}}<span style="text-decoration: line-through">{{$item['price']}}</span></div>
                    </div> <br>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Latest Pizzas Section End -->


@endsection





