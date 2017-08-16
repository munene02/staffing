@extends('layout')

@section('content')
<a href="/aprons" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Management - Apron - Add Stock</h1>
	<p>Fill and submit the form below to add glove stock.</p>
	
		<div class="box box-primary">
			<div class="box-header with-border">
				<H3 class="box-title">
				@if($aprons->company == 'Plain')
				{{ $aprons->company }} {{ $aprons->color }} Apron {{ $aprons->variant }}
				@else 
				{{ $aprons->color }} Apron printed {{ $aprons->company }}  {{ $aprons->variant }}
				@endif
				</H3>
			</div>
			<div class="box-body">
			<form action="/aprons" method="POST" role="form" class="col-md-6">
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

					@include('ppe.aprons.form2')
			        	
				</form>	
				<!--{{ var_dump($errors) }}-->
			</div>	
		</div>
@stop	