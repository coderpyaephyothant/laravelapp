@extends('admin.layout.style')

@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if (Session::has('deleteSuccess'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{Session::get('deleteSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
        <div class="row ">

          <div class="col-12">
              
            <div class="card mt-3">

              <!-- Example single danger button -->

              
              <div class="card-header bg-success p-3">
                <a href="{{route('admin#addUsers')}}"><button class="btn btn-sm btn-danger"> <i class="fas fa-plus"></i> </button></a>
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Select
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('admin#userList')}}">Customers</a></li>
                    <li><a class="dropdown-item" href="{{route('admin#adminList')}}">Admins</a></li>
                  </ul>
                </div>
                <a class=" text-decoration-none btn btn-sm btn-success" href="">csv download <i class="fas fa-download"></i></a>

                <div class="card-tools mt-1">
                  <form action="{{route('admin#userListSearch')}}" method="get">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                  
                </div>
                <span class="btn btn-sm btn-success">Total Customer :  {{$userRole->total()}} </span>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($userRole as $item)
                      <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->address}}</td>
                        <td>
                          {{-- <a class="text-decoration-none text-success" href="">Edit</a> &nbsp; --}}
                        <a onclick="return confirm('Are you sure?')" class="text-decoration-none text-danger" href="{{route('admin#userDelete',$item->id)}}">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            {{$userRole->links()}}
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection