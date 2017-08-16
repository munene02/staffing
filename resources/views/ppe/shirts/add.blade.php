@extends('layout')

@section('content')
<a href="/shirts" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Management - Shirt - Add Stock</h1>
	<p>Fill and submit the form below to add glove stock.</p>
	
		<div class="box box-primary">
			<div class="box-header with-border">
				<H3 class="box-title">
				 {{ $shirts->color }} Shirt
				</H3>
			</div>
			<div class="box-body">
			<form action="/shirts" method="POST" role="form" class="col-md-6">
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

					@include('ppe.shirts.form2')
			        	
				</form>	
				<!--{{ var_dump($errors) }}-->
			</div>	
		</div>
@stop	