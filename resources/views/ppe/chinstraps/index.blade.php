@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Chinstrap <a href="/chinstraps/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/chinstraps/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/chinstraps/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the chinstrap in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Chinstrap &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	<a href="/chinstraps/add" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a>

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Chinstrap Name</th>           
                  <th>Chinstrap Quantity</th>
                  <th>Reorder Level Quantity</th>
                </tr>
                @foreach($chinstraps as $chinstrap)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $chinstrap->chinstrap }} </td>
                  <td>{{ $chinstrap->quantity }}</td>
                  @if($chinstrap->quantity < $chinstrap->reorder_level)
                  <td class="text-red"><strong>{{ $chinstrap->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $chinstrap->reorder_level }}</strong></td>
                  @endif                  
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop