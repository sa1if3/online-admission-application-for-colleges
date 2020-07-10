@extends('adminlte::page')
@section('title','Students List')

@section('content_header')
    <h1>Students List</h1>
@stop

@section('content')



<div class="container-fluid">                  
  <div class="row">
    <div class="col-sm-12">
          <div class="card card-secondary">
              <div class="card-header">
              <h3 class="card-title">Students List</h3>
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
                        <td>Name</td>
                        <td>E-Mail</td>
                        <td>Mobile</td>
                        <td>Status</td>
                        <td>Application</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                      @php($count=0)
                      @foreach($admin_students as $admin_student)
                      <tr>
                          <td>{{++$count}}</td>
                          <td>{{Carbon\Carbon::parse($admin_student->created_at)->toDayDateTimeString()}}</td>
                          <td>{{Carbon\Carbon::parse($admin_student->updated_at)->toDayDateTimeString()}}</td>
                          <td>{{$admin_student->name}}</td>
                          <td>{{$admin_student->email}}</td>
                          <td>{{$admin_student->mobile}}</td>
                          <td>
                            <!-- 0 - Not Submitted, 1 - Submitted, 2- Accepted, 3- Rejected    -->
                            @if($admin_student->app_status == 0)
                              <strong style="color:grey">Not Submitted</strong>
                            @elseif($admin_student->app_status == 1)
                              <strong style="color:blue">Submitted</strong>
                            @elseif($admin_student->app_status == 2)
                              <strong style="color:green">Accepted</strong>
                            @else
                              <strong style="color:red">Rejected</strong>
                            @endif
                          </td>
                          <td>
                            @if($admin_student->application_id)
                              <a target="_blank" href="{{ route('displayStudentApplication',encrypt($admin_student->application_id))}}">{{$admin_student->application_id}}</a>
                            @endif
                          </td>
                          <td>
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Student Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      @if($admin_student->application_id)
        @if($admin_student->app_status == 1 || $admin_student->app_status == 3)
          <form method="post" action="{{ route('admin_students.update', $admin_student->app_primary_id) }}">
              @method('PATCH') 
              @csrf
              
              <input type="hidden" name="status" value="2">
              
              <button class="dropdown-item task-confirm" type="submit"><strong style="color:green">Accept Student</strong></button>
          </form>
          @endif
        @if($admin_student->app_status == 2)
          <form method="post" action="{{ route('admin_students.update', $admin_student->app_primary_id) }}">
              @method('PATCH') 
              @csrf
              
              <input type="hidden" name="status" value="3">
              
              <button class="dropdown-item task-confirm" type="submit"><strong style="color:black">Reject Student</strong></button>
          </form>
          @endif
      @endif                  
        <form action="{{ route('admin_students.destroy', $admin_student->id)}}" method="post">&nbsp;&nbsp;&nbsp;
            @csrf
            @method('DELETE')
            <button class="dropdown-item delete-confirm" type="submit"><strong style="color:red">Delete Student</strong></button>
        </form>
  </div>
</div>
                            <div class="btn-group">


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
                        <td>Name</td>
                        <td>E-Mail</td>
                        <td>Mobile</td>
                        <td>Status</td>
                        <td>Application</td>
                        <td>Actions</td>
                    </tr>
                </tfoot>
              </table>
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

$('.task-confirm').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    Swal.fire({
      title: 'Are you sure?',
      text: 'Student will receive SMS/E-Email with Status!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Confirm it!',
      confirmButtonColor: "#DD6B55",
      cancelButtonText: 'No, cancel'
    }).then((result) => {
      if (result.value) {
        form.submit();
        Swal.fire(
          'Toggled!',
          'Your data has been modified.',
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
