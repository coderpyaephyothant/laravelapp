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
        <div class="row mt-4">
          <div class="col-md-10 offset-1">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{route('admin#addCategory')}}"><button class="btn btn-sm btn-danger">Add Category</button></a>
                </h3>

                <div class="card-tools">
                  <form action="{{route('admin#searchCategory')}}" method="post">
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
                      <th>Created Date</th>
                      <th></th>
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
                     <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                     <td>
                       <a href="{{route('admin#categoryEdit',$item->category_id)}}"><button class="btn btn-sm btn-success"><i class="fas fa-edit"></i></button></a>
                       <a onclick="return confirm('Are you sure?')" href="{{route('admin#categoryDelete',$item->category_id)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
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