@extends('layout')

@section('content')
<a href="/raincoats" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Raincoats </h1>
	<p>Below is a list of all Raincoat stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Raincoats </h3>
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
                  <th>Raincoat Name</th> 
                  <th>Raincoat Size</th>           
                  <th style="width: 200px">Raincoat Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($raincoats as $raincoat)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $raincoat->color }}  {{ $raincoat->company }}  {{ $raincoat->variant }} </td>
                  <td>{{ $raincoat->size }}</td>
                  <td>
                  <form action="/raincoats/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $raincoat->quantity }}"><input type="hidden" name="raincoat" value="{{$raincoat->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/raincoats/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $raincoat->reorder_level }}"><input type="hidden" name="raincoat" value="{{$raincoat->id}}">
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