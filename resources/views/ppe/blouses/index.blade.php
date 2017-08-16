@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Blouses <a href="/blouses/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/blouses/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/blouses/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the blouses in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Blouses &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Blouse </th>  
                  <th>Blouse Size</th>         
                  <th>Blouse Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($blouses as $blouse)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $blouse->color }} Blouse  </td>
                  <td>{{ $blouse->size }}</td>
                  <td>{{ $blouse->quantity }}</td>
                  @if($blouse->quantity < $blouse->reorder_level)
                  <td class="text-red"><strong>{{ $blouse->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $blouse->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/blouses/add/{{$blouse->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop