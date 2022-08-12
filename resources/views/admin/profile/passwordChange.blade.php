@extends('admin.layout.style')

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12  mt-3">
            <div class="col-md-12">
              <div class="card">
                @if (Session::has('newpasswordError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{Session::get('newpasswordError')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('oldpasswordError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{Session::get('oldpasswordError')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif               
                @if (Session::has('passwordLengthError'))
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                  {{Session::get('passwordLengthError')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif               
                <div class="card-header p-2 bg-danger">
                  <legend class="text-center text-white ">Change Password <i class="fas fa-key"></i></legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{route('admin#checkPassword',Auth()->user()->id)}}" method="post">
                        @csrf
                        <div class="form-group row">
                          <label for="oldpassword" class="col-sm-2 col-form-label">Old Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="oldpassword">
                            @if ($errors->has('oldpassword'))
                                <p class="text-danger">{{$errors->first('oldpassword')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="newpassword" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="newpassword">
                              @if ($errors->has('newpassword'))
                                  <p class="text-danger">{{$errors->first('newpassword')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="confirmpassword" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="confirmpassword">
                              @if ($errors->has('confirmpassword'))
                                  <p class="text-danger">{{$errors->first('confirmpassword')}}</p>
                              @endif
                            </div>
                          </div>
                        <a href="{{route('admin#profile')}}" class="btn btn-success">Back</a>
                        <input type="submit" value="Create" class="btn btn-danger">
                      </form>
                      
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