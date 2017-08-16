@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Helmet <a href="/helmets/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/helmets/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/helmets/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the helmet in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Helmet &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	<a href="/helmets/add" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a>

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Helmet Name</th>           
                  <th>Helmet Quantity</th>
                  <th>Reorder Level Quantity</th>
                </tr>
                @foreach($helmets as $helmet)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $helmet->helmet }} </td>
                  <td>{{ $helmet->quantity }}</td>
                  @if($helmet->quantity < $helmet->reorder_level)
                  <td class="text-red"><strong>{{ $helmet->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $helmet->reorder_level }}</strong></td>
                  @endif                  
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop