@extends('layout')

@section('content')
<a href="/gloves" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Gloves </h1>
	<p>Below is a list of all Glove stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Gloves </h3>
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
                  <th>Glove Name</th>           
                  <th style="width: 200px">Glove Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($gloves as $glove)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $glove->glove }} </td>
                  <td>
                  <form action="/gloves/addrecon" method="POST" role="form">{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $glove->quantity }}"><input type="hidden" name="glove" value="{{$glove->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/gloves/addrecon" method="POST" role="form">{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $glove->reorder_level }}"><input type="hidden" name="glove" value="{{$glove->id}}">
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