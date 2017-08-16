@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Dustcoats <a href="/dustcoats/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/dustcoats/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/dustcoats/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the dustcoats in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Dustcoats &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Dustcoat </th>  
                  <th>Dustcoat Size</th>         
                  <th>Dustcoat Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($dustcoats as $dustcoat)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  @if($dustcoat->company == 'Plain')
                  <td>  {{ $dustcoat->company }} {{ $dustcoat->color }} dustcoat  </td>
                  @else
                  <td> {{ $dustcoat->color }} dustcoat printed {{ $dustcoat->company }} </td>
                  @endif
                  <td>{{ $dustcoat->size }}</td>
                  <td>{{ $dustcoat->quantity }}</td>
                  @if($dustcoat->quantity < $dustcoat->reorder_level)
                  <td class="text-red"><strong>{{ $dustcoat->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $dustcoat->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/dustcoats/add/{{$dustcoat->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop