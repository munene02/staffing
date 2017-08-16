@extends('layout')

@section('content')
<a href="/shirts" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Shirts </h1>
	<p>Below is a list of all Shirt stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Shirts </h3>
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
                  <th>Shirt Color</th> 
                  <th>ShirtSize</th>           
                  <th style="width: 200px">Shirt Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($shirts as $shirt)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $shirt->color }}  {{ $shirt->company }}  {{ $shirt->variant }} </td>
                  <td>{{ $shirt->size }}</td>
                  <td>
                  <form action="/shirts/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $shirt->quantity }}"><input type="hidden" name="shirt" value="{{$shirt->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/shirts/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $shirt->reorder_level }}"><input type="hidden" name="shirt" value="{{$shirt->id}}">
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