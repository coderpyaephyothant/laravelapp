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
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
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
        <div class="header__top__right__auth">
            <a href="#"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class=""><a href="{{route('user#uiupdate')}}">Home</a></li>
            <li class="active"><a  href="{{route('user#uishop')}}">Shop</a></li>
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
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> oppapizza@gmailcom</li>
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
                            <li><i class="fa fa-envelope"></i> oppa@pizza.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
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
                        <div class="header__top__right__auth">
                            <a href="#"><i class="fa fa-user"></i> Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="{{asset('ui/img/opplogo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class=""><a href="{{route('user#uiupdate')}}">Home</a></li>
                        <li class="active"><a  href="{{route('user#uishop')}}">Shop</a></li>
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
                <!-- Breadcrumb Section Begin -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('user#uiupdate')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{route('user#uishop')}}">Shop</a></li>
      <li class="breadcrumb-item"><a href="{{route('user#uishop')}}">Pizza Name</a></li>
    </ol>
  </nav>
    <!-- Breadcrumb Section End -->
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                    </ul>
                </div>
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
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
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
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <span class="dropdown" >
                        <a style="margin-bottom: 5px !important;" class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Medium
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="#">Large</a>
                          <a class="dropdown-item" href="#">Small</a>
                          <a class="dropdown-item" href="#">Tiny</a>
                        </div>
                      </span>
                    <a style="margin-left: 5px;" href="#" class="primary-btn btn-sm">ADD TO CARD</a>
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
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
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
            <a href="{{route('user#uidetail',$item['pizza_id'])}}">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{asset('uploadedImages/'.$item['image'])}}">
                            <ul class="product__item__pic__hover">
                                {{-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> --}}
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="">{{$item['pizza_name']}}</a></h6>
                            <h5>{{$item['price'] - $item['discount_price']}}</h5><span style="text-decoration: line-through">{{$item['price']}}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
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
            <a href="{{route('user#uidetail',$item['pizza_id'])}}">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{asset('uploadedImages/'.$item['image'])}}">
                            <ul class="product__item__pic__hover">
                                {{-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> --}}
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="">{{$item['pizza_name']}}</a></h6>
                            <h5>{{$item['price'] - $item['discount_price']}}</h5> <span style="text-decoration: line-through">{{$item['price']}}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
<!-- Latest Pizzas Section End -->


@endsection

