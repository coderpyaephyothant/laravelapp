@extends('admin.layout.style')

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        @if (Session::has('updateSuccess'))
              <div class="alert alert-dark alert-dismissible fade show" role="alert">
                {{Session::get('updateSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
        <div class="row mt-4">
          <div class="col-10 offset-2 mt-3">
            <div class="col-md-10">
              
              <div class="card">
                @if (Session::has('successChanged'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{Session::get('successChanged')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card-header p-2 bg-success">
                  <legend class="text-center ">My Profile</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action="{{route('admin#profileUpdate',$userID->id)}}">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{$userID->name}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{$userID->email}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                          <div class="col-sm-10">
                            <input type="number" name="phone" class="form-control"  placeholder="Phone" value="{{$userID->phone}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                          <div class="col-sm-10">
                            <input type="text" name="address" class="form-control"  placeholder="Address" value="{{$userID->address}}">
                          </div>
                        </div>
                        
                        
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-danger btn-sm">Submit</button>
                          </div>
                        </div>
                      </form>

                      <div class="form-group row">
                          
                        <div class="offset-sm-2 col-sm-10">
                            <!-- Button trigger modal -->

                              <a href="{{route('admin#passwordChange')}}">Change Password...</a>
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