@extends('layout')

@section('content')
<a href="/boots" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Boots </h1>
	<p>Below is a list of all Boot stock for reconciliation.</p>
		@if(count($errors) > 0)
    		<div class="alert alert-danger">
    			<ul>
    				@foreach($errors->all() as $error)
    				<li>{{ $error }}</li>
    				@endforeach
    			</ul>
    		</div>
		@endif
	@foreach($brands as $brand)
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $brand->brand }} </h3>
            </div>
			@if($brand->boots->count() >= 1)
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 25px"></th>
                  <th>Boot Size</th>
                  <th>Boot Height</th>            
                  <th style="width: 180px">Boot Quantity</th>
                  <th style="width: 180px">Reorder Level Quantity</th>
                </tr>
				@foreach($brand->boots as $boot)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $boot->shoeSize->size }}</td>
                  <td>{{ $boot->bootHeight->height }}</td>
                  <td>
                  <form action="/boots/addrecon" method="POST" role="form">{!! csrf_field() !!}
	                 <div class="input-group">
	                  	<input type="text" class="form-control" name="quantity" value="{{ $boot->quantity }}">
                      <input type="hidden" name="boot" value="{{$boot->id}}">
		                  	<span class="input-group-btn">
		                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
		                    </span>
	                 </div>
				  </form>
					</td>
                  <td>
                  	<form action="/boots/addrecon" method="POST" role="form">{!! csrf_field() !!}
	                  	<div class="input-group">
		                  	<input type="text" class="form-control" name="reorder_level" value="{{ $boot->reorder_level }}"><input type="hidden" name="boot" value="{{$boot->id}}">
		                  	<span class="input-group-btn">
		                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit1">Save</button>
		                    </span>
	                    </div>
                    </form>
                  </td>
                  
                </tr>

                @endforeach
              </tbody></table>
            </div>
            @endif
    	</div>
@endforeach   
@stop	