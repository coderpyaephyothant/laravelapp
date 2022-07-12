@extends('admin.layout.style')

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12  mt-3">
            <div class="col-md-12">
              <div class="card">
                <div class="bg-success p-1">
                  <h5 class="text-center text-white">Create Pizza &nbsp;<i class="fas fa-pizza-slice"></i></h5>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{route('admin#pizzaInsert')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">New Pizza Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Name"  name="name"  value="{{old('name')}}">
                            @if ($errors->has('name'))
                                <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label"> Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" placeholder="Name"  name="image"  value="{{old('image')}}">
                              @if ($errors->has('image'))
                                  <p class="text-danger">{{$errors->first('image')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="desc" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <textarea name="desc" id="" cols="10" rows="5" class="form-control">{{old('desc')}}</textarea>
                              @if ($errors->has('desc'))
                                  <p class="text-danger">{{$errors->first('desc')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Price"  name="price" value="{{old('price')}}">
                              @if ($errors->has('price'))
                                  <p class="text-danger">{{$errors->first('price')}}</p>
                              @endif
                            </div>
                        </div>
                            <div class="form-group row">
                                <label for="public" class="col-sm-2 col-form-label">Public Status</label>
                                <div class="col-sm-10">
                                    <select name="ps"  class="form-control">
                                        <option value="" active>choose</option>
                                        <option value="1">Publish</option>
                                        <option value="0">Unpublish</option>
                                      </select>
                                  @if ($errors->has('ps'))
                                      <p class="text-danger">{{$errors->first('ps')}}</p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="discount" class="col-sm-2 col-form-label">Discount Price</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="discount"  name="discount" value="{{old('discount')}}">
                                  @if ($errors->has('discount'))
                                      <p class="text-danger">{{$errors->first('discount')}}</p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="category" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select name="category"  class="form-control">
                                        <option value="" active>choose category</option>
                                        @foreach ($categoryData as $item)
                                        <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                        @endforeach
                                      </select>
                                  @if ($errors->has('category'))
                                      <p class="text-danger">{{$errors->first('category')}}</p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="bg" class="col-sm-2 col-form-label">buy1get1</label>
                                <div class="col-sm-10">
                                  <div class="form-control">
                                    <input type="radio" name="bg" value="1" class="form-input-check">&nbsp;Yes &nbsp;
                                    <input type="radio" name="bg" value="0" class="form-input-check">&nbsp;No
                                  </div>

                                  @if ($errors->has('bg'))
                                      <p class="text-danger">{{$errors->first('b1g1')}}</p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="wt" class="col-sm-2 col-form-label">Waiting Time</label>
                                <div class="col-sm-10">
                                  <input type="number" class="form-control" placeholder="waiting time"  name="wt" value="{{old('wt')}}">
                                  @if ($errors->has('wt'))
                                      <p class="text-danger">{{$errors->first('wt')}}</p>
                                  @endif
                                </div>
                              </div>
                        <a href="{{route('admin#pizza')}}" class="btn btn-success">Back</a>
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