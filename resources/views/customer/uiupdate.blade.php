@extends('customer.uilayout.uistyle')


    @section('content')
    <!-- Page Preloder -->
 {{-- <div id="preloder">
    <div class="loader"></div>
</div> --}}
    {{-- @include('customer.uilayout.uiheader') --}}
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    {{-- <div class="hero__search ">
                        <div class="hero__search__form">
                            <form action=""></form>
                            <form method="get" action="{{route('user#uiproducts')}}">
                                @csrf
                               <div>
                                <input type="text" name="name" placeholder="OPPA PIZZAS">
                                <button type="submit"  class="btn-danger btn">SEARCH</button>
                               </div>
                            </form>
                        </div>

                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>Oppa's Community</h5>
                                <span>Happy with oppa's pizzas</span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="hero__item set-bg" data-setbg="{{asset('ui/img/hero/bn1.jpg')}}">
                        <div class="hero__text">
                            <span>Oppa's New</span>
                            <h2>Vegetable <br /> Pizza</h2>
                            <a href="{{route('user#uishop')}}" class="primary-btn ">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->


    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Oppa's Best Pizzas</h2>
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
                @if (count($pizzaData) == 0 )
                <h4 class="text-danger">No Pizzas here.Please Create pizzas..</h4>
            @else
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
        @endif
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

     <!-- Carousel Section Begin -->
     <section class="categories">
        <div class="container">
            <div class="row">
                @if (count($pizzaData) == 0 )
                        <h4 class="text-danger">Pizzas are needed to run Carousel.Please Create pizzas..</h4>
                    @else
                <div class="categories__slider owl-carousel">
                    @foreach ($pizzaData as $item)
                        <div class="col-lg-3" style="width: 80% !important;">
                                <div class="categories__item set-bg" data-setbg="{{asset('uploadedImages/'.$item['image'])}}">
                                <h5><a href="{{route('user#uidetail',$item['pizza_id'])}}">{{$item['pizza_name']}}</a></h5>
                            </div>
                        </div>
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- Carousel Section End -->


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
                @if (count($pizzaData) == 0 )
                        <h4 class="text-danger">Pizzas are needed to show .Please Create pizzas..</h4>
                    @else
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
                @endif
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    @endsection
