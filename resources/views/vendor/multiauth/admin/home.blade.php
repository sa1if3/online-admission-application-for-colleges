@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Home</h1>
@stop
@section('content')
<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{sprintf('%02d',$countCategory)}}</h3>

                <p>Categories</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <a href="{{route('categories.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{sprintf('%02d',$countReligion)}}</h3>

                <p>Religions</p>
              </div>
              <div class="icon">
                <i class="fa fa-peace"></i>
              </div>
              <a href="{{route('religions.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{sprintf('%02d',$countBoard)}}</h3>

                <p>Boards</p>
              </div>
              <div class="icon">
                <i class="fa fa-clipboard"></i>
              </div>
              <a href="{{route('boards.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{sprintf('%02d',$countCourse)}}</h3>

                <p>Courses</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="{{route('courses.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="psmsBalance">{{$smsBalance}}</h3>

                <p>SMS Balance</p>
              </div>
              <div class="icon">
                <i class="fa fa-envelope"></i>
              </div>
              <a href="#" target="_blank" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 id="psmsBalance">{{sprintf('%04d',$countStudent)}}</h3>

                <p>Students</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{route('admin_students.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
        <!-- /.row -->
</div>
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
  smsBalance();
});

function smsBalance() {
        $.ajax({
            method: 'get',
            url: "{!!route('getSMSBalance')!!}",
            complete: function (result) {
              console.log(result.responseText);
              $data = JSON.parse(result.responseText); //convert the response to object 
              
               
              document.getElementById('psmsBalance').innerHTML=$data.available_balance.transactional_balance; //Echo out transactional balance
               
            }
        })
    }//end of smsBalance()
</script>
@endsection