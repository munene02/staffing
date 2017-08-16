@extends('layout')

@section('content')
<a href="/caps" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Caps </h1>
	<p>Below is a list of all Cap stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Caps </h3>
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
                  <th>Cap color</th>           
                  <th style="width: 200px">Cap Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($caps as $cap)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $cap->color }}  {{ $cap->company }}  {{ $cap->variant }} </td>
                  <td>
                  <form action="/caps/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $cap->quantity }}"><input type="hidden" name="cap" value="{{$cap->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/caps/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $cap->reorder_level }}"><input type="hidden" name="cap" value="{{$cap->id}}">
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