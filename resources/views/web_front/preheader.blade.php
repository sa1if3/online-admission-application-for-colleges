
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    
    <div class="header-top bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6 col-lg-3">
            <a href="{{url('/')}}">
              <img src="{{asset('student_front/images/logo.png')}}" style="max-height:100px" alt="Image" class="img-fluid">
              <!-- <strong>Water</strong>Boat -->
            </a>
          </div>
          <div class="col-lg-4 d-none d-lg-block offset-1">

            <div class="quick-contact-icons d-flex">
<!--               <div class="icon align-self-start">
                <span class="icon-location-arrow text-primary"></span>
              </div> -->
              <div class="text" style="text-align: center;">
                <span class="h2 d-block">{{ config('app.name', 'Admission') }}</span>
                <span class="h4 caption-text">Online Application</span>
                <span class="caption-text"><br/>{{ env('APP_NAMEB', 'Admission') }}</span>
                <span class="caption-text"><br/>{{ env('APP_NAMEC', 'Admission') }}</span>
              </div>
            </div>


          </div>
          <div class="col-lg-3 d-none d-lg-block">
            <div class="quick-contact-icons d-flex">
              <div class="text">
<img src="{{asset('student_front/images/logo2.png')}}" style="max-height:100px" alt="Image" class="img-fluid">
              </div>
            </div>
          </div>