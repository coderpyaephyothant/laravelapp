@extends('admin.layout.style')

@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-success">
                <p class="card-title">Order Table</p>

                <div class="card-tools mt-2">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <form action="{{route('admin#orderSearch')}}" method="">
                      @csrf
                      <div class="input-group input-group-sm" style="">
                        <input type="text" name="search" class="form-control" placeholder="Search">
    
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-white">
                            <i class="fas fa-search text-white"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Customer Name</th>
                      <th>Total Quatntity</th>
                      <th>Total Price</th>
                      <th>Order Date</th>
                      <th></th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($saleOrders as $item)
                    <tr>
                      <td>{{$item->saleId}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->total_quantity}}</td>
                      <td>{{$item->total_price}}</td>
                      <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>

                      <td>
                        <form action="{{route('admin#orderDetails',$item->saleId)}}" method="post">
                          @csrf
                        <button class="btn btn-sm btn-warning">More Details</button>

                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {{$saleOrders->links()}}
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection