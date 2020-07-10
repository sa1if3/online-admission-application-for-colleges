@extends('student.layouts.studentbase')

@section('title')
Student | Personal Details
@endsection

@section('content')
<div class="site-section">
<div class="container">
  <h2>Progress: Personal Details</h2>
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
      20%
    </div>
  </div>
</div>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Personal Details (<strong style="color:red">*</strong> Required)</div>

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
  <form method="post" action="{{route('ApplicationUpdatePersonal')}}">
    @csrf
    <input type="hidden" name="flowKeyCooTect" value="{{encrypt($student_course->id)}}">
      <div class="row"><!-- Row Student -->
        <div class="col-sm-8">
          <div class="form-group">
            <label for="Student_Name">Full Name:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="Student_Name" aria-describedby="NameHelp" placeholder="Enter Name" value="{{$student_course->name}}">
            <small id="NameHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="Student_DOB">Date of Birth:<strong style="color:red">*</strong></label>
            <input required type="date" class="form-control" name="Student_DOB" aria-describedby="DOBHelp" placeholder="Enter DOB" value="{{$student_course->dob}}">
            <small id="DOBHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row Student -->
      <div class="row"><!-- Row student2 -->
        <div class="col-sm-3">
          <div class="form-group">
            <label for="Student_Gender">Gender:<strong style="color:red">*</strong></label>
           <select autocomplete="off" class="form-control" name="Student_Gender" aria-describedby="GenderHelp" style="width: 100%;">
              @foreach($genders as $gender)
              @if($gender->name != "ALL")
               @if($gender->id==$student_course->gender_record_id)
                <option selected value="{{encrypt($gender->id)}}">{{$gender->name}}</option>
               @else
                <option value="{{encrypt($gender->id)}}">{{$gender->name}}</option>
               @endif
               @endif
              @endforeach
            </select>
            <small id="GenderHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="Student_Caste">Caste:<strong style="color:red">*</strong></label>
           <select autocomplete="off" class="form-control basic-single" name="Student_Caste" aria-describedby="CasteHelp" style="width: 100%;">
              @foreach($categories as $category)
              @if($category->name != "ALL")
               @if($category->id==$student_course->caste_record_id)
                <option selected value="{{encrypt($category->id)}}">{{$category->name}}</option>
               @else
                <option value="{{encrypt($category->id)}}">{{$category->name}}</option>
               @endif
               @endif
              @endforeach
            </select>
            <small id="CasteHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
            <input type="checkbox" id="checkBPL" name="checkBPL" value="1">&nbsp;BPL<br/>
            <input type="checkbox" id="checkPWD" name="checkPWD" value="1">&nbsp;PWD
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="Student_Religion">Religion:<strong style="color:red">*</strong></label>
           <select autocomplete="off" class="form-control" name="Student_Religion" aria-describedby="ReligionHelp" style="width: 100%;">
              @foreach($religions as $religion)
               @if($religion->id==$student_course->religion_record_id)
                <option selected value="{{encrypt($religion->id)}}">{{$religion->name}}</option>
               @else
                <option value="{{encrypt($religion->id)}}">{{$religion->name}}</option>
               @endif

              @endforeach
            </select>
            <small id="ReligionHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="Student_Nationality">Nationality:<strong style="color:red">*</strong></label>
           <select autocomplete="off" class="form-control" name="Student_Nationality" aria-describedby="NationalityHelp" style="width: 100%;">
              <option value="INDIAN">INDIAN</option>
            </select>
            <small id="NationalityHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row student2 -->
      <div class="row"><!-- Row StudentAdd1 -->
        <div class="col-sm-8">
          <div class="form-group">
            <label for="Student_Address">Address:<strong style="color:red">*</strong></label>
            <textarea class="form-control" name="Student_Address" id="Student_Address" aria-describedby="AddressHelp" placeholder="Enter Address"></textarea>
            <small id="AddressHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row StudentAdd1 -->
      <div class="row"><!-- Row StudentAdd2 -->
        <div class="col-sm-4">
          <div class="form-group">
            <label for="Student_City">City:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="Student_City" aria-describedby="CityHelp" placeholder="Enter City" value="{{$student_course->city}}">
            <small id="CityHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="Student_State">State:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="Student_State" aria-describedby="StateHelp" placeholder="Enter State" value="{{$student_course->state}}">
            <small id="StateHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="Student_Pincode">Pincode:<strong style="color:red">*</strong></label>
            <input required type="number" class="form-control" name="Student_Pincode" aria-describedby="PincodeHelp" placeholder="Enter Pincode" value="{{$student_course->pincode}}">
            <small id="PincodeHelp" class="form-text text-muted" value="pincode">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row StudentAdd2 -->
      <hr/>
      <div class="row"><!-- Row Father -->
        <div class="col-sm-6">
          <div class="form-group">
            <label for="Father_Name">Father's Name:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="Father_Name" aria-describedby="FatherNameHelp" placeholder="Enter Father's Name" value="{{$student_course->father_name}}">
            <small id="FatherNameHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="Father_Job">Father's Occupation:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="Father_Job" aria-describedby="FatherJobHelp" placeholder="Enter Father's Occupation" value="{{$student_course->father_occupation}}">
            <small id="FatherJobHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="Father_Contact">Father's Contact:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="Father_Contact" aria-describedby="ContactHelp" placeholder="Enter Father's Contact" value="{{$student_course->father_contact}}">
            <small id="ContactHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row Father -->
      <hr/>
      <div class="row"><!-- Row Mother -->
        <div class="col-sm-6">
          <div class="form-group">
            <label for="Mother_Name">Mother's Name:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="Mother_Name" aria-describedby="MotherNameHelp" placeholder="Enter Mother's Name" value="{{$student_course->mother_name}}">
            <small id="MotherNameHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="Mother_Job">Mother's Occupation:</label>
            <input type="text" class="form-control" name="Mother_Job" aria-describedby="MotherJobHelp" placeholder="Enter Mother's Occupation" value="{{$student_course->mother_occupation}}">
            <small id="MotherJobHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="Mother_Contact">Mother's Contact:</label>
            <input type="text" class="form-control" name="Mother_Contact" aria-describedby="ContactHelp" placeholder="Enter Mother's Contact" value="{{$student_course->mother_contact}}">
            <small id="ContactHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row Mother -->
      <div class="row"><!-- Row Guardian -->
        <div class="col-sm-6">
          <div class="form-group">
            <label for="InputGuardianDetails1">Enter Guardian's Details?</label>
            <input  type="checkbox"  id="InputGuardianDetails1" aria-describedby="GuardianHelp" placeholder="Enter Guardian's Details?" onclick="toggleGuardian()">
          </div>
        </div>
      </div>
      <div id="hasGuardian" class="row" style="display: none;"><!-- Row Guardian -->
        <div class="col-sm-4">
          <div class="form-group">
            <label for="Guardian_Name">Guardian's Name:<strong style="color:red">*</strong></label>
            <input type="text" class="form-control" name="Guardian_Name" aria-describedby="GuardianNameHelp" placeholder="Enter Guardian's Name" value="{{$student_course->guardian_name}}">
            <small id="GuardianNameHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="Guardian_Job">Guardian's Occupation:<strong style="color:red">*</strong></label>
            <input type="text" class="form-control" name="Guardian_Job" aria-describedby="GuardianJobHelp" placeholder="Enter Guardian's Occupation" value="{{$student_course->guardian_occupation}}">
            <small id="GuardianJobHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="Guardian_Contact">Guardian's Contact:<strong style="color:red">*</strong></label>
            <input type="text" class="form-control" name="Guardian_Contact" aria-describedby="ContactHelp" placeholder="Enter Guardian's Contact" value="{{$student_course->guardian_contact}}">
            <small id="ContactHelp" class="form-text text-muted">Exactly as your HS/HSLC Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row Guardian -->
      <button type="submit" style="float:right" class="btn-lg btn-warning">Save & Proceed</button>
</form>
</div>

            </div>
        </div>
    </div>
</div>
</div> 
</div>
@endsection
@section('more_js')
<script type="text/javascript">
$(document).ready(function() {
  preLoad();
  toggleGuardian();
/*  $('.basic-single').select2();*/
});
function preLoad()
{
  document.getElementById('Student_Address').value="{{$student_course->address}}";  
  var guardian='{{$student_course->guardian_name}}'; 
  var bpl=parseInt('{{$student_course->checkBPL}}');
  var pwd=parseInt('{{$student_course->checkPWD}}');
  if(guardian){
    document.getElementById('InputGuardianDetails1').checked="true";
  } 
  if(bpl){
    document.getElementById('checkBPL').checked="true";
  }
  if(pwd){
   document.getElementById('checkPWD').checked="true"; 
  }
}
  function toggleGuardian()
  {
    var choice=document.getElementById('InputGuardianDetails1'); 
    if(choice.checked)
    {
      document.getElementById("hasGuardian").style.display = "block";
    }
    else
    {
      document.getElementById("hasGuardian").style.display = "none";
    }
  }
</script>
@endsection