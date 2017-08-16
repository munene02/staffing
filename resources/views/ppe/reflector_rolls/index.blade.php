@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Reflector Roll <a href="/reflector_rolls/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/reflector_rolls/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/reflector_rolls/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the reflector_roll in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Reflector Roll &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	<a href="/reflector_rolls/add" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a>

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Reflector Roll Name</th>           
                  <th>Reflector Roll Quantity</th>
                  <th>Reorder Level Quantity</th>
                </tr>
                @foreach($reflector_rolls as $reflector_roll)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $reflector_roll->reflector_roll }} </td>
                  <td>{{ $reflector_roll->quantity }}</td>
                  @if($reflector_roll->quantity < $reflector_roll->reorder_level)
                  <td class="text-red"><strong>{{ $reflector_roll->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $reflector_roll->reorder_level }}</strong></td>
                  @endif                  
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop