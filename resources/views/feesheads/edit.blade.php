@extends('adminlte::page')
@section('title', 'Update Fee')

@section('content_header')
    <h1>Update a Fee in <strong style="color:red;">{{$course->name}}</strong></h1>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-8 offset-sm-2">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Update a Fee</h3>
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
            <form method="post" action="{{ route('feesheads.update', $feebody->id) }}">
                @method('PATCH') 
                @csrf
                <input type="hidden" name="id" value={{ $feebody->id }}>
                <input type="hidden" id="active-stat" name="active-stat" value={{ $feebody->active }}>
                <div class="form-group">

                    <label for="name">Fee Name:</label>
                    <input type="text" class="form-control" name="name" value={{ $feebody->name }} />
                </div>
                <div class="form-group">

                    <label for="name">Fee Amount:</label>
                    <input type="text" class="form-control" name="fee" value="{{ $feebody->fee }}" />
                </div>
                <div class="form-group">
                  <label>Fee is Applicable For Category?</label>
                  <select class="form-control select2" name="category_id" style="width: 100%;">
                    @foreach($categorys as $category)
                    @if($category->id == $feebody->category_record_id )
                      <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Fee is Applicable For Gender?</label>
                  <select class="form-control select2" name="gender_id" style="width: 100%;">
                    @foreach($genders as $gender)
                    @if($gender->id == $feebody->gender_record_id )
                      <option value="{{$gender->id}}" selected>{{$gender->name}}</option>
                    @else
                      <option value="{{$gender->id}}">{{$gender->name}}</option>
                    @endif
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
                          <input class="custom-control-input" type="radio" id="customRadio2" name="BPLWaiver" value="0" >
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
                          <input  class="custom-control-input" type="radio" name="PWDWaiver" value="0"  id="customRadio4">
                          <label for="customRadio4" class="custom-control-label">Not Waived For PWD</label>
                        </div>
                      </div>        
                <div class="form-group">

                    <label for="name">Check the Box to Show the Fee in Admission Form?</label>
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
  checkBplPwd();
});

  function checkBplPwd()
  {
    var checkbpl=parseInt("{{$feebody->checkBPL}}");
    var checkpwd=parseInt("{{$feebody->checkPWD}}");
    if(checkbpl){
      document.getElementById("customRadio1").checked=true;
    }else{
      document.getElementById("customRadio2").checked=true;
    }
    if(checkpwd){
      document.getElementById("customRadio3").checked=true;
    }else{
      document.getElementById("customRadio4").checked=true;
    }

  }
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

