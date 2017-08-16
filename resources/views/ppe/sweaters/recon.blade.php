@extends('layout')

@section('content')
<a href="/sweaters" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Sweaters </h1>
	<p>Below is a list of all Sweater stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Sweaters </h3>
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
                  <th>Sweater Color</th>
                  <th>Sweater Size</th>            
                  <th style="width: 200px">Sweater Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($sweaters as $sweater)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $sweater->color }}  {{ $sweater->company }}  {{ $sweater->variant }} </td>
                  <td>{{ $sweater->size }}</td>
                  <td>
                  <form action="/sweaters/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $sweater->quantity }}"><input type="hidden" name="sweater" value="{{$sweater->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/sweaters/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $sweater->reorder_level }}"><input type="hidden" name="sweater" value="{{$sweater->id}}">
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