{{-- @extends('customer.layout.style')
@section('content') --}}
    <!--================Single Product Area =================-->
	{{-- <div class="">
		<div class="container  mybody">

			<div class="row">
				<div class="col-12">
			<a href="{{route('user#index')}}" class="btn btn-sm btn-danger mt-3"><i class="fas fa-arrow-left "></i> Back</a>
			<div class="  py-3 d-flex align-items-center justify-content-center flex-wrap">
				@foreach ($data as $item)
				<div class="col-lg-6 ">
					<div class="">
						<img class="img-fluid rounded " src="{{asset('uploadedImages/'.$item->image)}}" alt="" >
					</div>
			</div>
			<div class="col-lg-5 offset-lg-1 mt-1">
					<h3 class=""> {{$item->pizza_name}} </h3>
					<h3 class="text-danger"><b>{{$item->price - $item->discount_price}} Ks</b></h3>
					<p class="text-primary text-decoration-line-through" style=""> ({{$item->price}} Ks)</p><hr>
					<h2 class="text-danger"> <b>{{$item->discount_percentage}} % OFF</b> </h2> <hr>
					<p class="" style="text-align: justify">{{$item->description}}</p>
						<hr> --}}
					<!-- Add to cart -->
					{{-- <form action="{{route('user#addToCart',$item->pizza_id)}}" method="post">
						@csrf
					<div class=" d-flex align-items-center justify-content-start ">
						<input type="number" name="quantity" class="form-control me-3" style="width:100px;" value="1">
					<button type="submit" class="btn btn-sm mainBtn">Add to Cart</button>
					</div>
					</form>
					 <hr>
						<br> <br>

								</div>
										@endforeach
									</div>
				</div>


			</div>
								</div> --}}
							{{-- </div> --}}
	<!--================End Single Product Area =================-->
{{-- @endsection --}}
