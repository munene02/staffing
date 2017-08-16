@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Caps <a href="/caps/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/caps/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/caps/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the caps in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Caps &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Cap </th>         
                  <th>Cap Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($caps as $cap)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $cap->color }} Cap  </td>
                  <td>{{ $cap->quantity }}</td>
                  @if($cap->quantity < $cap->reorder_level)
                  <td class="text-red"><strong>{{ $cap->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $cap->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/caps/add/{{$cap->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop