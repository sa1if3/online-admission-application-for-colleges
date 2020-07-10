@extends('adminlte::page')
@section('title','Add a Fee')

@section('content_header')
    <h1>Add a Fee in <strong style="color:red;">{{$course->name}}</strong></h1>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-8 offset-sm-2">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add a Fees</h3>
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
            <form method="post" action="{{ route('feesheads.store') }}">
                @csrf
                <input type="hidden" name="course_record_id" value="{{$course->id}}">
                <div class="form-group">    
                    <label for="name">Fees Name:</label>
                    <input type="text" class="form-control" name="name"/>
                </div>
                <div class="form-group">    
                    <label for="fee">Fees Amount:</label>
                    <input type="text" class="form-control" name="fee"/>
                </div>
                <div class="form-group">
                  <label>Fee is Applicable For Category?</label>
                  <select class="form-control select2" name="category_id" style="width: 100%;">
                    @foreach($categorys as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Fee is Applicable For Gender?</label>
                  <select class="form-control select2" name="gender_id" style="width: 100%;">
                    @foreach($genders as $gender)
                    <option value="{{$gender->id}}">{{$gender->name}}</option>
                    @endforeach
                  </select>
                </div>
                  <label style="color:red;">Fee Waiver Section.</label><br/> 
 
                      <!-- radio 1-->
                      <div class="form-group">
                        <div class="custom-control custom-radio">
                          
                          <input class="custom-control-input" type="radio" id="customRadio1" name="BPLWaiver" value="1">
                          <label for="customRadio1" class="custom-control-label">Yes,Waived For BPL</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio2" name="BPLWaiver" value="0" checked>
                          <label for="customRadio2" class="custom-control-label">Not Waived For BPL</label>
                        </div>
                      </div>


                      <!-- radio -->
                      <div class="form-group">
                        <div class="custom-control custom-radio">
                          
                          <input  class="custom-control-input" type="radio" name="PWDWaiver" value="1" id="customRadio3">
                          <label for="customRadio3" class="custom-control-label">Yes,Waived For PWD</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input  class="custom-control-input" type="radio" name="PWDWaiver" value="0" checked id="customRadio4">
                          <label for="customRadio4" class="custom-control-label">Not Waived For PWD</label>
                        </div>
                      </div>                
                <button type="submit" class="btn btn-primary" style="float: right;">Add Fees in {{$course->name}}</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
@section('plugins.Select2', true)
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
});
</script>
@endsection