@extends('student.layouts.studentbase')

@section('title')
Student | Verify OTP
@endsection

@section('content')
<div class="site-section">
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Verify OTP (<strong style="color:red">*</strong> Required)</div>

                <div class="card-body">
              @if (session()->has('success'))
                <div  class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session()->get('success') }}
                </div>
              @endif 
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                </div><br />
              @endif   
<div class="container">
  <form method="post" action="{{route('verifyOTP')}}">
    @csrf
      <div class="row"><!-- Row HS2 -->
        <div class="col-sm-6 offset-3">
          <div class="form-group">
            <label for="courseId">Verify Your Number <strong>{{$mobile}}</strong><strong style="color:red">*</strong></label>
            <input type="number" class="form-control" min="100000" max="999999" title="6 Digit Number Only" name="otp_value" required aria-describedby="CourseHelp">
            <small id="CourseHelp" class="form-text text-muted">Please Wait! An OTP can take upto 10 minutes to arrive. <a href="{{route('resendOTP')}}">Resend OTP ?</a></small>
          </div>
        </div>
      </div><!-- ./Row HS2 -->
      <button type="submit" style="float:right" class="btn-lg btn-warning">VERIFY</button>
  </form>
</div>
            </div>
        </div>
    </div>
</div>
</div> 
</div>
@endsection
