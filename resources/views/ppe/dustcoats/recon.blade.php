@extends('layout')

@section('content')
<a href="/dustcoats" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Dustcoats </h1>
	<p>Below is a list of all Dustcoat stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Dustcoats </h3>
        </div>
        <div class="box-body">
      		@if(count($errors) > 0)
        		<div class="alert alert-danger">
        			<ul>
        				@foreach($errors->all() as $error)
        				<li>{{ $error }}</li>
        				@endforeach
        			</ul>
        		</div>
			    @endif
			<table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 50px"></th>
                  <th>Dustcoat Name</th>   
                  <th>Dustcoat Size</th>         
                  <th style="width: 200px">Dustcoat Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($dustcoats as $dustcoat)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $dustcoat->color }}  {{ $dustcoat->company }}  {{ $dustcoat->variant }} </td>
                  <td>{{ $dustcoat->size }}</td>
                  <td>
                  <form action="/dustcoats/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $dustcoat->quantity }}"><input type="hidden" name="dustcoat" value="{{$dustcoat->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/dustcoats/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $dustcoat->reorder_level }}"><input type="hidden" name="dustcoat" value="{{$dustcoat->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit1">Save</button>
                    </span></div>
                    </form>
                  </td>                 
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
	</div>




@stop