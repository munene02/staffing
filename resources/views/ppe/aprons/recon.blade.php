@extends('layout')

@section('content')
<a href="/aprons" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Aprons </h1>
	<p>Below is a list of all Apron stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Aprons </h3>
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
                  <th>Apron Name</th>
                  <th>Apron SIze</th>           
                  <th style="width: 200px">Apron Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($aprons as $apron)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $apron->color }}  {{ $apron->company }}  {{ $apron->variant }} </td>
                  <td>{{ $apron->size }}</td>
                  <td>
                  <form action="/aprons/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $apron->quantity }}"><input type="hidden" name="apron" value="{{$apron->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/aprons/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $apron->reorder_level }}"><input type="hidden" name="apron" value="{{$apron->id}}">
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