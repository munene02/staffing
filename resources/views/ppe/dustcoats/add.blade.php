@extends('layout')

@section('content')
<a href="/dustcoats" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Management - Dustcoat - Add Stock</h1>
	<p>Fill and submit the form below to add glove stock.</p>
	
		<div class="box box-primary">
			<div class="box-header with-border">
				<H3 class="box-title">
				@if($dustcoats->company == 'Plain')
				{{ $dustcoats->company }} {{ $dustcoats->color }} Dustcoat {{ $dustcoats->variant }}
				@else 
				{{ $dustcoats->color }} Dustcoat printed {{ $dustcoats->company }}  {{ $dustcoats->variant }}
				@endif
				</H3>
			</div>
			<div class="box-body">
			<form action="/dustcoats" method="POST" role="form" class="col-md-6">
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

					@include('ppe.dustcoats.form2')
			        	
				</form>	
				<!--{{ var_dump($errors) }}-->
			</div>	
		</div>
@stop	