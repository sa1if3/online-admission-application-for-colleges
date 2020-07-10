<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ config('app.name', 'Admission') }} | @yield('title')</title>
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



</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
@include('web_front.preheader')
@include('web_front.header')

<div class="site-section">
<div class="container-fluid text-center">    
  <div class="row content">
  <br/><br/>
  <!-- Content -->
  @yield('content')

  </div>
</div>   
</div> 


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

</body>

</html>