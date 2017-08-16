@extends('layout')

@section('content')
<a href="/boots" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Management - Boots - Add {{ $brands->brand }} Stock</h1>
	<p>Fill and submit the form below to add {{ $brands->brand }} stock.</p>
	
		<div class="box box-primary">
			<div class="box-header with-border">
				<H3 class="box-title">{{ $brands->brand }} Boots</H3>
			</div>
			<div class="box-body">
			<form action="/boots" method="POST" role="form" class="col-md-6">
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
					
					@include('ppe.boots.form2')
			        	
				</form>	
				<!--{{ var_dump($errors) }}-->
			</div>	
		</div>
	
@stop

