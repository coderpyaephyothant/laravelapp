@extends('admin.layout.style')

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row ">

          <div class="col-10 offset-1  mt-3">
            <a href="{{route('admin#pizza')}}" class="btn btn-danger mb-2 btn-sm">Back</a>
            <div class="">
              <div class="card">
                <div class="bg-success p-2">
                  <p class="text-center text-white">Edit Pizzas Details Now...&nbsp;<i class="fas fa-pizza-slice"></i></p>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">

                      <form class="form-horizontal" action="{{route('admin#pizzaUpdate',$data->pizza_id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">New Pizza Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Name"  name="name"  value="{{old('name',$data->pizza_name)}}">
                            @if ($errors->has('name'))
                                      <p class="text-danger">{{$errors->first('name')}}</p>
                                  @endif
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label"> Image</label>
                            <div class="col-sm-10">
                                <img  src="{{asset('uploadedImages/'.$data->image)}}" alt="" width="200px"> <br>
                                {{-- <p for="">{{$data->image}}</p> --}}
                                <p for="image" class="text-success">you can choose new image to update...</p>
                              <input type="file" class="form-control" name="image" >

                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="desc" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <textarea name="desc" id="" cols="10" rows="5" class="form-control">{{old('desc',$data->description)}}</textarea>
                              @if ($errors->has('desc'))
                              <p class="text-danger">{{$errors->first('desc')}}</p>
                          @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Price"  name="price" value="{{old('price',$data->price)}}">
                              @if ($errors->has('price'))
                              <p class="text-danger">{{$errors->first('price')}}</p>
                          @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="" class="col-sm col-form-label">State New/Old</label>
                          <div class="col-sm-10">
                            <select name="state" id="" class="form-control">
                              <option value="" @if ($data->new == "")
                                selected
                              @endif>choose</option>
                              <option value="1"@if ($data->new == 1)
                                selected
                              @endif>new product</option>
                              <option value="0" @if ($data->new == 0)
                                selected
                              @endif>old product</option>
                            </select>
                            @if ($errors->has('state'))
                            <p class="text-danger">{{$errors->first('state')}}</p>
                        @endif
                          </div>
                          </div>

                        {{-- end new --}}
                            <div class="form-group row">
                                <label for="public" class="col-sm-2 col-form-label">Public Status</label>
                                <div class="col-sm-10">
                                    <select name="ps"  class="form-control">
                                        <option value="" @if ($data->publish_status == "")
                                            selected
                                        @endif>choose</option>
                                        <option value="1" @if ($data->publish_status == 1)
                                            selected
                                        @endif>Publish</option>
                                        <option value="0"@if ($data->publish_status == 0)
                                            selected                                        @endif>Unpublish</option>
                                      </select>
                                      @if ($errors->has('ps'))
                                      <p class="text-danger">{{$errors->first('ps')}}</p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="discount" class="col-sm-2 col-form-label">Discount Percentage (%)</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="discount percentage"  name="discount_percentage" value="{{old('discount_percentage',$data->discount_percentage)}}">
                                  @if ($errors->has('discount_percentage'))
                                  <p class="text-danger">{{$errors->first('discount_percentage')}}</p>
                              @endif
                                </div>
                              </div>
                                <div class="form-group row">
                                  <label for="quantity" class="col-sm-2 col-form-label">Quantity </label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="quantity"  name="quantity" value="{{old('quantity',$data->quantity)}}">
                                    @if ($errors->has('quantity'))
                                  <p class="text-danger">{{$errors->first('quantity')}}</p>
                              @endif
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label for="category" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select name="category"  class="form-control">
                                        <option value="" active>choose category</option>
                                        @foreach ($categoryData as $item)
                                        <option value="{{$item->category_id}}" @if ($data->category_id == $item->category_id)
                                            selected
                                        @endif>{{$item->category_name}}</option>
                                        @endforeach
                                      </select>
                                      @if ($errors->has('category'))
                                  <p class="text-danger">{{$errors->first('category')}}</p>
                              @endif
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="category" class="col-sm-2 col-form-label">Types</label>
                                <div class="col-sm-10">
                                    <select name="type"  class="form-control">
                                        <option value="" active>choose pizza types</option>
                                        @foreach ($typeData as $item)
                                        <option value="{{$item->type_id}}" @if ($data->type == $item->type_id)
                                            selected
                                        @endif>{{$item->type_name}}</option>
                                        @endforeach
                                      </select>
                                      @if ($errors->has('type'))
                                  <p class="text-danger">{{$errors->first('type')}}</p>
                              @endif
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="bg" class="col-sm-2 col-form-label">buy1get1</label>
                                <div class="col-sm-10">
                                  <div class="form-control">
                                    <input type="radio" name="bg" value="1" @if ($data->buy_one_get_one == 1)
                                        checked
                                    @else
                                        unchecked
                                    @endif class="form-input-check">&nbsp;Yes &nbsp;
                                    <input name="bg" type="radio" @if ($data->buy_one_get_one == 0)
                                        checked
                                    @else
                                        unchecked
                                    @endif  value="0" class="form-input-check">&nbsp;No
                                  </div>
                                  @if ($errors->has('bg'))
                                  <p class="text-danger">{{$errors->first('bg')}}</p>
                              @endif

                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="wt" class="col-sm-2 col-form-label">Waiting Time</label>
                                <div class="col-sm-10">
                                  <input type="number" class="form-control" placeholder="waiting time"  name="wt" value="{{old('wt',$data->waiting_time)}}">
                                  @if ($errors->has('wt'))
                                  <p class="text-danger">{{$errors->first('wt')}}</p>
                              @endif
                                </div>
                              </div>

                        <div class="d-flex align-items-center justify-content-center"><input type="submit" value="Update" class="btn btn-warning"></div>
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
