<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pizza Order System</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
  .pagination{
    float: right;
  }
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link"  style="text-decoration: none";>

      <span class="brand-text font-weight-light "> Admin Control Panel </span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{route('admin#profile')}}" class="nav-link">
              <i class="fas fa-user-circle"></i>
              <p>
                My Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin#category')}}" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
                Category
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin#type')}}" class="nav-link">
              <i class="fas fa-fish"></i>
              <p>
                Type
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin#pizza')}}" class="nav-link">
              <i class="fas fa-pizza-slice "></i>
              <p>
                Pizza
              </p>
            </a>
          </li>

         <li class="nav-item">
            <a href="{{route('admin#userList')}}" class="nav-link">
            <i class="fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin#order')}}" class="nav-link">
              <i class="fas fa-book"></i>
              <p>
                Order
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin#message')}}" class="nav-link">
              <i class="fas fa-comment-dots"></i>
              <p>
                Messages
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin#carrier')}}" class="nav-link">
              <i class="fas fa-biking"></i>
              <p>
                Carrier
              </p>
            </a>
          </li>

          {{-- <a href="" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a> --}}


          <li class="nav-item">
            <form action=" {{route('logout')}} " method="POST">
              @csrf
              <div class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
                <p><input type="submit" value="Logout" class="btn btn-sm btn-dark"></p>
              </div>
          </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  @yield('content')

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('dist/js/md.js')}}"></script>

</body>
</html>
