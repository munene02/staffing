@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Safety Goggle <a href="/safety_goggles/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/safety_goggles/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/safety_goggles/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the safety_goggle in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Safety Goggles &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	<a href="/safety_goggles/add" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a>

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Safety Goggle Name</th>           
                  <th>Safety Goggle Quantity</th>
                  <th>Reorder Level Quantity</th>
                </tr>
                @foreach($safety_goggles as $safety_goggle)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $safety_goggle->safety_goggle }} </td>
                  <td>{{ $safety_goggle->quantity }}</td>
                  @if($safety_goggle->quantity < $safety_goggle->reorder_level)
                  <td class="text-red"><strong>{{ $safety_goggle->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $safety_goggle->reorder_level }}</strong></td>
                  @endif                  
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop