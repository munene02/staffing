@extends('layout')

@section('content')
<a href="/raincoats" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Management - Raincoat - Add Stock</h1>
	<p>Fill and submit the form below to add glove stock.</p>
	
		<div class="box box-primary">
			<div class="box-header with-border">
				<H3 class="box-title">
				@if($raincoats->company == 'Plain')
				{{ $raincoats->company }} {{ $raincoats->color }} Raincoat {{ $raincoats->variant }}
				@else 
				{{ $raincoats->color }} Raincoat printed {{ $raincoats->company }}  {{ $raincoats->variant }}
				@endif
				</H3>
			</div>
			<div class="box-body">
			<form action="/raincoats" method="POST" role="form" class="col-md-6">
					{!! csrf_field() !!}
					@if(count($errors) > 0)
				        		<div class="alert alert-danger">
				        			<ul>
				        				@foreach($errors->all() as $error)
				        				<li>{{ $error }}</li>
				        				@endforeach
				        			</ul>
				        		</div>
				    @endif

					@include('ppe.raincoats.form2')
			        	
				</form>	
				<!--{{ var_dump($errors) }}-->
			</div>	
		</div>
@stop	