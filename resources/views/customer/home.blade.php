@extends('customer.layout.style')
@section('content')

  <!-- scroll to top start -->
  <button class="" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-caret-up"></i></button>
  <!-- scroll to top end -->

        <!-- carousel start -->

        <div class="container mt-5 ">
          <div class="row">


          </div>
        </div>


       <!-- Lists start -->
<div class="container mt-5">
  <div class="row">
    <div class="col-12  d-flex" style="">

        <div class="col-lg-10 col-md-10 p-3">
          @if (Session::has('sent'))
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{Session::get('sent')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

      @if (Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>{{Session::get('success')}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if (Session::has('outOcStock'))
          <b class="text-danger">{{Session::get('outOcStock')}}</b>
      @endif
          <div class="mt-3 text-center">
            <h3 class="text-danger hname">FAVORITES</h3>
          </div> <hr>
          <div class=" mb-3 mt-5 d-flex justify-content-around flex-wrap ">
            @if ($Number == 0)
                  <p class="text-danger"><b>No  Datas to show here. . . .</b></p>

                  @endif
                  <ul id="lightSlider4">
            @foreach ($pizzas as $item)
            @if ($item->publish_status > 0  && $item->quantity > 0 )
            <li>
            <div class="card mb-3 shadow-sm pB " style="width: 15rem; height: 25rem;">
              <div class=" overflow-hidden" style="height: 10rem;">
              <img src="{{asset('uploadedImages/'.$item->image)}}" class="card-img-top img-fluid pImg" alt="Sunset Over the Sea" style="object-fit:cover;height: 100% !important;"/>
              </div>

              <div class="card-bg bg-success " style="height:20rem">
                @if ($item->discount_price > 0)
                <div style="width:40%;position: absolute; top:0px;margin-radius:5px;" class="text-white  bg-danger d-flex align-items-center justify-content-center">
                  <small>promotion</small>
                  </div>
                @endif
                <div class="text-center ">
                  <a href="{{route('user#pizzaDetails',$item->pizza_id)}}" class="text-decoration-none itemText">
                    <div class="card-text mt-1"><b>{{$item->pizza_name}}</b></div>
                    </a>
                </div>
                <div class="w-100  p-2">
                  <small style="text-align:center !important;">{{substr($item->description,0,150).'...'}}</small>
                </div>
                <div class="d-flex p-2  align-items-center  justify-content-start  w-100 pBtn2">
                  <div>
                    @if ($item->discount_price > 0 )
                    <div class="text-warning">{{$item->price - $item->discount_price}} Ks</div>
                    @endif
                  <small class="@if ($item->discount_price > 0)
                  text-decoration-line-through
                  @endif">{{$item->price}} Ks</small>
                  </div>
                </div>
                <div class="d-flex align-items-center justify-content-around pBtn  w-100">
                  <a href="{{route('user#pizzaDetails',$item->pizza_id)}}">
                  <button class="btn  btn-sm mainBtn">More details</button>
                     </a>
                  <form action="{{route('user#addToCart',$item->pizza_id)}}" method="post">
                    @csrf
                    <button type="submit" class="btn  btn-sm mainBtn"><i class="fas fa-cart-shopping "></i>Add to cart</button>

                  </form>
                </div>


              </div>
            </div>

            @endif
          </li>
            @endforeach
        </ul>
            </div>
            {{-- new items show --}}
            @foreach ($pizzas as $item)
            @if ($item->publish_status > 0  && $item->quantity > 0 && $item->new == 1 )
            <div class="mt-3 text-center">
              <h3 class="text-danger hname">NEW PIZZAS</h3>
            </div> <hr>
            @endif
            @endforeach
            <div class=" mb-3 mt-5 d-flex justify-content-around flex-wrap ">
                  </div>
              <ul id="lightSlider3">
              @foreach ($pizzas as $item)
              @if ($item->publish_status > 0  && $item->quantity > 0 && $item->new == 1 )
              <li>
              <div class="card mb-3 shadow-sm pB " style="width: 15rem; height: 25rem;">
                <div class=" overflow-hidden" style="height: 10rem;">
                <img src="{{asset('uploadedImages/'.$item->image)}}" class="card-img-top img-fluid pImg" alt="Sunset Over the Sea" style="object-fit:cover;height: 100% !important;"/>
                </div>

                <div class="card-bg bg-success " style="height:20rem">
                  @if ($item->discount_price > 0)
                  <div style="width:40%;position: absolute; top:0px;margin-radius:5px;" class="text-white  bg-danger d-flex align-items-center justify-content-center">
                    <small>promotion</small>
                    </div>
                  @endif
                  <div class="text-center ">
                    <a href="{{route('user#pizzaDetails',$item->pizza_id)}}" class="text-decoration-none itemText">
                      <div class="card-text mt-1"><b>{{$item->pizza_name}}</b></div>
                      </a>
                  </div>
                  <div class="w-100  p-2">
                    <small style="text-align:center !important;">{{substr($item->description,0,150).'...'}}</small>
                  </div>
                  <div class="d-flex p-2  align-items-center  justify-content-start  w-100 pBtn2">
                    <div>
                      @if ($item->discount_price > 0 )
                      <div class="text-warning">{{$item->price - $item->discount_price}} Ks</div>
                      @endif
                    <small class="@if ($item->discount_price > 0)
                    text-decoration-line-through
                    @endif">{{$item->price}} Ks</small>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-around pBtn  w-100">
                    <a href="{{route('user#pizzaDetails',$item->pizza_id)}}">
                    <button class="btn  btn-sm mainBtn">More details</button>
                       </a>
                    <form action="{{route('user#addToCart',$item->pizza_id)}}" method="post">
                      @csrf
                      <button type="submit" class="btn  btn-sm mainBtn"><i class="fas fa-cart-shopping "></i>Add to cart</button>

                    </form>
                  </div>


                </div>
              </div>
              @endif
            </li>
              @endforeach

          </ul>

              {{-- new items show --}}
            <div class=" text-center">
              <h3 class="text-danger hname">Family Sets</h3>
            </div> <hr>
            <ul id="lightSlider">
              @foreach ($pizzas as $item)
              @if ($item->publish_status > 0  && $item->quantity > 0 && $item->new == 1 )
              <li>
              <div class="card mb-3 shadow-sm pB " style="width: 15rem; height: 25rem;">
                <div class=" overflow-hidden" style="height: 10rem;">
                <img src="{{asset('uploadedImages/'.$item->image)}}" class="card-img-top img-fluid pImg" alt="Sunset Over the Sea" style="object-fit:cover;height: 100% !important;"/>
                </div>

                <div class="card-bg bg-success " style="height:20rem">
                  @if ($item->discount_price > 0)
                  <div style="width:40%;position: absolute; top:0px;margin-radius:5px;" class="text-white  bg-danger d-flex align-items-center justify-content-center">
                    <small>promotion</small>
                    </div>
                  @endif
                  <div class="text-center ">
                    <a href="{{route('user#pizzaDetails',$item->pizza_id)}}" class="text-decoration-none itemText">
                      <div class="card-text mt-1"><b>{{$item->pizza_name}}</b></div>
                      </a>
                  </div>
                  <div class="w-100  p-2">
                    <small style="text-align:center !important;">{{substr($item->description,0,150).'...'}}</small>
                  </div>
                  <div class="d-flex p-2  align-items-center  justify-content-start  w-100 pBtn2">
                    <div>
                      @if ($item->discount_price > 0 )
                      <div class="text-warning">{{$item->price - $item->discount_price}} Ks</div>
                      @endif
                    <small class="@if ($item->discount_price > 0)
                    text-decoration-line-through
                    @endif">{{$item->price}} Ks</small>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-around pBtn  w-100">
                    <a href="{{route('user#pizzaDetails',$item->pizza_id)}}">
                    <button class="btn  btn-sm mainBtn">More details</button>
                       </a>
                    <form action="{{route('user#addToCart',$item->pizza_id)}}" method="post">
                      @csrf
                      <button type="submit" class="btn  btn-sm mainBtn"><i class="fas fa-cart-shopping "></i>Add to cart</button>

                    </form>
                  </div>


                </div>
              </div>

              @endif
            </li>
              @endforeach




            </ul>

            <div class="d-flex align-items-center justify-content-around text-white bg-success mt-3 p-3">
              <div class="  ">Beverages</div>
            </div>

              <ul id="lightSlider2">
                <li>
                  <div class="card mt-5" style="width: 15rem; height: 15rem;">
                    <div class="overflow-hidden" style="" >
                      <img src="{{asset('customer/img/cc.jpg')}}" class="card-img-top pImg" alt="Sunset Over the Sea" style="object-fit:cover;height: 100% !important;"/>

                    </div>
                      <div class="text-center card-bg bg-success">
                        <small class="card-text">Coca Cola</small><br>
                        <small>1200 Ks</small>
                      </div>
                    </div>
                  </li>
                <li>
                  <div class="card mt-5" style="width: 15rem; height: 15rem;">
                    <div class="overflow-hidden" style="height: 100%;">
                    <img src="{{asset('customer/img/ps.png')}}" class="card-img-top img-fluid pImg" alt="Sunset Over the Sea" style="  height: 100% !important;"/>

                    </div>
                    <div class="text-center card-bg bg-success">
                      <small class="card-text">Pepsi</small><br>
                      <small>1200 Ks</small>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="card mt-5" style="width: 15rem; height: 15rem;">
                    <div class="overflow-hidden"  style="height: 100%;">
                    <img src="{{asset('customer/img/org.png')}}" class="card-img-top img-fluid pImg" alt="Sunset Over the Sea" style="object-fit:cover;height: 100% !important;"/>

                    </div>
                    <div class="text-center  card-bg bg-success">
                      <small class="card-text">Fanta Orange</small><br>
                      <small>1200 Ks</small>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="card mt-5" style="width: 15rem; height: 15rem;">
                    <div class="overflow-hidden" style="height: 100%;">
                    <img src="{{asset('customer/img/sp.jpg')}}" class="card-img-top img-fluid pImg" alt="Sunset Over the Sea" style="object-fit:cover;height: 100% !important;"/>

                    </div>
                    <div class="text-center  card-bg bg-success">
                      <small class="card-text">Fanta Sprite</small><br>
                      <small>1200 Ks</small>
                    </div>
                  </div>
                </li>
              </ul>






            <div id="contact" class="text-center  text-white bg-success p-3 mt-2">Contact Us</div>


            <div class="d-flex justify-content-center mt-3 col-12 " id="">


              <div class="col-6">

                  <form action="{{route('user#sendMessage')}}" method="post">
                    @csrf
                      <div class="form-group">
                          <label for="name">Title</label>
                          <input type="text" name="title" class="form-control">
                          @if ($errors->has('title'))
                              <p class="text-danger">{{$errors->first('title')}}</p>
                          @endif
                      </div>
                      <div class="form-group">
                          <label for="message">Message</label>
                          <textarea name="message" class="form-control" cols="30" rows="5"></textarea>
                          @if ($errors->has('message'))
                              <p class="text-danger">{{$errors->first('message')}}</p>
                          @endif
                      </div>
                      <input type="submit" value="send" class="btn btn-sm btn-success mt-3" style="float: right;">
                  </form>
              </div>
            </div>
          </div>



      </div>
      <div class="col-lg-3 d-sm-none   mt-5 stk ms-3">
        <div class=" p-5" style="width: 100%; ">
          <div class="align-items-center ">
            <div class=" d-flex align-items-center justify-content-center ">
              <div class="dropdown">
                <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Menu <i class="fas fa-search"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('user#index')}}">ALL</a></li>
                  @foreach ($category as $item)
                  <li><a class="dropdown-item" href="{{route('user#chooseByCatName',$item->category_id)}}">{{$item->category_name}}</a></li>
                  @endforeach
                </ul>
              </div>
             </div> <br>
            <div class="" style="">
              <p class="text-center text-black">Filter By Price</p>
            <form action="{{route('user#searchByPrice')}}" style="width:100%;" method="post">
              @csrf
              <input type="number" name="min" id="" class="form-control" placeholder="Minimum">
              <input type="number" name="max" id="" class="form-control" placeholder="Maximum">
              <input type="submit" class="btn btn-sm btn-success mt-1 " style="float: right;" value="find">
            </form>
            </div> <br><br>
            <div class="" style=";">
              <p class="text-center text-black">Filter By Date</p>
            <form action="{{route('user#searchByDate')}}" style="width: 100%;" class="" method="post">
              @csrf
              <input type="date" name="from" id="" class="form-control" placeholder="">
              <input type="date" name="to" id="" class="form-control" placeholder="">
              <input type="submit" class="btn btn-sm btn-success mt-1 " style="float: right;" value="find">
            </form>
            </div> <br><br>

          </div>

        </div>
      </div>
        </div>


    </div>

</div>

    <div class="container">
      <div class="row">



      </div>
    </div>
@endsection
