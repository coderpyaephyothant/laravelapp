@extends('admin.layout.style')

@section('content')
<div class="content-wrapper">
  @if (Session::has('success'))
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    {{Session::get('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if (Session::has('delete'))
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    {{Session::get('delete')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if (Session::has('updated'))
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    {{Session::get('updated')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-12 mt-3">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center bg-success ">
                <div class=""><a href="{{route('admin#pizzaCreate')}}"><button class="btn btn-danger btn-sm"><i class="fa fa-plus"></i></button></a></div>
                <h3 class="card-title">Pizza Table</h3>
                <div class="">

                  <form action="{{route('admin#pizzaSearch')}}" method="POST">
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
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>Number</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $id = 1;
                @endphp
                    @if ($fileNumber == 0)
                      <tr ><td colspan="7">
                        <p class="text-danger">No  datas to show here. . . .</p>
                        </td></tr>
                    @else
                    @foreach ($pizzaData as $item)

                    <tr>
                      <td>{{$id}}</td>
                      <td>{{$item->pizza_name}}</td>
                      <td>
                        {{-- <img src="https://st.depositphotos.com/1003814/5052/i/950/depositphotos_50523105-stock-photo-pizza-with-tomatoes.jpg" class="img-thumbnail" width="100px"> --}}
                        {{-- {{$item->image}} --}}
                        <img class="responsive img-thumbnail" width="200px" alt="Responsive image" src="{{asset('uploadedImages/'.$item->image)}}" alt="" >
                      </td>
                      <td>{{$item->price}}</td>
                      <td>
                          @if ($item->publish_status == 1)
                          Publish
                          @elseif ($item->publish_status == 0) 
                          Unpublish      
                          @endif
                          </td>
                      <td> @if ($item->buy_one_get_one == 1)
                        Yes
                        @elseif ($item->buy_one_get_one == 0) 
                        Not Now      
                        @endif</td>
                      <td>
                        <a class="text-decoration-none text-success" href="{{route('admin#pizzaEdit',$item->pizza_id)}}">Edit</a> &nbsp;
                        <a class="text-decoration-none text-danger" onclick="return confirm('Are you sure?')" href="{{route('admin#pizzaDelete',$item->pizza_id)}}">Delete</a> &nbsp;
                        <a class="text-decoration-none text-dark"  href="{{route('admin#pizzaDetail',$item->pizza_id)}}">SeeMore...</a>
                      </td>
                    </tr>                  
                    @php
                        $id ++;
                    @endphp
                     @endforeach
                    @endif
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