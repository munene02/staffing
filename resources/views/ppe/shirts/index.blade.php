@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Shirts <a href="/shirts/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/shirts/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/shirts/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the shirts in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Shirts &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Shirt </th>  
                  <th>Shirt Size</th>         
                  <th>Shirt Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($shirts as $shirt)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $shirt->color }} Shirt  </td>
                  <td>{{ $shirt->size }}</td>
                  <td>{{ $shirt->quantity }}</td>
                  @if($shirt->quantity < $shirt->reorder_level)
                  <td class="text-red"><strong>{{ $shirt->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $shirt->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/shirts/add/{{$shirt->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop