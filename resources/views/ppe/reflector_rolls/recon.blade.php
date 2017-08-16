@extends('layout')

@section('content')
<a href="/reflector_rolls" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Reflector Rolls </h1>
	<p>Below is a list of all Reflector Roll stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Reflector Rolls </h3>
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
                  <th>Reflector Roll Name</th>           
                  <th style="width: 200px">Reflector Roll Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($reflector_rolls as $reflector_roll)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $reflector_roll->reflector_roll }} </td>
                  <td>
                  <form action="/reflector_rolls/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $reflector_roll->quantity }}"><input type="hidden" name="reflector_roll" value="{{$reflector_roll->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/reflector_rolls/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $reflector_roll->reorder_level }}"><input type="hidden" name="reflector_roll" value="{{$reflector_roll->id}}">
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