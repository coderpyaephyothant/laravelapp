@extends('customer.uilayout.uistyle')

@section('content')
{{-- @include('customer.uilayout.uiheader') --}}
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
                                    Small (-4000)
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
                    <div class="">
                        <div class="">
                            <form action=""></form>
                            <form  action="{{route('user#uiproducts')}}">
                                @csrf
                                <input type="" name="name" placeholder="OPPA PIZZAS" style="width: 50%;">
                                <input class="misearch btn " type="submit" value="search">
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>Oppa's Community</h5>
                                <span>Happy with oppa's fans</span>
                            </div>
                        </div>
                    </div>

                    {{-- test for search bar hide or  appear under routes --}}
                        {{-- start --}}
                        {{-- @if (!url()->current())
                    {{url()->current()}}

                        @endif --}}
                        {{-- end --}}

                        <div class="section-title product__discount__title mt-3">
                            <h2 class="">Oppa's Best Pizzas</h2>
                        </div>


                    <div class="row">


                        @if ( $pizzaForPaginate['total'] < 0 )
                            <p class="text-danger font-weight-bold text-uppercase text-center">No Search Data. . . .</p>
                        @endif
                            @foreach ($pizzaForPaginate as $item)

                                <div class="col-lg-4">
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
                                            <h5><a href="{{route('user#uidetail',$item->pizza_id)}}">{{$item->pizza_name}}</a></h5>
                                            <div class="product__item__price">{{$item->price-$item->discount_price}}<span>{{$item['price']}}</span></div>
                                        </div>
                                    </div> <br>
                                </div>

                @endforeach

                    </div>
            <div>
                {{$pizzaForPaginate->links()}}
            </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection

