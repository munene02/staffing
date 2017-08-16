@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Aprons <a href="/aprons/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/aprons/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/aprons/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the aprons in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Aprons &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Apron </th>  
                  <th>Apron Size</th>         
                  <th>Apron Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($aprons as $apron)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  @if($apron->company == 'Plain')
                  <td>  {{ $apron->company }} {{ $apron->color }} apron  </td>
                  @else
                  <td> {{ $apron->color }} apron printed {{ $apron->company }} </td>
                  @endif
                  <td>{{ $apron->size }}</td>
                  <td>{{ $apron->quantity }}</td>
                  @if($apron->quantity < $apron->reorder_level)
                  <td class="text-red"><strong>{{ $apron->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $apron->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/aprons/add/{{$apron->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop