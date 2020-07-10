@extends('student.layouts.studentbase')

@section('title')
Student | Subject Selection & Submit
@endsection

@section('content')
<div class="site-section">
<div class="container">
  <h2>Progress: Select Subject</h2>
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%">
      90%
    </div>
  </div>
</div>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Subject Selection & Submit</div>

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
  <form method="post" action="{{route('ApplicationUpdateSubjects')}}">
    @csrf
    <input type="hidden" name="flowKeyCooTect" value="{{encrypt($student_course->id)}}">
      <div class="row"><!-- Row Upload0 -->
        <div class="col-sm-4">
          <div class="form-group">
              <label for="Compulsory_Subjects"><strong style="color:red">Compulsory Subjects :</strong><br/></label>
              @php($compulsorys=explode(",",$course->compulsory))
                  
                  @foreach($compulsorys AS $compulsory)
                      <br/><input type="checkbox" name="compulsory[]" checked disabled="" value="{{encrypt($compulsory)}}">&nbsp;{{$compulsory}}
                  @endforeach
                
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
              <label for="Major_Subjects"><strong style="color:red">Major Subjects :</strong><br/></label>
              @php($majors=explode(",",$course->major))
                  
                  @foreach($majors AS $major)
                      <br/><input type="checkbox" name="major[]" value="{{encrypt($major)}}">&nbsp;{{$major}}
                  @endforeach
                
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
              <label for="Electives_Subjects"><strong style="color:red">Elective Subjects :</strong><br/></label>
              @php($electives=explode(",",$course->elective))
                  
                  @foreach($electives AS $elective)
                      <br/><input type="checkbox" name="elective[]" value="{{encrypt($elective)}}">&nbsp;{{$elective}}
                  @endforeach
                
          </div>
        </div>
      </div><!-- ./Row Upload0 -->
      <hr/>
      <div class="row"><!-- Row Upload0 -->
        <div class="col-sm-12">

          <div class="form-group" style="float:right">
          <input type="checkbox" name="instruction_agree" value="1" required="true" /> I hereby declare that the information given is true and correct to the best of my knowledge and belief. I also note that if any of the above statements or particulars are found incorrect or false, I will be liable to be disqualified and my admission be cancelled. I hereby declare that I will obey the rules and regulations of the institute.<br/>
          <div class="btn-group" style="float:right"> 
            <a href="{{route('ApplicationUpdateEdit')}}" class="btn-lg btn-primary">Edit Form</a>&nbsp;
          <button class="btn-lg btn-danger">Submit Form</button>
          </div>
          </div>
        </div>
      </div>
  </form> 
            </div>
        </div>
    </div>
</div>
</div> 
</div>
@endsection
