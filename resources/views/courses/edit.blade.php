@extends('adminlte::page')
@section('title', 'Update Course')

@section('content_header')
    <h1>Update a Course</h1>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-8 offset-sm-2">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Update a Course</h3>
            </div>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif
          <div class="card-body">
            <form method="post" action="{{ route('courses.update', $course->id) }}">
                @method('PATCH') 
                @csrf
                <input type="hidden" name="id" value="{{ $course->id }}">
                <input type="hidden" id="active-stat" name="active-stat" value={{ $course->active }}>
                <div class="form-group">

                    <label for="name">Course Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $course->name }}" />
                </div>
                <div class="form-group">    
                    <label for="compulsory">Compulsory Subjects(Comma Separated):</label>
                    <input type="text" class="form-control" value="{{ $course->compulsory }}" name="compulsory"/>
                </div>
                <div class="form-group">    
                    <label for="major">Major Subjects(Comma Separated):</label>
                    <input type="text" class="form-control" value="{{ $course->major }}" name="major"/>
                </div>
                <div class="form-group">    
                    <label for="elective">Elective Subjects(Comma Separated):</label>
                    <input type="text" class="form-control" value="{{ $course->elective }}" name="elective"/>
                </div>
                <div class="form-group">    
                    <label for="instruction">Instructions(New Line Separated):</label>
                    <textarea type="text" class="form-control" id="instruction1" name="instruction"/></textarea>
                </div>
                <div class="form-group">    
                    <label for="course_semester">Total Course Semester/Year:</label>
                    <input type="text" class="form-control" value="{{ $course->course_semester }}" name="course_semester"/>
                </div> 
                <div class="form-group">

                    <label for="name">Check the Box to Show the Course in Admission Form?</label>
                    <input id="checkbox1" type="checkbox" name="checkbox1" onclick="toggleActive()" />
                </div>
                <button type="submit" class="btn btn-info" style="float: right;">Update</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function() {
  checkIfActive();
  document.getElementById('instruction1').value="{{$course->description}}";
});

  function checkIfActive(){
    // Get the checkbox
    var checkBox = document.getElementById("checkbox1");
    // Get the output text
    var checkActive = parseInt(document.getElementById("active-stat").value);
     if (checkActive){
      checkBox.checked=true;
    } else {
      checkBox.checked=false;
    }
  }

  function toggleActive(){
  // Get the checkbox
  var checkBox = document.getElementById("checkbox1");
  // Get the output text
  var checkActive = document.getElementById("active-stat");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    checkActive.value = "1";
  } else {
    checkActive.value = "0";
  }

  }
</script>
@stop

