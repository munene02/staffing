@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Gloves <a href="/gloves/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/gloves/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/gloves/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the gloves in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Gloves &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	<a href="/gloves/add" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a>

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Glove Name</th>           
                  <th>Glove Quantity</th>
                  <th>Reorder Level Quantity</th>
                </tr>
                @foreach($gloves as $glove)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $glove->glove }} </td>
                  <td>{{ $glove->quantity }}</td>
                  @if($glove->quantity < $glove->reorder_level)
                  <td class="text-red"><strong>{{ $glove->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $glove->reorder_level }}</strong></td>
                  @endif                  
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop