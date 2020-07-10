@extends('adminlte::page')
@section('title','Show Fees')

@section('content_header')
    <h1>Show Fees of <strong style="color:red;">{{$course->name}}</strong> <a style="float:right" href="{{ route('feesheads.create',['course_id'=>$course->id])}}" class="btn btn-warning">Add New Fees</a>&nbsp;&nbsp;&nbsp;</h1>
@stop

@section('content')

<div class="container-fluid">                  
  <div class="row">
    <div class="col-sm-12">
          <div class="card card-secondary">
              <div class="card-header">
              <h3 class="card-title">Fees List </h3>
              </div>
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
             
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Created</td>
                        <td>Last Modified</td>
                        <td>Fee Name</td>
                        <td>Fee Amount</td>
                        <td>Status</td>
                        <td>Fee Waived?</td>
                        <td>Category</td>
                        <td>Gender</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                      @php($count=0)
                      @foreach($feebodys as $feebody)
                      <tr>
                          <td>{{++$count}}</td>
                          <td>{{Carbon\Carbon::parse($feebody->created_at)->toDayDateTimeString()}}</td>
                          <td>{{Carbon\Carbon::parse($feebody->updated_at)->toDayDateTimeString()}}</td>
                          <td>{{$feebody->name}}</td>
                          <td>&#8377;&nbsp;{{$feebody->fee}}/-</td>
                          <td>
                            @if($feebody->active)
                              <strong style="color:green">Active</strong>
                            @else
                             <strong style="color:red">Inactive</strong>
                            @endif
                          </td>
                          <td>
                            @if($feebody->checkBPL)
                              <strong><i class="fa fa-check" style="color:green"></i>&nbsp;BPL</strong>
                            @else
                             <strong><i class="fa fa-times" style="color:red"></i>&nbsp;BPL</strong>
                            @endif        
                            <br/>                    
                            @if($feebody->checkPWD)
                              <strong><i class="fa fa-check" style="color:green"></i>&nbsp;PWD</strong>
                            @else
                             <strong><i class="fa fa-times" style="color:red"></i>&nbsp;PWD</strong>
                            @endif                                
                          </td>
                          <td>{{$feebody->category_record_name}}</td>
                          <td>{{$feebody->gender_record_name}}</td>
                          <td>
                            <!-- <div class="btn-group"> -->
                              <div>
                              <a href="{{ route('feesheads.edit',$feebody->id)}}" class="btn btn-primary">Edit</a>
                              <form action="{{ route('feesheads.destroy', $feebody->id)}}" method="post">&nbsp;&nbsp;
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-confirm" type="submit">Delete</button>
                              </form>
                            </div>
                          </td>
                      </tr>
                      @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>ID</td>
                        <td>Created</td>
                        <td>Last Modified</td>
                        <td>Fee Name</td>
                        <td>Fee Amount</td>
                        <td>Status</td>
                        <td>Fee Waived?</td>
                        <td>Category</td>
                        <td>Gender</td>
                        <td>Actions</td>
                    </tr>
                </tfoot>
              </table>
             </div>
         </div>
         </div>
     </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="col-sm-4">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Search Fee Breakdown&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="float: right;"class="btn btn-warning search-doubt">Hint&nbsp;<i class="fa fa-exclamation"></i></button></h3>
            </div>
          <div class="card-body">
            <form method="post" action="{{ route('feesheads.store') }}">
                @csrf
                <input type="hidden" name="course_record_id" value="{{$course->id}}">
                <div class="form-group">
                  <label>Select Category:</label>
                  <select class="form-control select2" name="category_id" style="width: 100%;">
                    @foreach($categorys as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Gender:</label>
                  <select class="form-control select2" name="gender_id" style="width: 100%;">
                    @foreach($genders as $gender)
                    <option value="{{$gender->id}}">{{$gender->name}}</option>
                    @endforeach
                  </select>
                </div>
                  <label style="color:red;">Special Section</label><br/> 
 
                      <!-- radio 1-->
                      <div class="form-group">
                        <div class="custom-control custom-radio">
                          
                          <input class="custom-control-input" type="radio" id="customRadio1" name="BPLWaiver" value="1">
                          <label for="customRadio1" class="custom-control-label">Is BPL?</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio2" name="BPLWaiver" value="0" checked>
                          <label for="customRadio2" class="custom-control-label">Not BPL?</label>
                        </div>
                      </div>


                      <!-- radio -->
                      <div class="form-group">
                        <div class="custom-control custom-radio">
                          
                          <input  class="custom-control-input" type="radio" name="PWDWaiver" value="1" id="customRadio3">
                          <label for="customRadio3" class="custom-control-label">Is PWD?</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input  class="custom-control-input" type="radio" name="PWDWaiver" value="0" checked id="customRadio4">
                          <label for="customRadio4" class="custom-control-label">Not PWD?</label>
                        </div>
                      </div>                 
                <button type="submit" class="btn btn-warning" style="float: right;"><i class="fa fa-search"></i>&nbsp;Search in {{$course->name}}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>
@endsection
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
@section('js')
<script>
  $(function () {

    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

  });

$('.search-doubt').on('click',function(e){
			Swal.fire({
			  position: 'top-end',
			  type: 'info',
			  title: 'Search Logic',
			  html: '<ol style="text-align:left"><li>Use this feature to search fee breakdown per student.</li><li>The Search can be done based on Category,Gender.</li><li>Student BPL and PWD can Fee Waiver is also shown in breakdown.</li><li>For data integrity this same search logic is used to calculate the fees of the student.</li><li>Only fees with Active status is searched.</li><ol>',
			  showConfirmButton: true
			});	
});

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