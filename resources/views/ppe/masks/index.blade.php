@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Mask <a href="/masks/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/masks/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/masks/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the mask in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Masks &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	<a href="/masks/add" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a>

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Mask Name</th>           
                  <th>Mask Quantity</th>
                  <th>Reorder Level Quantity</th>
                </tr>
                @foreach($masks as $mask)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $mask->mask }} </td>
                  <td>{{ $mask->quantity }}</td>
                  @if($mask->quantity < $mask->reorder_level)
                  <td class="text-red"><strong>{{ $mask->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $mask->reorder_level }}</strong></td>
                  @endif                  
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop