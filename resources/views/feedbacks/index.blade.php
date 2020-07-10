@extends('adminlte::page')
@section('title','Feedback List')

@section('content_header')
    <h1>Feedback List</h1>
@stop

@section('content')



<div class="container-fluid">                  
  <div class="row">
    <div class="col-sm-12">
          <div class="card card-secondary">
              <div class="card-header">
              <h3 class="card-title">Feedback List</h3>
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
                        <td>Name</td>
                        <td>Email</td>
                        <td>Course</td>
                        <td>Department</td>
                        <td>Message</td>
                    </tr>
                </thead>
                <tbody>
                      @php($count=0)
                      @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{++$count}}</td>
                            <td>{{Carbon\Carbon::parse($feedback->created_at)->toDayDateTimeString()}}</td>
                            <td>{{$feedback->name}}</td>
                            <td>{{$feedback->email}}</td>
                            <td>{{$feedback->course_record_name}}</td>
                            <td>{{$feedback->department}}</td>
                            <td>{{$feedback->feedback_message}}</td>
                        </tr>
                      @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>ID</td>
                        <td>Created</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Course</td>
                        <td>Department</td>
                        <td>Message</td>
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

</script>
@endsection
