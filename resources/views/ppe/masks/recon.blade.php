@extends('layout')

@section('content')
<a href="/masks" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Masks </h1>
	<p>Below is a list of all Mask stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Masks </h3>
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
                  <th>Mask Name</th>           
                  <th style="width: 200px">Mask Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($masks as $mask)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $mask->mask }} </td>
                  <td>
                  <form action="/masks/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $mask->quantity }}"><input type="hidden" name="mask" value="{{$mask->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/masks/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $mask->reorder_level }}"><input type="hidden" name="mask" value="{{$mask->id}}">
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