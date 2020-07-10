@extends('student.layouts.studentbase')

@section('title')
Student | Educational Details
@endsection

@section('content')
<div class="site-section">
<div class="container">
  <h2>Progress: Educational Details</h2>
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
      40%
    </div>
  </div>
</div>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Educational Details (<strong style="color:red">*</strong> Required)</div>

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
  <form method="post" action="{{route('ApplicationUpdateProfessional')}}">
    @csrf
    <input type="hidden" name="flowKeyCooTect" value="{{encrypt($student_course->id)}}">
      <div class="row"><!-- Row HS2 -->
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HS_Board">HS Board:<strong style="color:red">*</strong></label>
           <select autocomplete="off" class="form-control" name="HS_Board" aria-describedby="HSBoardHelp" style="width: 100%;">
              @foreach($boards as $board)
               @if($board->id==$student_course->hs_board_record_id)
                <option selected value="{{encrypt($board->id)}}">{{$board->name}}</option>
               @else
                <option value="{{encrypt($board->id)}}">{{$board->name}}</option>
               @endif

              @endforeach
            </select>
            <small id="HSBoardHelp" class="form-text text-muted">Exactly as your HS Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HS_Pass_Year">HS Pass Year:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="HS_Pass_Year" aria-describedby="HSPassYearHelp" placeholder="Enter HS Pass Year" value="{{$student_course->hs_pass_year}}">
            <small id="HSPassYearHelp" class="form-text text-muted">Exactly as your HS Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HS_Division">HS Division:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="HS_Division" aria-describedby="HSDivisionHelp" placeholder="Enter HS Division" value="{{$student_course->hs_division}}">
            <small id="HSDivisionHelp" class="form-text text-muted">Exactly as your HS Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HS_Percentage">HS %:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="HS_Percentage" aria-describedby="HSPercentageHelp" placeholder="Enter HS Percentage(%)" value="{{$student_course->hs_percentage}}">
            <small id="HSPercentageHelp" class="form-text text-muted">Exactly as your HS Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row HS2 -->
      <hr/> 
      @php($hs_subject_list=explode(',',$student_course->hs_subjects))
      @php($hs_total_marks_list=explode(',',$student_course->hs_total_marks))
      @php($hs_got_marks_list=explode(',',$student_course->hs_student_marks))
      @for($count=0;$count<6;$count++)
      <div class="row"><!-- Row Sub{{$count+1}} -->
        <div class="col-sm-2">
          <div class="form-group">
            <label>Subject {{$count+1}}<strong style="color:red">*</strong></label>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="HS_Subjects[]">Name:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="HS_Subjects[]" aria-describedby="HSPassSubjects" placeholder="Enter HS Subject Name" 
            @if($count<sizeof($hs_subject_list))
            value="{{$hs_subject_list[$count]}}" 
            @else
            value=""
            @endif
            >
            <small id="HSPassSubjects" class="form-text text-muted">Exactly as your HS Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HS_Full_Marks[]">Full Marks:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="HS_Full_Marks[]" aria-describedby="HSFullMarks" placeholder="Enter HS Subject Full Marks" 
            @if($count<sizeof($hs_total_marks_list))
            value="{{$hs_total_marks_list[$count]}}" 
            @else
            value=""
            @endif
            >
            <small id="HSFullMarks" class="form-text text-muted">Exactly as your HS Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HS_Got_Marks[]">Student's Marks:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="HS_Got_Marks[]" aria-describedby="HSGotHelp" placeholder="Enter Your Marks" 
            @if($count<sizeof($hs_got_marks_list))
            value="{{$hs_got_marks_list[$count]}}" 
            @else
            value=""
            @endif
            >
            <small id="HSGotHelp" class="form-text text-muted">Exactly as your HS Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row Sub{{$count+1}} -->
<hr style="border-top: 1px dashed grey;" /> 
      @endfor  
      <hr/>       
      <div class="row"><!-- Row HSLC2 -->
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HSLC_Board">HSLC Board:<strong style="color:red">*</strong></label>
           <select autocomplete="off" class="form-control" name="HSLC_Board" aria-describedby="HSLCBoardHelp" style="width: 100%;">
              @foreach($boards as $board)
               @if($board->id==$student_course->hslc_board_record_id)
                <option selected value="{{encrypt($board->id)}}">{{$board->name}}</option>
               @else
                <option value="{{encrypt($board->id)}}">{{$board->name}}</option>
               @endif

              @endforeach
            </select>
            <small id="HSLCBoardHelp" class="form-text text-muted">Exactly as your HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HSLC_Pass_Year">HSLC Pass Year:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="HSLC_Pass_Year" aria-describedby="HSLCPassYearHelp" placeholder="Enter HSLC Pass Year" value="{{$student_course->hslc_pass_year}}">
            <small id="HSLCPassYearHelp" class="form-text text-muted">Exactly as your HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HSLC_Division">HSLC Division:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="HSLC_Division" aria-describedby="HSLCDivisionHelp" placeholder="Enter HSLC Division" value="{{$student_course->hslc_division}}">
            <small id="HSLCDivisionHelp" class="form-text text-muted">Exactly as your HSLC Marksheet.</small>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="HSLC_Percentage">HSLC %:<strong style="color:red">*</strong></label>
            <input required type="text" class="form-control" name="HSLC_Percentage" aria-describedby="HSLCPercentageHelp" placeholder="Enter HSLC Percentage(%)" value="{{$student_course->hslc_percentage}}">
            <small id="HSLCPercentageHelp" class="form-text text-muted">Exactly as your HSLC Marksheet.</small>
          </div>
        </div>
      </div><!-- ./Row HSLC2 -->  
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
