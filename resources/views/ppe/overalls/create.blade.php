@extends('layout')

@section('content')
<a href="/overalls" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Management - Overall - Add Stock</h1>
	<p>Fill and submit the form below to add glove stock.</p>
	
		<div class="box box-primary">
			<div class="box-header with-border">
				<H3 class="box-title"> Overall</H3>
			</div>
			<div class="box-body">
			<form action="/overalls" method="POST" role="form" class="col-md-6">
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

					@include('ppe.overalls.form')
			        	
				</form>	
				<!--{{ var_dump($errors) }}-->
			</div>	
		</div>
@stop	