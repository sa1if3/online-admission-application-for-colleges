@extends('adminlte::page')
@section('title','Edit Fees')

@section('content_header')
    <h1>Edit Fees in <strong style="color:red;">{{$course->name}}</strong></h1>
@stop

@section('content')
<div class="container-fluid">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif
              @if (session()->has('success'))
                <div  class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session()->get('success') }}
                </div>
              @endif 
  <div class="row">
@if($newfee->fee_year == '0')
      <div class="col-sm-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit Admission Fee Only</h3>
            </div>
          <div class="card-body">
            <form method="post" action="{{ route('newfees.update', $newfee->id) }}">
                @method('PATCH')
                @csrf
            <div class="row">
              <div class="col-sm-6">
                <input type="hidden" name="course_record_id" value="{{$course->id}}">
                <input type="hidden" name="fee_year" value="0">
                <div class="form-group">    
                    <label for="fee_name">Fees Name:</label>
                    <input type="text" class="form-control" name="fee_name" value="Admission Fee" readonly />
                </div>
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">GEN Candidate &#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="Gen" value="{{$newfee->gen}}" name="Gen" onkeyup="toggleActive()"/>
	                </div>
                    <input type="checkbox" id="copyfee" name="copyfee"  onchange="toggleActive()">&nbsp;Copy Same Fee as Gen in Other Categories?
                </div>
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">SC Candidate &nbsp;&nbsp;&nbsp;&#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="SC" value="{{$newfee->sc}}" name="SC"/>
	                </div>
                    
                </div>
               </div>
               <div class="col-sm-6">
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">ST Candidate &nbsp;&nbsp;&nbsp;&#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="ST" value="{{$newfee->st}}" name="ST"/>
	                </div>
                    
                </div>
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">OBC Candidate &#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="OBC" value="{{$newfee->obc}}" name="OBC"/>
	                </div>
                    
                </div> 
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">PWD Candidate &#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" value="{{$newfee->pwd}}" id="PWD" name="PWD"/>
	                </div>
                    
                </div> 
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">BPL Candidate &nbsp;&#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="BPL" value="{{$newfee->bpl}}" name="BPL"/>
	                </div>
                    
                </div>
                <button type="submit" class="btn btn-warning" style="float: right;">Edit Admission Fee in {{$course->name}}</button>         
            </div>
                
            </div>
            </form>
          </div>
        </div>
      </div>
@else
      <div class="col-sm-4">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Edit Semester/Yearly Fees Here</h3>
            </div>
          <div class="card-body">
            <form method="post" action="{{ route('newfees.update', $newfee->id) }}">
                @method('PATCH')
                @csrf
                <input type="hidden" name="course_record_id" value="{{$course->id}}">
                <div class="form-group">    
                    <label for="fee_name">Fees Name:</label>
                    <input type="text" class="form-control" name="fee_name" value="{{$newfee->fee_name}}"/>
                </div>
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">Fee Amount &#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="Gen" value="{{$newfee->gen}}" name="Gen" onkeyup="toggleActive()"/>
	                </div>
				</div>   

                <button type="submit" class="btn btn-danger" style="float: right;">Edit Semester/Yearly Fee in {{$course->name}}</button>
            </form>
          </div>
        </div>
      </div>
@endif
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">

  function toggleActive(){
  // Get the checkbox
  var checkBox = document.getElementById("copyfee");
  // Get the output text
  var gen_val = document.getElementById("Gen").value;
  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    document.getElementById('SC').value=gen_val;
    document.getElementById('ST').value=gen_val;
    document.getElementById('BPL').value=gen_val;
    document.getElementById('PWD').value=gen_val;
    document.getElementById('OBC').value=gen_val;
  }

  }
</script>
@endsection