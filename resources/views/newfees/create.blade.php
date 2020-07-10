@extends('adminlte::page')
@section('title','Add Fees')

@section('content_header')
    <h1>Add Fees in <strong style="color:red;">{{$course->name}}</strong></h1>
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
      <div class="col-sm-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Add Admission Fee Only</h3>
            </div>
          <div class="card-body">
            <form method="post" action="{{ route('newfees.store') }}">
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
	                  <input type="number" min="0" class="form-control" id="Gen" name="Gen" onkeyup="toggleActive()"/>
	                </div>
                    <input type="checkbox" id="copyfee" name="copyfee" onchange="toggleActive()">&nbsp;Copy Same Fee as Gen in Other Categories?
                </div>
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">SC Candidate &nbsp;&nbsp;&nbsp;&#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="SC" name="SC"/>
	                </div>
                    
                </div>
               </div>
               <div class="col-sm-6">
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">ST Candidate &nbsp;&nbsp;&nbsp;&#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="ST" name="ST"/>
	                </div>
                    
                </div>
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">OBC Candidate &#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="OBC" name="OBC"/>
	                </div>
                    
                </div> 
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">PWD Candidate &#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="PWD" name="PWD"/>
	                </div>
                    
                </div> 
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">BPL Candidate &nbsp;&#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="BPL" name="BPL"/>
	                </div>
                    
                </div>
                <button type="submit" class="btn btn-warning" style="float: right;">Add Admission Fee in {{$course->name}}</button>         
            </div>
                
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Add Semester/Yearly Fees Here</h3>
            </div>
          <div class="card-body">
            <form method="post" action="{{ route('newfees.store') }}">
                @csrf
                <input type="hidden" name="course_record_id" value="{{$course->id}}">
                <div class="form-group">    
                    <label for="fee_name">Fees Name:</label>
                    <input type="text" class="form-control" name="fee_name"/>
                </div>
                <div class="form-group">

                  <label>Year/Semester?</label>
                  <select class="form-control" name="fee_year" style="width: 100%;">
                    @for($count=1;$count<=$course->course_semester;$count++)
                    <option value="{{$count}}">{{$count}}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">    
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">Fee Amount &#8377;:</span>
	                  </div>
	                  <input type="number" min="0" class="form-control" id="Gen" name="Gen" onkeyup="toggleActive()"/>
	                </div>
				</div>   

                <button type="submit" class="btn btn-danger" style="float: right;">Add Semester/Yearly Fee in {{$course->name}}</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>

@if($newfees)
<div class="container-fluid">                  
  <div class="row">
    <div class="col-sm-12">
          <div class="card card-secondary">
              <div class="card-header">
              <h3 class="card-title">Full Fee List</h3>
              </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Timestamp</td>
                        <td>Name</td>
                        <td>Status</td>
                        
                        <td>Amount</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                      @php($count=0)
                      @php($year = array ())
                      @foreach($newfees as $newfee)
                      	@if(!in_array($newfee->fee_year,$year))
	                      	@php(array_push($year,$newfee->fee_year))
		                      <tr style="text-align:center;color:red;">
		                      	<th colspan="6">
		                          	@if($newfee->fee_year == '0')
		                          		<h3><strong>Application Time</strong></h3>
		                          	@else
		                          		<h3><strong>Year {{$newfee->fee_year}}</strong></h3>
		                          	@endif
		                      	</th>
		                      </tr>
	                     @endif
	                      <tr>
	                          <td>{{++$count}}</td>
	                          <td><strong>Created:</strong>{{$newfee->created_at->toDayDateTimeString()}}<br/>
	                          	<strong>Updated:</strong>{{$newfee->updated_at->toDayDateTimeString()}}</td>
	                          <td>{{$newfee->fee_name}}</td>
	                          <td>
	                            @if($newfee->active)
	                              <strong style="color:green">Active</strong>
	                            @else
	                             <strong style="color:red">Inactive</strong>
	                            @endif
	                          </td>
	                          <td>
	                          	<div class="table-responsive">
		                          	<table class="table">
		                          	<thead></thead>
		                          	<tbody>
		                          	<tr><th>GEN</th><th>&#8377;{{$newfee->gen}}</th></tr>
		                          	<tr><th>SC </th><th>&#8377;{{$newfee->sc}}</th></tr>
		                          	<tr><th>ST </th><th>&#8377;{{$newfee->st}}</th></tr>
		                          	<tr><th>OBC</th><th>&#8377;{{$newfee->obc}}</th></tr>
		                          	<tr><th>PWD</th><th>&#8377;{{$newfee->pwd}}</th></tr>
		                          	<tr><th>BPL</th><th>&#8377;{{$newfee->bpl}}</th></tr>
		                          	</tbody>
		                          	</table>
	                          	</div>
	                          </td>
	                          <td>
								<div class="dropdown">
								  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    Fee Actions
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								        <a href="{{ route('newfees.edit',$newfee->id)}}" class="dropdown-item">Edit</a>                
								        <form action="{{ route('newfees.destroy', $newfee->id)}}" method="post">&nbsp;&nbsp;&nbsp;
								            @csrf
								            @method('DELETE')
								            <button class="dropdown-item delete-confirm" type="submit"><strong style="color:red">Delete Fee</strong></button>
								        </form>
								  </div>
								</div>
	                          </td>
	                      </tr>
                      @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>ID</td>
                        <td>Timestamp</td>
                        <td>Name</td>
                        <td>Status</td>
                        
                        <td>Amount</td>
                        <td>Actions</td>
                    </tr>
                </tfoot>
              </table>

              </div>
          </div>
    </div>
  </div>
</div>
@endif

@endsection
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
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

$('.delete-confirm').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    Swal.fire({
      title: 'Are you sure?',
      text: 'You will not be able to recover this data!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      confirmButtonColor: "#DD6B55",
      cancelButtonText: 'No, keep it'
    }).then((result) => {
      if (result.value) {
        form.submit();
        Swal.fire(
          'Deleted!',
          'Your data has been deleted.',
          'success'
        )
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire(
          'Cancelled',
          'Your data is safe :)',
          'error'
        )
      }
    })
});
</script>
@endsection
