@extends('layout')

@section('content')

<h1>Employee Management - Add an Employee</h1>
<p>Enter Employee Details Below:</p>

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> Employee Details</h3>
  </div>
  <div class="box-body">
  <form action="/employees/add" method="POST" role="form" class="col-md-6">
    {!! csrf_field() !!}
    @if(count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

  </form>
</div>