@extends('admin.layout.style')

@section('content')

<div class="content-wrapper">
  @if (Session::has('success'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{Session::get('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if (Session::has('deleted'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{Session::get('deleted')}}
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
        <div class="row  col-12">
          <div class="">
            <div class="card mt-3">
              <div class="bg-success d-flex align-items-center flex-wrap justify-content-around p-3">
                <a class="me-3" href="{{route('admin#addCategory')}}"><button class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></button></a>
                  <a class=" text-decoration-none me-3 text-white">Category Table</a>
                <div class="">
                  <a class="btn btn-sm btn-success">Total: {{$categoriesData->total()}}</a>
                  <a class=" text-decoration-none btn btn-sm btn-success" href="">csv download <i class="fas fa-download"></i></a>
                </div>
                
                
                <div class=" mt-1">
                  <form action="{{route('admin#searchCategory')}}" method="get">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form> 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>Number</th>
                      <th>Category Name</th>
                      <th>Products</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $id = 1;
                @endphp
                    
                    


                     @foreach ($categoriesData as $item)
                    
                     <tr>
                      <td>{{$id}}</td>
                     <td>{{$item->category_name}}</td>
                     <td>
                      {{-- $item->search == null --}}
                      {{-- <a href="#" class="text-decoration-none bg-dark px-1">empty</a>                    --}}

                    @if ($item->count == 0)
                     <a href="#" class="text-decoration-none bg-danger px-1">{{$item->count}}</a>
                     @else
                     <a href="{{route('admin#categoryItem',$item->category_id)}}" class="text-decoration-none bg-danger px-1">{{$item->count}}</a>
                     @endif
                    </td>
                     <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                     <td>
                       <a class="text-decoration-none text-success" href="{{route('admin#categoryEdit',$item->category_id)}}">Edit</a> &nbsp;
                       <a class="text-decoration-none text-danger" onclick="return confirm('Are you sure?')" href="{{route('admin#categoryDelete',$item->category_id)}}">Delete</a>
                     </td>
                    </tr>
                    @php
                        $id ++;
                    @endphp
                     @endforeach
                    
                  </tbody>
                </table>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {{$categoriesData->links()}}
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection