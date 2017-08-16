@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Reflector Jackets <a href="/reflector_jackets/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/reflector_jackets/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/reflector_jackets/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
                                
  </h1>
	 <p>Below is a list of the reflector_jackets in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Reflector Jackets &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Reflector Jacket</th>  
                  <th>Reflector Jacket Size</th>         
                  <th>Reflector Jacket Quantity</th>
                  <th>Reorder Level Quantity</th>
                  <th></th>
                </tr>
                @foreach($reflector_jackets as $reflector_jacket)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  @if($reflector_jacket->company == 'Plain')
                  <td>{{ $reflector_jacket->company }} </td>
                  @else
                  <td>Printed {{ $reflector_jacket->company }} </td>
                  @endif
                  <td>{{ $reflector_jacket->size }}</td>
                  <td>{{ $reflector_jacket->quantity }}</td>
                  @if($reflector_jacket->quantity < $reflector_jacket->reorder_level)
                  <td class="text-red"><strong>{{ $reflector_jacket->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $reflector_jacket->reorder_level }}</strong></td>
                  @endif  
                  <td><a href="/reflector_jackets/add/{{$reflector_jacket->id}}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a></td>                
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop