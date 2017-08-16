@extends('layout')

@section('content')
<a href="/tshirts" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Tshirts </h1>
	<p>Below is a list of all Tshirt stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Tshirts </h3>
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
                  <th>Tshirt Color</th>   
                  <th>Tshirt Size</th>         
                  <th style="width: 200px">Tshirt Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($tshirts as $tshirt)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $tshirt->color }}  {{ $tshirt->company }}  {{ $tshirt->variant }} </td>
                  <td>{{ $tshirt->size }}</td>
                  <td>
                  <form action="/tshirts/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $tshirt->quantity }}"><input type="hidden" name="tshirt" value="{{$tshirt->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/tshirts/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $tshirt->reorder_level }}"><input type="hidden" name="tshirt" value="{{$tshirt->id}}">
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