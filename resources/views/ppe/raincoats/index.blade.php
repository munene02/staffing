@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Raincoats <a href="/raincoats/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/raincoats/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/raincoats/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the raincoats in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Raincoats &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Raincoat </th>  
                  <th>Raincoat Size</th>         
                  <th>Raincoat Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($raincoats as $raincoat)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  @if($raincoat->company == 'Plain')
                  <td>  {{ $raincoat->company }} {{ $raincoat->color }} raincoat  </td>
                  @else
                  <td> {{ $raincoat->color }} raincoat printed {{ $raincoat->company }} </td>
                  @endif
                  <td>{{ $raincoat->size }}</td>
                  <td>{{ $raincoat->quantity }}</td>
                  @if($raincoat->quantity < $raincoat->reorder_level)
                  <td class="text-red"><strong>{{ $raincoat->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $raincoat->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/raincoats/add/{{$raincoat->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop