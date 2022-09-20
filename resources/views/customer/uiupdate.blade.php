@extends('customer.uilayout.uistyle')


    @section('content')
    <!-- Page Preloder -->
 <div id="preloder">
    <div class="loader"></div>
</div>
    @include('customer.uilayout.uiheader')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Categories</span>
                        </div>
                        <ul>
                            @foreach ($catData as $item)
                            <li><a href="">{{$item['category_name'] }} <span class="text-danger font-weight-bold">( {{$item['count']}} )</span> </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div class="hero__search ">
                        <div class="hero__search__form">
                            <form action="{{route('user#products')}}">
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
                    <div class="hero__item set-bg" data-setbg="{{asset('ui/img/hero/bn1.jpg')}}">
                        <div class="hero__text">
                            <span>Oppa's New</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <a href="{{route('user#uishop')}}" class="primary-btn ">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($pizzaData as $item)
                        <div class="col-lg-3" style="width: 80% !important;">
                                <div class="categories__item set-bg" data-setbg="{{asset('uploadedImages/'.$item['image'])}}">
                                <h5><a href="{{route('user#uidetail',$item['pizza_id'])}}">{{$item['pizza_name']}}</a></h5>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Oppa"s Best Pizzas</h2>
                    </div>
                    <div class="featured__controls ">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".chicken">Chicken</li>
                            <li data-filter=".beef">Beef</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".seafood">Seafood</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                {{-- <div class="col-lg-3 col-md-4 col-sm-6 mix chicken ">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset('ui/img/featured/feature-1.jpg')}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div> --}}
                @foreach ($pizzaData as $item)
                    @if ($item['type'] == 1)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix chicken ">
                        <a href="{{route('user#uidetail',$item['pizza_id'])}}">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="{{asset('uploadedImages/'.$item['image'])}}">
                                    <ul class="featured__item__pic__hover">
                                        {{-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6>{{$item['pizza_name']}}</h6>
                                    {{-- <h5>{{$item['price']}}</h5> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                @endforeach
                @foreach ($pizzaData as $item)
                    @if ($item['type'] == 2)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix seafood ">
                        <a href="{{route('user#uidetail',$item['pizza_id'])}}">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="{{asset('uploadedImages/'.$item['image'])}}">
                                    <ul class="featured__item__pic__hover">
                                        {{-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6>{{$item['pizza_name']}}</h6>
                                    {{-- <h5>{{$item['price']}}</h5> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                @endforeach
                @foreach ($pizzaData as $item)
                @if ($item['type'] == 3)
                <div class="col-lg-3 col-md-4 col-sm-6 mix beef ">
                    <a href="{{route('user#uidetail',$item['pizza_id'])}}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{asset('uploadedImages/'.$item['image'])}}">
                                <ul class="featured__item__pic__hover">
                                    {{-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6>{{$item['pizza_name']}}</h6>
                                {{-- <h5>{{$item['price']}}</h5> --}}
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            @endforeach
            @foreach ($pizzaData as $item)
            @if ($item['type'] == 4)
            <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables ">
                <a href="{{route('user#uidetail',$item['pizza_id'])}}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset('uploadedImages/'.$item['image'])}}">
                            <ul class="featured__item__pic__hover">
                                {{-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> --}}
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6>{{$item['pizza_name']}}</h6>
                            {{-- <h5>{{$item['price']}}</h5> --}}
                        </div>
                    </div></a>
            </div>
            @endif
        @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{asset('ui/img/banner/banner-1.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{asset('ui/img/banner/banner-2.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>By One Get One</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($pizzaData as $item)
                    @if ($item['buy_one_get_one'] == 1 )
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{route('user#uidetail',$item['pizza_id'])}}">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="{{asset('uploadedImages/'.$item['image'])}}">
                                    <ul class="featured__item__pic__hover">
                                        {{-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6>{{$item['pizza_name']}}</h6>
                                    {{-- <h5>{{$item['price']}}</h5> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    @endsection
