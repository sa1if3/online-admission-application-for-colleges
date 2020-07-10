@extends('adminlte::page')
@section('title','Add a Course')

@section('content_header')
    <h1>Add a Course</h1>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-8 offset-sm-2">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add a Course</h3>
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
            <form method="post" action="{{ route('courses.store') }}">
                @csrf
                <div class="form-group">    
                    <label for="name">Course Name:</label>
                    <input type="text" class="form-control" name="name"/>
                </div>  
                <div class="form-group">    
                    <label for="compulsory">Compulsory Subjects(Comma Separated):</label>
                    <input type="text" class="form-control" name="compulsory"/>
                </div>
                <div class="form-group">    
                    <label for="major">Major Subjects(Comma Separated):</label>
                    <input type="text" class="form-control" name="major"/>
                </div>
                <div class="form-group">    
                    <label for="elective">Elective Subjects(Comma Separated):</label>
                    <input type="text" class="form-control" name="elective"/>
                </div>
                <div class="form-group">    
                    <label for="instruction">Instructions(Place Each Instruction in a New line):</label>
                    <textarea type="text" class="form-control" name="instruction"/></textarea>
                </div>
                <div class="form-group">    
                    <label for="course_prefix">Course Prefix(This Cannot be changed later):</label>
                    <input type="text" class="form-control" placeholder="Two Characters only" name="course_prefix"/>
                </div>
                <div class="form-group">    
                    <label for="course_semester">Total Course Semester/Year:</label>
                    <input type="number" min="1" class="form-control" name="course_semester" value="1"/>
                </div>                           
                <button type="submit" class="btn btn-primary" style="float: right;">Add Course</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection