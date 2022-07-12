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
                  <legend class="text-center text-danger">Edit Category</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{route('admin#updateCategory',$name->category_id)}}" method="POST">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Category Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Name"  name="name" value="{{old('name',$name->category_name)}}">
                            @if ($errors->has('name'))
                                <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                          </div>
                        </div>
                        <a href="{{route('admin#category')}}" class="btn btn-success">Back</a>
                        <input type="submit" value="Update" class="btn btn-danger">
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