<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('student_front/fonts/icomoon/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('student_front/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('student_front/css/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{asset('student_front/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('student_front/css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('student_front/css/owl.theme.default.min.css')}}">

  <link rel="stylesheet" href="{{asset('student_front/css/jquery.fancybox.min.css')}}">

  <link rel="stylesheet" href="{{asset('student_front/css/bootstrap-datepicker.css')}}">

  <link rel="stylesheet" href="{{asset('student_front/fonts/flaticon/font/flaticon.css')}}">

  <link rel="stylesheet" href="{{asset('student_front/css/aos.css')}}">
  <link href="{{asset('student_front/css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css')}}">

  <link rel="stylesheet" href="{{asset('student_front/css/style.css')}}">
  <style type="text/css">
    i.fam {
      display: inline-block;
      border-radius: 60px;
      box-shadow: 0px 0px 2px #888;
      padding: 0.5em 0.6em;

    }
  </style>
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> -->



</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

@include('web_front.preheader')

          <div class="col-6 d-block d-lg-none text-right">
              <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      


      
      <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          
          <div class="mx-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-block">
                <li>
                <a class="nav-link text-left" href="{{ route('student.logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
              </li>

                                <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
              </ul>                                                                                                                                                                                                                                                                                          </ul>
            </nav>

          </div>
         
        </div>
      </div>

    </div>
    
    </div>
  <!-- Content -->
  @yield('content')




@include('web_front.footer')
    

  </div>
  <!-- .site-wrap -->


  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

  <script src="{{asset('student_front/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('student_front/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('student_front/js/jquery-ui.js')}}"></script>
  <script src="{{asset('student_front/js/popper.min.js')}}"></script>
  <script src="{{asset('student_front/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('student_front/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('student_front/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('student_front/js/jquery.countdown.min.js')}}"></script>
  <script src="{{asset('student_front/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('student_front/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('student_front/js/aos.js')}}"></script>
  <script src="{{asset('student_front/js/jquery.fancybox.min.js')}}"></script>
  <script src="{{asset('student_front/js/jquery.sticky.js')}}"></script>
  <script src="{{asset('student_front/js/jquery.mb.YTPlayer.min.js')}}"></script>
  <script src="{{asset('student_front/js/main.js')}}"></script>
<!--   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->
  <!-- More js-->
  @yield('more_js')

</body>

</html>