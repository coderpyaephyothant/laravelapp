<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oppa'sPizzas</title>

    <!-- Google Font -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@200;300;400;500&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('ui/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('ui/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ui/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ui/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ui/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ui/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ui/css/style.css')}}" type="text/css">

</head>

<body>

<!-- scroll to top start -->
<button class="" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>
<!-- scroll to top end -->
@include('customer.uilayout.uiheader')

    @yield('content')






    <!-- Footer Section Begin -->
    <footer class="footer spad" id="contact_us">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{route('user#uiupdate')}}">Oppa's Pizza</a>
                        </div>
                        <ul>
                            <li>Address: Lanmadaw Yangon</li>
                            <li>Phone: +959 123456789</li>
                            <li>Email: oppapizza@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Oppa's pizza Shops</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="">
                        <h6>Join Oppa Fan's Community Now</h6>
                        <div class="d-flex justify-content-around">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                        </div> <br>
                        <p>Send Your Messages</p>
                        <form action="{{route('user#sendMessage')}}" method="POST">
                            @csrf
                            {{-- <input type="text" placeholder="Your Message"> --}}
                            <div class="d-flex flex-column ">
                                <input type="text" name="title" placeholder="title"> <br>
                                @if ($errors->has('title'))
                                    <p class="text-danger">{{$errors->first('title')}}</p>
                                @endif
                                <textarea name="message" id="" cols="20" rows="10" placeholder="message"></textarea><br>
                                @if ($errors->has('message'))
                                    <p class="text-danger">{{$errors->first('message')}}</p>
                                @endif
                            <button type="submit" class="btn btn-secondary btn-sm">Send</button>
                            </div>
                        </form> <br>

                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12 ">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |Colorlib template. <span>Modified by Pyae Phyo Thant</span>
</div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('ui/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('ui/js/popper.min.js')}}"></script>
    <script src="{{asset('ui/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('ui/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('ui/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('ui/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('ui/js/mixitup.min.js')}}"></script>
    <script src="{{asset('ui/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('ui/js/main.js')}}"></script>



</body>

</html>
