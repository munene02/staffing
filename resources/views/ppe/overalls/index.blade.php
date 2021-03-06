@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Overalls <a href="/overalls/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/overalls/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/overalls/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the overalls in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Overalls &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Overall </th>  
                  <th>Overall Size</th>         
                  <th>Overall Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($overalls as $overall)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  @if($overall->company == 'Plain')
                  <td>  {{ $overall->company }} {{ $overall->color }} overall {{ $overall->variant }} </td>
                  @else
                  <td> {{ $overall->color }} overall printed {{ $overall->company }}  {{ $overall->variant }} </td>
                  @endif
                  <td>{{ $overall->size }}</td>
                  <td>{{ $overall->quantity }}</td>
                  @if($overall->quantity < $overall->reorder_level)
                  <td class="text-red"><strong>{{ $overall->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $overall->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/overalls/add/{{$overall->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop