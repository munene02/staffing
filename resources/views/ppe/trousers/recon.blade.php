@extends('layout')

@section('content')
<a href="/trousers" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Trousers </h1>
	<p>Below is a list of all Trouser stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Trousers </h3>
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
                  <th>Trouser Color</th>   
                  <th>Trouser Size</th>         
                  <th style="width: 200px">Trouser Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($trousers as $trouser)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $trouser->color }}  {{ $trouser->company }}  {{ $trouser->variant }} </td>
                  <td>{{ $trouser->size }}</td>
                  <td>
                  <form action="/trousers/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $trouser->quantity }}"><input type="hidden" name="trouser" value="{{$trouser->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/trousers/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $trouser->reorder_level }}"><input type="hidden" name="trouser" value="{{$trouser->id}}">
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