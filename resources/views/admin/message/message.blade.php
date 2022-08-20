@extends('admin.layout.style')

@section('content')

<div class="content-wrapper mt-3">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex bg-success col-12 justify-content-between align-items-center p-3">
                <div class=""><p class=" bg-success text-center">Messages</p></div>

            <div class="card-tools ">
                <form action="{{route('admin#messageSearch')}}" method="get">
                  @csrf
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="messageSearch" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
                
              </div>
            </div>
            <div class="col-12 d-flex flex-wrap">
                @if ($msgNumber == 0)
                <p class="text-danger"><b>No  message to show here. . . .</b></p>
                    
                @endif
        @foreach ($messageData as $item)
                        
                <div class="col-4 mt-3" >

                    <div class="card bg-success" >
                        <div class="card-header">
                            <button class="btn btn-sm btn-outline-warning">{{ $item->name}} </button>
                            <span style="float: right">{{ date('d-m-Y', strtotime( $item->created_at))}}</span>
                        </div>
                        <div class="card-body"   style="height: 200px; position: relative; overflow:hidden; overflow-y: scroll;  ">
                            <p>Email : {{ $item->email}}</p>
                                <p>Title : {{ $item->title}}</p >
                                <span style="text-align: justify;">Message : {{$item->message}}</span>
                        </div>                           
                </div>
                </div>
            @endforeach
            
           </div>
           {{$messageData->links()}}
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    
@endsection

