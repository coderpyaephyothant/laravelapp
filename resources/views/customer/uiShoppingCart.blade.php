@extends('customer.uilayout.uistyle')

@section('content')

{{-- @include('customer.uilayout.uiheader') --}}

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    @php
                        $i = 1;
                    @endphp
                    <table>
                        <thead>

                                    <tr>
                                        <th  >Number</th>
                                        <th class="">Pizzas</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>

                        </thead>
                        <tbody class="">
                            @if ($pizzas != null)
                                @foreach ($pizzas as $product)
                                    <tr>
                                        <td style="color: #198754;">{{$i}}</td>
                                        <td class="shoping__cart__item">

                                            <img src="{{asset('uploadedImages/'.$product['item']['image'])}}" alt="">
                                            <h5>{{$product['item']['pizza_name']}}</h5>

                                        </td>
                                        <td class="shoping__cart__price">
                                            {{$product['item']['price'] - $product['item']['discount_price']}}
                                        </td>
                                        {{-- update start --}}
                                        <form action=""></form>
                                        <form action="{{route('user#quantityUpdate',$product['item']['pizza_id'])}}" method="post">
                                            @csrf
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">

                                                <div class="pro-qty" style="user-select: none;">
                                                    <input  type="text" name="quantity" value="{{$product['quantity']}}">
                                                </div>
                                                <button type="submit" title="update items in the cart" style="background-color: #198754 ;" class="btn  btn-sm text-white me-1">update</button>

                                            </div>
                                        </td>
                                    </form>
                                        {{-- update end --}}

                                        {{-- test

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


                                            --}}
                                        <td class="shoping__cart__total">
                                            {{$product['quantity'] * ($product['item']['price'] - $product['item']['discount_price'])}}
                                        </td>
                                        <td title="delete items in the cart" class="shoping__cart__item__close">
                                            <a href="{{route('user#deleteOrderItem',$product['item']['pizza_id'])}}"><span class="icon_close"></span></a>
                                        </td>
                                            @php
                                                $i ++
                                            @endphp

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="row">
            {{-- back to shopping start--}}
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{route('user#uishop')}}" class="primary-btn cart-btn text-white" style="background-color: #198754!important; "> <i class="fas fa-arrow-left"></i> Back To SHOPPING</a>
                    <a href="{{route('user#cartClear')}}" class="primary-btn cart-btn cart-btn-right cart-btn text-white" style="background-color: #198754!important; ">
                       <i class="fas fa-close text-danger"></i> Clear Cart</a>
                </div>
            </div>
            {{-- back to shopping end --}}
            {{-- <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12 mt-3" style="display: flex;align-items: center;justify-content:end"   >
                <div class="row ">
                    <div class="">

                            <div class="shoping__checkout">
                                <h5>Cart Total</h5>
                                <ul>
                                    <li>Total Quantity <span>{{$totalQty}}</span></li>
                                    <li>Total Price<span>{{$totalPrice}}</span></li>
                                </ul>
                                <a href="{{route('user#checkout')}}" class="primary-btn">Checkout</a>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->


@endsection

