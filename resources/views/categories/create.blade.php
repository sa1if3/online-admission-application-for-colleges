@extends('adminlte::page')
@section('title','Add a Category')

@section('content_header')
    <h1>Add a Category</h1>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-8 offset-sm-2">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add a Category</h3>
            </div>
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
            <form method="post" action="{{ route('categories.store') }}">
                @csrf
                <div class="form-group">    
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" name="name"/>
                </div>                      
                <button type="submit" class="btn btn-primary" style="float: right;">Add Category</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection