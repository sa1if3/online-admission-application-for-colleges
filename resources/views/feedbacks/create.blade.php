@extends('student.layouts.studentbasebeforlogin')
@section('title')
Feedback
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <br/>
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Feedback Form</h3>
            </div>
          <div class="card-body">
            <form method="post" action="{{ route('feedbacks.store') }}">
                @csrf
                <div>
                  <h5 style="text-align: left;color:#78A9EF;">Hi,<br/>In our continuous strive towards excellence, we need your help. Please provide us with your valuable feedback so that we can improve our support & services.</h5>
                  <img src="{{asset('student_front/images/clip-chatting-in-cafe.png')}}" style="max-height: auto;max-width: 100%">Illustration by <a href="undefined">Icons 8</a> from <a href="https://icons8.com/">Icons8</a><br/>
                </div>
              @if (session()->has('success'))
                <div  class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session()->get('success') }}
                </div>
              @endif 
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}<strong style="color:red;">*</strong></label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<strong style="color:red;">*</strong></label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="course" class="col-sm-4 col-form-label text-md-right">{{ __('Course') }}<strong style="color:red;">*</strong></label>

                            <div class="col-md-8">
                                
                              <select id="course" type="text" class="form-control{{ $errors->has('course') ? ' is-invalid' : '' }}" name="course" value="{{ old('course') }}" autofocus>
                                @foreach($courses as $course)
                                <option value="{{encrypt($course->id)}}">{{$course->name}}</option>
                                @endforeach
                              </select>
                                @if ($errors->has('course'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('course') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department" class="col-sm-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-8">
                                <input id="department" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}" autofocus>

                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="feedback_message" class="col-sm-4 col-form-label text-md-right">{{ __('Feedback Message') }}<strong style="color:red;">*</strong></label>

                            <div class="col-md-8">
                                <textarea id="feedback_message" type="text" class="form-control{{ $errors->has('feedback_message') ? ' is-invalid' : '' }}" name="feedback_message" value="{{ old('feedback_message') }}" placeholder="Minumum 100 Characters. Special Symbols allowed are . ? ! ," autofocus required></textarea>

                                @if ($errors->has('feedback_message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('feedback_message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                <button type="submit" class="btn btn-success" style="float: right;">Submit Feedback</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection