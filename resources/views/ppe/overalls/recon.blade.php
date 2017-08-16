@extends('layout')

@section('content')
<a href="/overalls" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Overalls </h1>
	<p>Below is a list of all Overall stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Overalls </h3>
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
                  <th>Overall Name</th>  
                  <th>BOverall Size</th>          
                  <th style="width: 200px">Overall Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($overalls as $overall)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $overall->color }}  {{ $overall->company }}  {{ $overall->variant }} </td>
                  <td>{{ $overall->size }}</td>
                  <td>
                  <form action="/overalls/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $overall->quantity }}"><input type="hidden" name="overall" value="{{$overall->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/overalls/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $overall->reorder_level }}"><input type="hidden" name="overall" value="{{$overall->id}}">
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