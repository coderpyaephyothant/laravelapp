

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Oppa's Pizzas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  

  <!-- Font Awesome -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
rel="stylesheet"
/>
  <!-- Google Fonts -->
<link
href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
rel="stylesheet"
/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
<link
  rel="stylesheet"
  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<!-- Style Link -->
<link rel="stylesheet" href="{{asset('customer/css/style.css')}}">

</head>
<body >
     <!-- scroll to top start -->
  <button class="" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-caret-up"></i></button>
  <!-- scroll to top end -->

  <div class="container-fluid mt-2 position-sticky  bar ">
    <div class="row  ">
 
       <nav class="navbar navbar-expand-lg navbar-light bg-success d-flex justify-content-around  align-items-center">
        
        <div class="">
          <a class="navbar-brand text-white hedname me-5" href="#">Oppa's Pizzas</a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
         
        <div class="">
          <div class="collapse navbar-collapse " id="navbarTogglerDemo02" style="">

            <div class="d-flex justify-content-end">
              <div class=" ">
                <a class="nav-link active text-white" aria-current="page" href="{{route('user#home')}}">Home</a>
              </div>
              <div class=" ">
                <a class="nav-link text-white" aria-current="page" href="{{route('user#index')}}">Shop</a>
              </div>

              @if (Auth::check())
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
              @else 
                <div class="">
                <a class="nav-link text-white " aria-current="page" href="{{ route('login') }}">Login</a>
              </div>
              <div class="">
                <a class="nav-link text-white " aria-current="page" href="{{ route('register') }}">Register</a>
              </div>            
              @endif
            </div>

          </div>
        </div>
        </nav>

        </div>
    </div>

  
    <div class="mt-3">
        
        <div class="container">
            <div class="row">
                <div class="d-flex align-items-center bg-danger mb-2">
                  <div style="width: 50%;">
                    <img src="{{asset('customer/img/simple.png')}}" width="100%;" alt="">
                  </div>
                  <div class=" text-white p-3" style="width: 50%;">
                  <h2 class="myfont2">Welcome to Oppa's Pizzas.</h2>
                  <P class="myfont">" Hello.Our pizzas are so delisious, healthy , best & fast services around the world. Our pizzas are selling with 2000 shops in various countries. We also selling special veggie pizzas for vegan customers."</P>
                  <div class=" d-flex align-items-center justify-content-start">
                    
                      <a href="{{route('user#index')}}"><button class="btn mainBtn">Shop Now <i class="fas fa-circle-arrow-right"></i> </button></a>
                  </div> 
                </div>
                
                </div> 

                <div class="d-flex align-items-center flex-column justify-content-center mt-3 mb-2">
                  <h4 class="">Enjoy your great times with our special pizzas !</h4>
              </div> 
              <hr>
              <div class="d-flex align-items-center justify-content-around mt-3 mb-3">
                    
                <div class="" style="width: 25rem;height:15rem;">
                    <img class="" src="{{asset('customer/img/set6.jpg')}}" width="100%" height="100%;" alt="">
                </div>
                <div class="" style="width: 25rem;height:15rem;">
                  <img class="" src="{{asset('customer/img/set7.jpg')}}" width="100%" height="100%;" alt="">
              </div>
                
            </div> 
            <div class="d-flex align-items-center flex-column justify-content-center mt-3 mb-2">
              <h4 class="">Our Partners</h4>
          </div> <hr>
          <div class="d-flex align-items-center justify-content-around mt-3 ">
            <div class="" style="width: 7rem;height:5rem;">
              <img class="" src="{{asset('customer/img/coca-cola.png')}}" width="100%" height="80%;" alt="">
          </div>
          <div class="" style="width: 6rem;height:5rem;">
            <img class="" src="{{asset('customer/img/nestle.png')}}" width="100%" height="80%;" alt="">
        </div>
        <div class="" style="width: 8rem;height:5rem;">
          <img class="" src="{{asset('customer/img/mcd.png')}}" width="100%" height="80%;" alt="">
      </div>
      <div class="" style="width: 8rem;height:5rem;">
        <img class="" src="{{asset('customer/img/hnk.png')}}" width="100%" height="80%;" alt="">
    </div>
    <div class="" style="width: 8rem;height:5rem;">
      <img class="" src="{{asset('customer/img/bgk2.jpg')}}" width="100%" height="80%;" alt="">
  </div>
          </div>
              
            </div>
        </div>


    </div>
    <div class="footer">
      <div class=" bg-success mt-3 py-3">
        <p class=" text-white text-center">coded by Pyae Phyo Thant.&copy; 2023 </p>
    </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{asset('customer/js/app.js')}}"></script>

</html>
