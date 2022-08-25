@extends('customer.layout.style')
@section('content')
    <div class="container-fluid mybody">
        <div class="col-12 mt-5"> <br> <br>
          @if (Session::has('success'))
          <p class="text-success">{{Session::get('success')}}</p>
  
@endif     
@if (Session::has('fail'))
          <p class="text-danger">{{Session::get('fail')}}</p>
  
@endif  

@if (Session::has('outOcStock'))
          <div class="text-center"><b class="text-danger ">{{Session::get('outOcStock')}}</b></div>
  
@endif 

@if (Session::has('please'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('please')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
  
@endif 
			    <a href="{{route('user#index')}}" class="btn btn-sm btn-danger mb-3 "><i class="fas fa-arrow-left "></i> Back</a>
          
{{-- table start --}}
        <table class="table"> 
            <thead>
             
              <tr>
              
                @if ($errors->has('quantity'))
                    
                <p class="text-danger text-center">( Quantity must be at least 1 Or you can delete )</p>
               
            @endif
                <th width="5%" scope="col">Number</th>
                <th width="20%" scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price (Kyat)</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
             
             @if ($totalQty)
             @if ($totalQty == 0 )
             <tr ><td colspan="7">
                   <div class="text-danger text-center"><b>no data</b></div>
                  </td>
                  </tr>
              @endif 
             @endif

              
                 @php
                      $i = 1;
                 @endphp
            

              @if ($pizzas != null)
              @foreach ($pizzas as $product)
              <tr>
                 
                <td>{{$i}}</td>
                <td>{{$product['item']['pizza_name']}}</td>
                <td><img src="{{asset('uploadedImages/'.$product['item']['image'])}}" alt="cartImg" width="100px"></td>
                <td>
                <form action="{{route('user#quantityUpdate',$product['item']['pizza_id'])}}" method="post">
                  @csrf
                   <input class="orderQtyInput" name="quantity" type="number" value="{{$product['quantity']}}">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                </form>
              </td>
                <td>{{$product['price']}}</td>
                <td>
                  <a href="{{route('user#deleteOrderItem',$product['item']['pizza_id'])}}"><button class="btn btn-sm btn-danger">Delete</button></a>
                </td>
                @php
                    $i ++
                @endphp
                
                @endforeach
              @endif
              </tr>
            </tbody>
          </table>
          {{-- table end --}}

          <div class="container-fluid d-flex justify-content-end  " style="">
            <div class="  col-4 align-items-center">
              <div class="d-flex  flex-column">
                <div class="">Total Price : {{$totalPrice}} Kyats</div> <hr>
                <div class="">Total Quantity : {{$totalQty}}</div> <hr>
                <div class="d-flex align-items-center justify-content-around">
                  <a href="{{route('user#checkout')}}"><button class="btn btn-sm btn-warning">order submit</button></a> <br>   
                <a href="@if ($totalQty == null)
                  {{'user#index'}}
                @else
                {{route('user#cartClear')}}
                @endif" style="" ><button class="btn btn-sm btn-danger">clear cart</button></a>  
                </div>    
              </div>                     
            </div>
        </div>
      </div>
    </div>
@endsection

 {{-- <p>Payment System :</p>           
              <div class="">
                <div class=" d-flex justify-content-center   " style="">
                  <div>
                    <input type="radio" name="payment" >
                <span>Cash on delivery</span> <br>
                <input type="radio" name="payment" >
                <span>Card </span> <br>
                <input type="radio" name="payment" >
                <span>Banking </span>
                  </div>
                </div>
                <br>

              </div>
              
             <hr>
             <div>
              <p>Township : </p>
              <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option selected>Choose</option>
                <option value="1">China Town</option>
                <option value="2">Lanmadaw</option>
                <option value="3">Hledan</option>
                <option value="3">Hlaing</option>
                <option value="3">Tamwe</option>
                <option value="3">Insein</option>
              </select>
             </div><hr>
             <div class="d-flex justify-content-center">
          <button class="btn btn-sm btn-warning"> Order Now <i class="fas fa-check"></i> </button>
             </div> --}}