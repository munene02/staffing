@extends('layout')

@section('content')
<a href="/blouses" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Blouses </h1>
	<p>Below is a list of all Blouse stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Blouses </h3>
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
                  <th>Blouse Color</th>
                  <th>Blouse Size</th>           
                  <th style="width: 200px">Blouse Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($blouses as $blouse)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $blouse->color }}  {{ $blouse->company }}  {{ $blouse->variant }} </td>
                  <td>{{ $blouse->size }}</td>
                  <td>
                  <form action="/blouses/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $blouse->quantity }}"><input type="hidden" name="blouse" value="{{$blouse->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/blouses/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $blouse->reorder_level }}"><input type="hidden" name="blouse" value="{{$blouse->id}}">
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