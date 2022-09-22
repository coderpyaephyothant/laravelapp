@extends('customer.uilayout.uistyle')

@section('content')

@include('customer.uilayout.uiheader')


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
                            <form  action="{{route('user#uiproducts')}}">
                                <input type="text" name="name" placeholder="OPPA PIZZAS">
                                <button type="submit" class="site-btn">SEARCH</button>
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


                                    <div class="col-lg-4" style="width: 80% !important;">
                                        <div class="product__discount__item">
                                            <form action="{{route('user#addToCart',$item->pizza_id)}}" method="post">
                                                @csrf
                                                <div class="product__discount__item__pic set-bg"
                                                    data-setbg="{{asset('uploadedImages/'.$item->image)}}">
                                                    <div class="product__discount__percent">{{$item->discount_percentage}}%</div>
                                                    <ul class="product__item__pic__hover">
                                                        <button class="" style="background-color: transparent; border-style:hidden;" type="submit"><li ><i class="fas fa-shopping-cart"></i></li></button>
                                                    </ul>
                                                </div>
                                            </form>
                                            <div class="product__discount__item__text">
                                                {{-- <span></span> --}}
                                                <h5><a href="{{route('user#uidetail',$item['pizza_id'])}}">{{$item->pizza_name}}</a></h5>
                                                <div class="product__item__price">{{$item->price-$item->discount_price}}<span>{{$item['price']}}</span></div>
                                            </div>
                                        </div>
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
                                    <button id="options" type="button" class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                            <div class="col-lg-4">

                                <div class="product__discount__item">
                                    <form action="{{route('user#addToCart',$item->pizza_id)}}" method="post">
                                            @csrf
                                            <div class="product__discount__item__pic set-bg"
                                                data-setbg="{{asset('uploadedImages/'.$item->image)}}">

                                                <ul class="product__item__pic__hover">
                                                    <button class="" style="background-color: transparent; border-style:hidden;" type="submit"><li ><i class="fas fa-shopping-cart"></i></li></button>
                                                {{-- finally i solved button bug! :) --}}
                                                </ul>
                                            </div>
                                    </form>
                                    <div class="product__discount__item__text">
                                        {{-- <span></span> --}}
                                        <h5><a href="{{route('user#uidetail',$item['pizza_id'])}}">{{$item->pizza_name}}</a></h5>
                                        <div class="product__item__price">{{$item->price-$item->discount_price}}<span>{{$item['price']}}</span></div>
                                    </div> <br>
                                </div>

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

