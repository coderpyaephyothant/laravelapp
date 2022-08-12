

  <div class="container-fluid mt-2 position-sticky  bar ">
    <div class="row  ">
       <!-- nav start -->
       <nav class="navbar navbar-expand-lg navbar-light bg-success d-flex justify-content-around  align-items-center">
        
        <div class="">
          <a class="navbar-brand text-white hedname me-5" href="#">Pizza Myanmar</a>
        </div>

        

        <a class="text-decoration-none" href="{{route('user#orderList')}}">
          <div class="bg-white d-flex align-items-center justify-content-center headerCart" style="padding:10px;line-height:10px; border-radius:50%;position:relative">
            <i class="fas fa-cart-shopping text-success"></i>
            <div class="mx-1 text-white bg-danger " style="position: absolute;border-radius:5%; top:-10px;right:-25px;padding:7px;line-height:5px;">{{ Session::has('cart') ? Session::get('cart')->totalQuantity : 0 }}</div>
          </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
         
        <div class="">
          <div class="collapse navbar-collapse " id="navbarTogglerDemo02" style="">

            <div class="d-flex justify-content-end">
              <div class=" ">
                <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
              </div>
              <div class=" ">
                <a class="nav-link text-white" aria-current="page" href="#">Service</a>
              </div>
              <div class="">
                <a class="nav-link text-white " aria-current="page" href="#">Contact</a>
              </div> 
              <div class=" text-white btn  btn-outline-warning me-2">
                <i class="fas fa-user "></i>
              {{auth()->user()->name}}
              </div>
              <div class="">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <input type="submit" class="btn btn-success btn-sm px-3 me-2 mb-1" value="Logout">
              </form>
              </div>         
            </div>

          </div>
        </div>
        </nav>
        <!-- nav end -->
        </div>
    </div>

  
  