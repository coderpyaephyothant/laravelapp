@extends('admin.layout.style')


@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12  mt-3">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center text-danger">Details</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <a href="{{route('admin#pizza')}}" class="btn btn-success">Back</a><hr>
                        <div class="text-center">
                            <h3 class="text-success">{{$data->pizza_name}}</h3>
                        </div> <br>

                        <div class="mx-5">
                            <div class="">
                                <span class="font-weight-bold">Pizza ID :</span>
                                <span class="px-3">{{$data->pizza_id}}</span>
                            </div><br>
                            <div class="">
                                <span class="font-weight-bold">Pizza Image :</span>
                                <span class="px-3"><img  class="rounded  img-fluid w-50" src="{{asset('uploadedImages/'.$data->image)}}" alt=""></span>
                            </div><br>
                            <div class="">
                                <span class="font-weight-bold">Pizza Price :</span>
                                <span class="px-3">{{$data->price}}</span>
                            </div><br>
                            <div class="">
                                <span class="font-weight-bold">Pizza Description :</span>
                                <span class="px-3">{{$data->description}}</span>
                            </div><br>
                            <div class="">
                                <span class="font-weight-bold">Pizza Status :</span>
                                <span class="px-3">@if ($data->publish_status == 0)
                                    Not Avaliable
                                @else
                                    Avaliable Now
                                @endif</span>
                            </div><br>
                            <div class="">
                                <span class="font-weight-bold">Pizza Discount  :</span>
                                <span class="px-3"> - {{$data->discount_price}}</span>
                            </div><br>
                            <div class="">
                                <span class="font-weight-bold">Pizza Category :</span>
                                <span class="px-3">@foreach ($categoryData as $item)
                                    @if ($data->category_id == $item->category_id)
                                    {{$item->category_name}} 
                                @endif
                                @endforeach</span>
                            </div><br>
                            <div class="">
                                <span class="font-weight-bold">Buy One Get One :</span>
                                <span class="px-3">@if ($data->buy_one_get_one == 0 )
                                    Comming Soon...
                                @else
                                    Yes.
                                @endif</span>
                            </div><br>
                            <div class="">
                                <span class="font-weight-bold">Waiting tinme :</span>
                                <span class="px-3"> {{$data->waiting_time}} - Minutes</span>
                            </div><br>
                        </div>


                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection