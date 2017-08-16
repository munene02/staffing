@extends('layout')

@section('content')
<a href="/ppe" class="btn bg-purple">GO BACK</a> 

	<h1>Stock Management - Ear Plug <a href="/ear_plugs/track" class="btn bg-orange pull-right margin  ">Track Stock</a>
                                      <a href="/ear_plugs/recon/" class="btn btn-info pull-right margin  ">Reconcile Stock</a>
                                <a href="/ear_plugs/create" class="btn btn-success pull-right margin  ">Add New Stock</a>
  </h1>
	 <p>Below is a list of the ear_plug in stock.</p>

		<div class="box">
            <div class="box-header">
            	<h3 class="box-title"> Ear Plug &nbsp;&nbsp; - &nbsp;&nbsp;
              				  Total  {{ $sum }} </h3>
              	<a href="/ear_plugs/add" class="pull-right"><i class="fa fa-plus"></i> Increment Stock</a>

            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Ear Plug Name</th>           
                  <th>Ear Plug Quantity</th>
                  <th>Reorder Level Quantity</th>
                </tr>
                @foreach($ear_plugs as $ear_plug)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $ear_plug->ear_plug }} </td>
                  <td>{{ $ear_plug->quantity }}</td>
                  @if($ear_plug->quantity < $ear_plug->reorder_level)
                  <td class="text-red"><strong>{{ $ear_plug->reorder_level }} - Reorder Level reached</strong></td>
                  @else
                  <td><strong>{{ $ear_plug->reorder_level }}</strong></td>
                  @endif                  
                </tr>
                @endforeach
                </tbody></table>
            </div>
		</div>
    
@stop