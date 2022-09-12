@extends('admin.layout.style')

@section('content')

<div class="content-wrapper">
  @if (Session::has('successDelete'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{Session::get('successDelete')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-3 col-12">
          <div class="">
            <div class=""><a href="{{route('admin#type')}}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left "> Back</i></a></div>
            <div class="card mt-3">
              <div class="card-header bg-success">
                <h3 class="card-title">
                  {{-- <a href="{{route('admin#addCategory')}}"><button class="btn btn-sm btn-success text-decoration-underline">Item Lists</button></a> --}}
                  <a class="btn btn-sm btn-success">Total Items: {{$pizzaData->count()}} </a>
                </h3>


                {{-- <div class="card-tools mt-1">
                  <form action="" method="get">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="search" class="form-control float-right" placeholder="Search items">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>Number</th>
                      <th>Pizza Name</th>
                      <th>Type Menu Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $id = 1;
                @endphp
                     @foreach ($pizzaData as $item)

                     <tr>
                      <td>{{$id}}</td>
                     <td>{{$item->pizza_name}}</td>
                     <td>{{$item->type_name}}</td>
                     <td>
                        <img class="responsive img-thumbnail" width="200px" src="{{asset('uploadedImages/'.$item->image)}}" alt="{{$item->pizza_name}}">
                     </td>
                     <td>{{$item->price}}</td>
                     <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>

                     <td>
                       <a class="text-decoration-none text-danger" onclick="return confirm('Are you sure?')" href="{{route('admin#categoryItemDelete',$item->pizza_id)}}">Delete</a>
                     </td>
                    </tr>
                    @php
                        $id ++;
                    @endphp
                     @endforeach

                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {{$pizzaData->links()}}
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
