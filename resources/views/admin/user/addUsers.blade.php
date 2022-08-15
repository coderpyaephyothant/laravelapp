@extends('admin.layout.style')
@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-8 offset-2">
          <div class="mt-2">
          <a href="{{route('admin#userList')}}"><button class="btn btn-sm btn-danger">Back</button></a>

          </div>
            <div class="card mt-3">
                <div class="card-header bg-success">
                  <p>Create Normal Customer Accounts</p>
                </div>
              
              <!-- /.card-header -->
              <div class="card-body table-responsive">
  
                  <form action="{{route('admin#createUsers')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="user name">
                    </div>
                    <div class="form-group">
                        <input type="number" name="phone" class="form-control" placeholder="user phone">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control"placeholder="user email">
                    </div>
                    <div class="form-group">
                        <input type="text" name="password" class="form-control"placeholder="user password">
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" class="form-control" placeholder="user address">
                    </div>
  
                    <div class=" d-flex align-items-center justify-content-center" style="">
                      <input type="submit" class="btn btn-sm btn-warning m-3 " value="create" >
                    </div>
                  </form>
                
              </div>
              <!-- /.card-body -->
            </div>
        </div>
          {{-- {{$userRole->links()}} --}}
          <!-- /.card -->
        </div>
      </div>
    </section>
@endsection