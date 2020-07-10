@extends('student.layouts.studentbase')

@section('title')
Student | Instructions
@endsection

@section('content')
<div class="site-section">
<div class="container">
  <h2>Progress: Instructions</h2>
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="10" aria-valuemax="100" style="width:10%">
      10%
    </div>
  </div>
</div>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Instructions</div>

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
                <div class="table-responsive">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($instructions=explode("\n",$course->description))
                    @php($count=0)
                    @foreach($instructions AS $instruction)
                    <tr>
                      <th scope="row">{{++$count}}.</th>
                      <td>{{$instruction}}</td>
                    </tr>
                    @endforeach
<!--                     <tr>
                      <th scope="row">3.</th>
                      <td>
                        Examination Fees.
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Category</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">General </th>
                                    <td>Rs. 1000/- (One Thousand) </td>
                                </tr>
                                <tr>
                                    <th scope="row">OBC-(NCL)/EWS </th>
                                    <td>Rs. 500/- (Five Hundred)  </td>
                                </tr>
                                <tr>
                                    <th scope="row">OBC-(NCL)/EWS </th>
                                    <td>Rs. 500/- (Five Hundred)  </td>
                                </tr>
                                <tr>
                                    <th scope="row">SC / ST / Person with Disabilities(PwD)/Transgender</th>
                                    <td>Rs. 250 /- (Two Hundred Fifty)</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Service Charges & GST (as applicable) will be charged extra by the Bank.</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                      </td>
                    </tr> -->
                    <tr>
                        <td colspan="2" style="text-align: right;">
                        <form method="post" action="{{route('ApplicationUpdateAgree')}}">
                            @csrf
                            <h5><input type="checkbox" name="instruction_agree" value="1" required="true" /> I have went through the instructions and agree to all of them.</h5><br/>
                            <button class="btn-lg btn-warning">Confirm</button>
                        </form>
                        </td>
                    </tr>
                  </tbody>
                </table>                    

                </div>
            </div>
        </div>
    </div>
</div>
</div> 
</div>
@endsection
