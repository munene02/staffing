@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 
<h1>Stock Management - Boots <a href="/boots/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/boots/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/boots/create" class="btn btn-success pull-right margin  ">Add New Stock</a></h1>
<p>Below is a list of the boots in stock.</p>
@foreach($brands as $brand)
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $brand->brand }} &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total {{ $brand->boots->sum('quantity') }}</h3>
              <a href="/boots/add/{{ $brand->id }}" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a>
            </div>
			@if($brand->boots->count() >= 1)
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Boot Size</th>
                  <th>Boot Height</th>            
                  <th>Boot Quantity</th>
                  <th>Reorder Level Quantity</th>
                </tr>
				@foreach($brand->boots as $boot)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $boot->shoeSize->size }}</td>
                  <td>{{ $boot->bootHeight->height }}</td>
                  <td>{{ $boot->quantity }}</td>
                  @if($boot->quantity < $boot->reorder_level)
                  <td class="text-red"><strong>{{ $boot->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $boot->reorder_level }}</strong></td>
                  @endif 
                </tr>

                @endforeach
              </tbody></table>
            </div>
            @endif
    	</div>
@endforeach	

@stop