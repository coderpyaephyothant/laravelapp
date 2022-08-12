@extends('customer.layout.style')
@section('content')
<div class="container-fluid" >
    <div class="row " >
        
        <div class="d-flex justify-content-center" >


            <div class="col-md-6 ">
                <a href="{{route('user#index')}}" class="btn btn-sm btn-danger mt-3 mb-3"><i class="fas fa-arrow-left "></i> Back</a>

                <div class="card  mb-5">
                    <div class="card-header bg-success text-center">
                      <h3 class="card-title text-white">Checkout </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                            </div> <br>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                            </div> <br>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                            </div> <br>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                            </div> <br>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Payment system</label>
                            <div>
                                <select name="" id="" class="form-control ">
                                    <option value="0" selected>Choose</option>
                                    <option value="1">Cash on delivery</option>
                                    <option value="2">Card Pay</option>
                                    <option value="3">Mobile Pay</option>
                                </select>
                            </div>
                            </div> <br>
                            <div class="form-group">
                                <p>Total Quantity : <span class="text-danger"><b>{{$totalQty}}</b></span></p>
                                <p>Total Prices : <span class="text-danger"><b>{{$totalPrice}}</b></span> Kyats</p>
                            </div>
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</div>
@endsection
