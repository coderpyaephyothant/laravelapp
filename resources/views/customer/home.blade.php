@extends('customer.layout.style')
@section('content')
    
  <!-- scroll to top start -->
  <button class="" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-caret-up"></i></button>
  <!-- scroll to top end -->
      
        <!-- carousel start -->
         
        <div class="container-fluid   ">
          <div class="row">

            
            
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <p>{{Session::get('success')}}</p>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>              
            @endif

            @if (Session::has('outOcStock'))
                <b class="text-danger">{{Session::get('outOcStock')}}</b>
            @endif
             <div class="col-12 mt-3  p-0 d-flex flex-wrao align-items-center justify-content-between" style="">
              <div class="col-7   " style="height:300px;" >
                <h3 style="margin-top: 15px;padding-left: 20px; ">Welcome to Pizza Myanmar</h3>
                <p style="text-align: justify;padding: 20px;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rerum doloribus non laboriosam eum natus. Excepturi, sapiente explicabo. Quasi accusantium repellat accusamus modi architecto, tempora sapiente, in, temporibus dolor soluta aperiam.
                  Deserunt laborum nihil exercitationem a quisquam odit quis nam, </p>
              </div>
               <!-- Slider main container -->

                <div class="swiper col-5" style="height:300px;">
                  <!-- Additional required wrapper -->
                  <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                      <img class="" src="{{asset('customer/img/veggie-pizza.jpg')}}" alt="" width="100%" style="object-fit:cover; height: 100%;">
                    </div>
                    <div class="swiper-slide">
                      <img class="" src="{{asset('customer/img/4formaggi_flickr.png')}}" alt="" width="100%" style="object-fit:cover; height: 100%;">
                    </div>
                    <div class="swiper-slide">
                      <img class="" src="{{asset('customer/img/5ortolana_saleepepe.jpg')}}" alt="" width="100%" style="object-fit:cover; height: 100%;">
                    </div>
                  
                  </div>
                  <!-- If we need pagination -->
                  <div class="swiper-pagination"></div>
  
                  <!-- If we need navigation buttons -->
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
  
                  <!-- If we need scrollbar -->
                  <!-- <div class="swiper-scrollbar"></div> -->
                </div>

             </div>
          </div>
        </div>

        <!-- carousel end -->

         <!-- Weekly Special start -->
         {{-- <div class="col-12 d-flex mt-3 bg-success p-2">
          <div class=" navbar-brand text-white ">Hot Pizzas</div>

        </div>

        
          <div class=" mt-2 mb-5 d-flex justify-content-around flex-wrap  ">
          @foreach ($pizzas as $item)
          <a href="{{route('user#pizzaDetails',$item->pizza_id)}}">
            <div class="card mt-5" style="width: 15rem; height: 10rem;">
              <img src="{{asset('uploadedImages/'.$item->image)}}" class="card-img-top" alt="Sunset Over the Sea" style="object-fit:cover;height: 90% !important;"/>
              <div class="text-center card-bg bg-success">
                <small class="card-text">{{$item->pizza_name}}</small><br>
                <small>{{$item->price}}</small>
              </div>
            </div>
          </a>
          @endforeach
        </div>  --}}
            
      <!-- Lists end -->

      <!-- pizzas and menus -->

          <div class="col-12 d-flex bg-success mt-2 p-2 align-items-center">
            <div class=" navbar-brand text-white  ">Pizzas</div>
            <div class=" ">
              <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Menu
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('user#index')}}">ALL</a></li>
                  @foreach ($category as $item)
                  <li><a class="dropdown-item" href="{{route('user#chooseByCatName',$item->category_id)}}">{{$item->category_name}}</a></li>
                  @endforeach
                </ul>
              </div>
             </div>
       
        

            </div>

      <!-- pizzas and menus end -->
      


       <!-- Lists start -->
<div class="container-fluid">
  <div class="row">
    <div class="p-0 d-flex flex-wrap align-items-center">
      {{-- <dd>{{$item}}</dd> --}}

      <div class="bg-dark" style="width: 100%; ">
        <div class="d-flex align-items-center justify-content-start ">
          <div class="m-3" style="">
            <p class="text-center text-white">Search By Price</p>
          <form action="{{route('user#searchByPrice')}}" style="width:100%;" method="post">
            @csrf
            <input type="number" name="min" id="" class="form-control" placeholder="Minimum">
            <input type="number" name="max" id="" class="form-control" placeholder="Maximum">
            <input type="submit" class="btn btn-sm btn-success mt-1 " style="float: right;" value="find">  
          </form>
          </div>
          <div class="m-3" style=";">
            <p class="text-center text-white">Search By Date</p>
          <form action="{{route('user#searchByDate')}}" style="width: 100%;" class="" method="post">
            @csrf
            <input type="date" name="from" id="" class="form-control" placeholder="">
            <input type="date" name="to" id="" class="form-control" placeholder="">
            <input type="submit" class="btn btn-sm btn-success mt-1 " style="float: right;" value="find">
          </form>
          </div>
        </div>
        
      </div>

        <div class="col-12 mb-5 d-flex justify-content-evenly flex-wrap ">
          @if ($Number == 0)
                <p class="text-danger"><b>No  Datas to show here. . . .</b></p>
                    
                @endif
                
          @foreach ($pizzas as $item)
          @if ($item->publish_status > 0  && $item->quantity > 0 )

          <div class="card mt-5 shadow-sm pB " style="width: 15rem; height: 25rem;">
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

          @endforeach

          </div>

    </div>
  </div>
</div>
  {{-- Sauce Start --}}
  <div class="col-12 d-flex bg-success mt-2 p-2 align-items-center">
    <div class=" navbar-brand text-white  ">Sauces</div>
    </div>
  {{-- Sauce End --}}





      {{-- Drinks start--}}
      <div class="col-12 d-flex bg-success mt-2 p-2">
        <div class=" navbar-brand text-white  ">Beverages</div>
        <div class=" ">
          <select class="  mt-2 form-select form-select-sm bg-success text-white " >
            <option selected>Menu</option>
            <option value="1">Coca Cola</option>
            <option value="2">Pepsi</option>
            <option value="3">Gone Cha</option>
            <option value="4">Others</option>
        
          </select>
         </div>
        </div>
        <div class=" mt-2 mb-5 d-flex justify-content-around flex-wrap  ">
          <div class="card mt-5" style="width: 15rem; height: 15rem;">
            <div class="overflow-hidden" style="" >
              <img src="{{asset('customer/img/cc.jpg')}}" class="card-img-top pImg" alt="Sunset Over the Sea" style="object-fit:cover;height: 100% !important;"/>

            </div>
              <div class="text-center card-bg bg-success">
                <small class="card-text">Coca Cola</small><br>
                <small>$15</small>
              </div>
            </div>
            <div class="card mt-5" style="width: 15rem; height: 15rem;">
              <div class="overflow-hidden" style="height: 100%;">
              <img src="{{asset('customer/img/ps.png')}}" class="card-img-top img-fluid pImg" alt="Sunset Over the Sea" style="  height: 100% !important;"/>

              </div>
              <div class="text-center card-bg bg-success">
                <small class="card-text">Pepsi</small><br>
                <small>$15</small>
              </div>
            </div>
            <div class="card mt-5" style="width: 15rem; height: 15rem;">
              <div class="overflow-hidden"  style="height: 100%;">
              <img src="{{asset('customer/img/org.png')}}" class="card-img-top img-fluid pImg" alt="Sunset Over the Sea" style="object-fit:cover;height: 100% !important;"/>

              </div>
              <div class="text-center  card-bg bg-success">
                <small class="card-text">Fanta Orange</small><br>
                <small>$15</small>
              </div>
            </div>
            <div class="card mt-5" style="width: 15rem; height: 15rem;">
              <div class="overflow-hidden" style="height: 100%;">
              <img src="{{asset('customer/img/sp.jpg')}}" class="card-img-top img-fluid pImg" alt="Sunset Over the Sea" style="object-fit:cover;height: 100% !important;"/>
                
              </div>
              <div class="text-center  card-bg bg-success">
                <small class="card-text">Fanta Sprite</small><br>
                <small>$15</small>
              </div>
            </div>
        </div> 

        
        {{-- Drinks end --}}
          
    <!-- Lists end -->

    <!-- button -->
    <div class="container-fluid">
      <div class="row">
        
          <div class=" bg-success p-2">
            <div class=" navbar-brand text-white ">Contact Us</div>
          </div>
          <div class="mt-3  p-2 d-flex justify-content-center" id="contact">
           

                  <div class=" col-4 mt-3 ">
                    @if (Session::has('sent'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      {{Session::get('sent')}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
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
@endsection