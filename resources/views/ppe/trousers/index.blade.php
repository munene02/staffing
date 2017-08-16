@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Trousers <a href="/trousers/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/trousers/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/trousers/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the trousers in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Trousers &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Trouser </th>  
                  <th>Trouser Size</th>         
                  <th>Trouser Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($trousers as $trouser)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $trouser->color }} Trouser  </td>
                  <td>{{ $trouser->size }}</td>
                  <td>{{ $trouser->quantity }}</td>
                  @if($trouser->quantity < $trouser->reorder_level)
                  <td class="text-red"><strong>{{ $trouser->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $trouser->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/trousers/add/{{$trouser->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop