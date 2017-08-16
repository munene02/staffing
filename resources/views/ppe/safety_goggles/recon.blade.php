@extends('layout')

@section('content')
<a href="/safety_goggles" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Safety Goggles </h1>
	<p>Below is a list of all Safety Goggle stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Safety Goggles </h3>
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
                  <th>Safety Goggle Name</th>           
                  <th style="width: 200px">Safety Goggle Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($safety_goggles as $safety_goggle)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $safety_goggle->safety_goggle }} </td>
                  <td>
                  <form action="/safety_goggles/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $safety_goggle->quantity }}"><input type="hidden" name="safety_goggle" value="{{$safety_goggle->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/safety_goggles/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $safety_goggle->reorder_level }}"><input type="hidden" name="safety_goggle" value="{{$safety_goggle->id}}">
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