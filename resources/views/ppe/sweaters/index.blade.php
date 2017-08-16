@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Sweaters <a href="/sweaters/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/sweaters/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/sweaters/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the sweaters in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Sweaters &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Sweater </th>  
                  <th>Sweater Size</th>         
                  <th>Sweater Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($sweaters as $sweater)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $sweater->color }} Sweater  </td>
                  <td>{{ $sweater->size }}</td>
                  <td>{{ $sweater->quantity }}</td>
                  @if($sweater->quantity < $sweater->reorder_level)
                  <td class="text-red"><strong>{{ $sweater->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $sweater->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/sweaters/add/{{$sweater->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop