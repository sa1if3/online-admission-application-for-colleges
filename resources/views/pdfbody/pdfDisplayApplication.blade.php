<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <title>Student Application Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.page-break {
    page-break-after: always;
}
</style>
</head>

<body>

<!-- <div class="jumbotron text-center">
  <h1>Student Application Details</h1>
  <p>Future Work!</p> 
</div> -->
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <table class="table">
        <th colspan="4" style="text-align:center;"><img src="{{asset('student_front/images/logo.png')}}" style="max-height:100px"></th>
        <th colspan="4" style="text-align:center;"><h2><strong style="color:#BD135B;">{{ config('app.name', 'Admission') }}</strong></h2><h4>{{ env('APP_NAMEB', 'Admission') }}<br/>{{ env('APP_NAMEC', 'Admission') }}</h4></th>
        <th><img src="{{asset('student_front/images/logo2.png')}}" style="max-height:100px" alt="Image" class="img-fluid"></th>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="4" style="text-align:center;"><h2><strong style="color:#BD135B;">Personal Details</strong></h2></th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <th colspan="2"><h2>Application No:<br/><br/><strong>{{$student_course->application_id}}</strong><h2></th>
            
            
            <th><h2>Application Status:</h2><strong>
                                 @if($student_course->status == 0)
                                  <h2 style="color:red">Not Submitted</h2>
                                  @elseif($student_course->status == 1)
                                  <h2 style="color:blue">Submitted</h2>
                                  @elseif($student_course->status == 2)
                                  <h2 style="color:green">Accepted</h2>
                                  @else
                                  <h2 style="color:red">Rejected</h2>        
                                  @endif
                                </strong><br/><br/><br/><br/><br/><br/>
            </th>
            <th style="text-align: center;">
              <br/>
              @if($student_course->file_photo)
                <img style="max-height: 150px;max-width: 150px" src="{{ route($storage_path,$student_course->file_photo)}}">
                
              @endif
              <br/>
              @if($student_course->file_signature)
                <img style="max-height: 100px;max-width: 150px" src="{{ route($storage_path,$student_course->file_signature)}}">
                
              @endif

            </th>
          </tr>
          <tr>
            <td colspan="3"><h4>Full Name:&nbsp;<strong>{{$student_course->name}}</strong></h4></td>
            <td><h4>D.O.B.:&nbsp;<strong>{{$student_course->dob}}</strong></h4></td>
        </tr>
        <tr>
          <td><h4>Gender:&nbsp;<strong>{{$student_course->gender_record_name}}</strong></h4></td>
          <td>
            <h4>Category:&nbsp;<strong>{{$student_course->category_record_name}}</strong></h4>
            @if($student_course->checkBPL)
              <h4 style="color:red;">&nbsp;BPL</h4>
            @endif
            @if($student_course->checkPWD)
            <h4 style="color:red;">&nbsp;PWD</h4>
            @endif
          </td>
          <td><h4>Religion:&nbsp;<strong>{{$student_course->religion_record_name}}</strong></h4></td>
          <td><h4>Nationality:&nbsp;<strong>{{$student_course->nationality}}</strong></h4></td>
        </tr>
        <tr>
          <td colspan="4"><h4>Address:&nbsp;<strong>{{$student_course->address}}</strong></h4></td>
        </tr>
        <tr>
          <td colspan="2"><h4>City:&nbsp;<strong>{{$student_course->city}}</strong></h4></td>
          <td><h4>State:&nbsp;<strong>{{$student_course->state}}</strong></h4></td>
          <td><h4>Pincode:&nbsp;<strong>{{$student_course->pincode}}</strong></h4></td>
        </tr>
        <tr>
          <td colspan="4"></td>
        </tr>
        <tr>
          <td colspan="2"><h4>Father's Name:&nbsp;<strong>{{$student_course->father_name}}</strong></h4></td>
          <td><h4>Father's Occupation:&nbsp;<strong>{{$student_course->father_occupation}}</strong></h4></td>
          <td><h4>Father's Contact:&nbsp;<strong>{{$student_course->father_contact}}</strong></h4></td>
        </tr>
        <tr>
          <td colspan="2"><h4>Mother's Name:&nbsp;<strong>{{$student_course->mother_name}}</strong></h4></td>
          <td><h4>Mother's Occupation:&nbsp;<strong>{{$student_course->mother_occupation}}</strong></h4></td>
          <td><h4>Mother's Contact:&nbsp;<strong>{{$student_course->mother_contact}}</strong></h4></td>
        </tr>
        @if($student_course->guardian_name)
        <tr>
          <td colspan="2"><h4>Guardian's Name:&nbsp;<strong>{{$student_course->guardian_name}}</strong></h4></td>
          <td><h4>Guardian's Occupation:&nbsp;<strong>{{$student_course->guardian_occupation}}</strong></h4></td>
          <td><h4>Guardian's Contact:&nbsp;<strong>{{$student_course->guardian_contact}}</strong></h4></td>
        </tr>
        @endif
        </tbody>
      </table>
      <br/>
      <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="5" style="text-align:center;"><h2><strong style="color:#BD135B;">Educational Qualifications</strong></h2></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td><h4><strong>Examination Passed</strong></h4></td>
          <td><h4><strong>Board</strong></h4></td>
          <td><h4><strong>Passing Year</strong></h4></td>
          <td><h4><strong>Division</strong></h4></td>
          <td><h4><strong>Percentage</strong></h4></td>
        </tr>
        <tr>
          <td><h4><strong>HS</strong></h4></td>
          <td><h4>{{$student_course->hs_board_name}}</h4></td>
          <td><h4>{{$student_course->hs_pass_year}}</h4></td>
          <td><h4>{{$student_course->hs_division}}</h4></td>
          <td><h4>{{$student_course->hs_percentage}}%</h4></td>
        </tr>
        <tr>
          <td><h4><strong>HSLC</strong></h4></td>
          <td><h4>{{$student_course->hslc_board_name}}</h4></td>
          <td><h4>{{$student_course->hslc_pass_year}}</h4></td>
          <td><h4>{{$student_course->hslc_division}}</h4></td>
          <td><h4>{{$student_course->hslc_percentage}}%</h4></td>
        </tr>
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="text-align:center;"><h2><strong style="color:#BD135B;">Subjects</strong></h2></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td><h4><strong>Compulsory Subjects</strong></h4></td>
          <td><h4><strong>Major Subjects</strong></h4></td>
          <td><h4><strong>Elective Subjects</strong></h4></td>
        </tr>
        <tr>
          <td>
            @php($compulsorys=explode(',',$course_list->compulsory))
            @if($compulsorys)
                @foreach($compulsorys AS $one_compulsory)
                  <h4>{{$one_compulsory}}</h4>
                @endforeach
            @endif
          </td>
          <td>
            @php($majors=explode(',',$student_course->major))
            @if($majors)
                @foreach($majors AS $one_major)
                  <h4>{{$one_major}}</h4>
                @endforeach
            @endif
          </td>
          
          <td>
            @php($electives=explode(',',$student_course->elective))
            @if($electives)
                @foreach($electives AS $one_elective)
                  <h4>{{$one_elective}}</h4>
                @endforeach
            @endif
          </td>
        </tr>
        </tbody>
      </table>
      <br/>
      @if($student_course->file_hs)
      <div class="page-break">        
      </div>
      <table class="table table-bordered">
        <thead>
        <tr>
          <th style="text-align:center;"><h2><strong style="color:#BD135B;">HS Certificate</strong></h2></th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <br/><br/>
              <img  style="max-height: 1000px;max-width: 1000px" src="{{route($storage_path,$student_course->file_hs)}}">
              
            </td>
          </tr>
        </tbody>
      </table>
      @endif
      @if($student_course->file_hslc)
      <div class="page-break">        
      </div>
      <table class="table table-bordered">
        <thead>
        <tr>
          <th style="text-align:center;"><h2><strong style="color:#BD135B;">HSLC Certificate</strong></h2></th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <br/><br/>
              <img  style="max-height: 1000px;max-width: 1000px" src="{{ route($storage_path,$student_course->file_hslc)}}">
              
            </td>
          </tr>
        </tbody>
      </table>
      @endif
      @if($student_course->file_dob)
      <div class="page-break">        
      </div>
      <table class="table table-bordered ">
        <thead>
        <tr>
          <th style="text-align:center;"><h2><strong style="color:#BD135B;">D.O.B. Certificate</strong></h2></th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <br/><br/>
              <img  style="max-height: 1000px;max-width: 1000px" src="{{ route($storage_path,$student_course->file_dob)}}">
              
            </td>
          </tr>
        </tbody>
      </table>
      @endif
      @if($student_course->file_caste)
      <div class="page-break">        
      </div>
      <table class="table table-bordered">
        <thead>
        <tr>
          <th style="text-align:center;"><h2><strong style="color:#BD135B;">CASTE Certificate</strong></h2></th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <br/><br/>
              <img   style="max-height: 1000px;max-width: 1000px" src="{{ route($storage_path,$student_course->file_caste)}}">
              
            </td>
          </tr>
        </tbody>
      </table>
      @endif
    </div>
  </div>
</div> 

</body>
</html>
