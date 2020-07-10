@extends('student.layouts.studentbase')

@section('title')
Student | Upload Files
@endsection

@section('content')
<div class="site-section">
<div class="container">
  <h2>Progress: Upload Files</h2>
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
      60%
    </div>
  </div>
</div>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Upload Files (<strong style="color:red">*</strong> Required. If File is already uploaded leave the option blank.)</div>

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
  <form method="post" enctype="multipart/form-data" action="{{route('ApplicationUpdateUpload')}}">
    @csrf
    <input type="hidden" name="flowKeyCooTect" value="{{encrypt($student_course->id)}}">
      <div class="row"><!-- Row Upload0 -->
        <div class="col-sm-6">
          <div class="form-group">
            <label for="Photo"> Photo:<strong style="color:red">*</strong></label>
            <input type="file" class="form-control" name="Photo" aria-describedby="PhotoHelp" placeholder="Upload  Photo">
            <small id="PhotoHelp" class="form-text text-muted">Scanned Copy in JPG/PNG/JPEG Allowed. Maximum Size 150 KB. @if($student_course->file_photo)<a href="{{ route('mystorage',$student_course->file_photo)}}" class="btn btn-success" target="_blank">View Already Uploaded File</a>@endif</small>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="Signature"> Signature :<strong style="color:red">*</strong></label>
            <input type="file" class="form-control" name="Signature" aria-describedby="SignatureHelp" placeholder="Upload  Signature ">
            <small id="SignatureHelp" class="form-text text-muted">Scanned Copy in JPG/PNG/JPEG Allowed. Maximum Size 150 KB.  @if($student_course->file_signature)<a href="{{ route('mystorage',$student_course->file_signature)}}" class="btn btn-success" target="_blank">View Already Uploaded File</a>@endif </small>
          </div>
        </div>
      </div><!-- ./Row Upload0 -->
      <div class="row"><!-- Row Upload1 -->
        <div class="col-sm-6">
          <div class="form-group">
            <label for="HS_Certificate">HS Certificate:<strong style="color:red">*</strong></label>
            <input type="file" class="form-control" name="HS_Certificate" aria-describedby="HSCertificateHelp" placeholder="Upload HS Certificate">
            <small id="HSCertificateHelp" class="form-text text-muted">Scanned Copy in JPG/PNG/JPEG Allowed. Maximum Size 250 KB. @if($student_course->file_hs)<a href="{{ route('mystorage',$student_course->file_hs)}}" class="btn btn-success" target="_blank">View Already Uploaded File</a>@endif </small>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="HSLC_Certificate">HSLC Certificate :<strong style="color:red">*</strong></label>
            <input type="file" class="form-control" name="HSLC_Certificate" aria-describedby="HSLCCertificateHelp" placeholder="Upload HSLC Certificate ">
            <small id="HSLCCertificateHelp" class="form-text text-muted">Scanned Copy in JPG/PNG/JPEG Allowed. Maximum Size 250 KB. @if($student_course->file_hslc)<a href="{{ route('mystorage',$student_course->file_hslc)}}" class="btn btn-success" target="_blank">View Already Uploaded File</a>@endif </small>
          </div>
        </div>
      </div><!-- ./Row Upload1 -->
      <div class="row"><!-- Row Upload1 -->
        <div class="col-sm-6">
          <div class="form-group">
            <label for="Age_Certificate">Age Certificate :<strong style="color:red">*</strong></label>
            <input type="file" class="form-control" name="Age_Certificate" aria-describedby="AgeCertificateHelp" placeholder="Upload Age Certificate ">
            <small id="AgeCertificateHelp" class="form-text text-muted">Scanned Copy in JPG/PNG/JPEG Allowed. Maximum Size 250 KB. @if($student_course->file_dob)<a href="{{ route('mystorage',$student_course->file_dob)}}" class="btn btn-success" target="_blank">View Already Uploaded File</a>@endif </small>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="Caste_Certificate">Caste Certificate:</label>
            <input type="file" class="form-control" name="Caste_Certificate" aria-describedby="CasteCertificateHelp" placeholder="Upload Caste Certificate">
            <small id="CasteCertificateHelp" class="form-text text-muted">Scanned Copy in JPG/PNG/JPEG Allowed. Maximum Size 250 KB. @if($student_course->file_caste)<a href="{{ route('mystorage',$student_course->file_caste)}}" class="btn btn-success" target="_blank">View Already Uploaded File</a>@endif</small>
          </div>
        </div>
      </div><!-- ./Row Upload1 -->
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
