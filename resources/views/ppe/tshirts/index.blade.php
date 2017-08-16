@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Tshirts <a href="/tshirts/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/tshirts/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/tshirts/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the tshirts in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Tshirts &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Tshirt </th>  
                  <th>Tshirt Size</th>         
                  <th>Tshirt Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($tshirts as $tshirt)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $tshirt->color }} Tshirt  </td>
                  <td>{{ $tshirt->size }}</td>
                  <td>{{ $tshirt->quantity }}</td>
                  @if($tshirt->quantity < $tshirt->reorder_level)
                  <td class="text-red"><strong>{{ $tshirt->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $tshirt->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/tshirts/add/{{$tshirt->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop