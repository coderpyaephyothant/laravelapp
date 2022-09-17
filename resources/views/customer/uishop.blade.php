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

      <!-- Product Section Begin -->
      <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                @foreach ($catData as $item)
                                <li><a href="{{route('user#uilinkopenCat',$item['category_id'])}}">{{$item['category_name']}} <span class="text-danger font-weight-bold">( {{$item['count']}} )</span> </a></li>
                                @endforeach
                            </ul>
                        </div>


                        <div class="sidebar__item">
                            <h4>Sizes</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large (+ 5000)
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small (2000)
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny (-3000)
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Menu</h4>
                            <ul>
                                @foreach ($typeData as $item)
                                <li><a href="{{route('user#uilinkopenType',$item['type_id'])}}">{{$item['type_name']}} <span class="text-danger font-weight-bold">({{$item['count']}})</span> </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form  action="{{route('user#uisearch')}}">
                                <input type="text" name="name" placeholder="OPPA PIZZAS">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+959 123456789</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>

                    {{-- test for search bar hide or  appear under routes --}}
                        {{-- start --}}
                        {{-- @if (!url()->current())
                    {{url()->current()}}

                        @endif --}}
                        {{-- end --}}


                     <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h5>Sale Off</h5>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($pizzaData as $item)


                                    <div class="col-lg-4">
                                        <a href="{{route('user#uidetail',$item['pizza_id'])}}">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                data-setbg="{{asset('uploadedImages/'.$item->image)}}">
                                                <div class="product__discount__percent">{{$item->discount_percentage}}%</div>
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                {{-- <span></span> --}}
                                                <h5><a href="">{{$item->pizza_name}}</a></h5>
                                                <div class="product__item__price">{{$item->price-$item->discount_price}}<span>{{$item['price']}}</span></div>
                                            </div>
                                        </div>
                                    </a>
                                    </div>

                                @endforeach


                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>

                                <div class="btn-group">
                                    <button id="options" type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if (empty($inthis))
                                            All
                                        @else
                                        @if ($inthis == 5 )
                                            All
                                            @endif

                                            @if ($inthis == 1)
                                                Newest Pizzas
                                            @endif
                                            @if ($inthis == 2)
                                            Price High - Low
                                            @endif
                                            @if ($inthis == 3)
                                            Price Low - High
                                            @endif
                                            @if ($inthis == 4)
                                            LastMonth Pizzas
                                            @endif
                                        @endif




                                    </button>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="{{route('user#uifilter',5)}}">All</a>
                                        <a class="dropdown-item" href="{{route('user#uifilter',1)}}">Newest Pizzas</a>
                                        <a class="dropdown-item" href="{{route('user#uifilter',4)}}">LastMonth Pizzas</a>
                                        <a class="dropdown-item" href="{{route('user#uifilter',2)}}">Price High - Low</a>
                                        <a class="dropdown-item" href="{{route('user#uifilter',3)}}">Price Low - High</a>


                                    </div>
                                </div>


                                    {{-- <form action="{{route('user#uifilter')}}" method="post">
                                        <select name="filterNumber" >
                                            <button type="submit"><option  value="" class="active">Default</option></button>
                                            <button type="submit"><option value="0">Newest Pizzas</option></button>
                                            <option value="1">Price High - Low</option>
                                            <option value="2">Price Low - High</option>
                                            <option value="3">Name</option>
                                        </select>
                                    </form> --}}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{$pizzaForPaginate->total()}}</span> Products found</h6>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row">

                            @foreach ($pizzaForPaginate as $item)

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="{{route('user#uidetail',$item['pizza_id'])}}">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="{{asset('uploadedImages/'.$item->image)}}">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="">{{$item->pizza_name}}</a></h6>
                                    <h5>{{$item->price - $item->discount_price}}</h5> <span style="text-decoration: line-through">{{$item->price}}</span>
                                </div>
                            </div>
                        </a>
                        </div>


                @endforeach
                    </div>
            <div>
                {{$pizzaForPaginate->links()}}
            </div>

                    {{-- <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection

