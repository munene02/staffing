@extends('layout')

@section('content')
<a href="/reflector_rolls" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Management - Reflector Roll - Add Stock</h1>
	<p>Fill and submit the form below to add glove stock.</p>
	
		<div class="box box-primary">
			<div class="box-header with-border">
				<H3 class="box-title"> Reflector Roll</H3>
			</div>
			<div class="box-body">
			<form action="/reflector_rolls" method="POST" role="form" class="col-md-6">
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

					@include('ppe.reflector_rolls.form2')
			        	
				</form>	
				<!--{{ var_dump($errors) }}-->
			</div>	
		</div>
@stop	