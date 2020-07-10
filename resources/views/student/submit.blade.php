@extends('student.layouts.studentbase')

@section('title')
Student | Application Status
@endsection

@section('content')
<div class="site-section">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Application Status</div>

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
              <div>
                <div class="container">
                    <div class="row">
                      <div class="col-sm-6 offset-3">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                              <tr>
                                <th>Form Number:</th>
                                <td>
                                  @if($student_course->application_id)
                                    {{$student_course->application_id}}
                                  @else
                                    Please Wait!<br/> Generating Application Number.<br/>
                                    <button style="float:right" class="btn-sm btn-secondary" onClick="window.location.reload();">Refresh Page</button>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <th>Student's Name:</th>
                                <td>{{$student_course->name}}</td>
                              </tr>
                              <tr>
                                <th>Status:</th>
                                <td>
                                  @if($student_course->status == 0)
                                  <strong style="color:red">Not Submitted</strong>
                                  @elseif($student_course->status == 1)
                                  <strong style="color:blue">Submitted</strong>
                                  @elseif($student_course->status == 2)
                                  <strong style="color:green">Accepted</strong>
                                  @else
                                  <strong style="color:red">Rejected</strong>        
                                  @endif
                                </td>
                              </tr>
                              @if($student_course->application_id)
                              <tr>
                                <td colspan="2"><a target="_blank" href="{{ route('displayApplication',encrypt($student_course->application_id))}}" class="btn btn-success" style="float:right;">View Application</a></td>
                              </tr>
                              @endif                             
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
</div> 
</div>
@endsection
