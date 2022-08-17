@extends('admin.layout.style')


@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12  mt-3">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header p-2 bg-success">
                  <legend class="text-center">Order Details</legend>
                </div>
                <div class="card-body table-responsive">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <a href="{{route('admin#order')}}" class="btn btn-success">Back</a>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <p class="">Sale Order Id : {{$orderId[0]['id']}}</p>
                            <p class="">Order Date : {{date('d/m/Y',strtotime($orderId[0]['created_at']))}}</p>
                            <p>Customer Name : {{$user[0]['name']}}</p>
                            <div class="">
                                <table class="table table-responsive table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Pizza Name</th>
                                            <th>Quantity </th>
                                            <th>Price </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td ></td>
                                            <td >{{$item ['pizza_name']}}</td>
                                            <td >{{$item ['sale_quantity']}}</td>
                                            <td >{{$item ['sale_quantity'] * ($item ['price'] - $item ['discount_price'])}}Ks</td>
                                        </tr>
                                        @endforeach
                                        <tr class="text-center">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td ><div>Total : {{$item['total_price']}} Ks</div></td>
                                        </tr>
                                    </tbody>
                                </table>

                                    


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
      </div>
    </section>
  </div>
@endsection