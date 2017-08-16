@extends('layout')

@section('content')
	<h1>PPE Requisitions <a href="/requisitions/form" class="btn bg-orange pull-right">View Requisition Form</a></h1>
	<p>Select a Stock Item to ADD to the Requisition.</p>

	<div class="row">
	@foreach($items as $item)
		<div class="col-lg-3 col-xs-6">
			@if($loop->index == 0)
				<div class="small-box bg-primary">
			@elseif($loop->index == 1)
				<div class="small-box bg-yellow">
			@elseif($loop->index == 2)
				<div class="small-box bg-green">
			@elseif($loop->index == 3)
				<div class="small-box bg-red">
			@elseif($loop->index == 4)
				<div class="small-box bg-aqua">	
			@elseif($loop->index == 5)
				<div class="small-box bg-teal">
			@elseif($loop->index == 6)
				<div class="small-box bg-purple">
			@elseif($loop->index == 7)
				<div class="small-box bg-maroon">
			@elseif($loop->index == 8)
				<div class="small-box bg-orange">
			@elseif($loop->index == 9)
				<div class="small-box bg-fuchsia">
			@elseif($loop->index == 10)
				<div class="small-box bg-teal">	
			@elseif($loop->index == 11)
				<div class="small-box bg-lime">
			@elseif($loop->index == 12)
				<div class="small-box bg-green">
			@elseif($loop->index == 13)
				<div class="small-box bg-red">
			@elseif($loop->index == 14)
				<div class="small-box bg-aqua">	
			@elseif($loop->index == 15)
				<div class="small-box bg-navy">
			@elseif($loop->index == 16)
				<div class="small-box bg-purple">
			@elseif($loop->index == 17)
				<div class="small-box bg-maroon">
			@else($loop->index == 18)
				<div class="small-box bg-orange">	

			@endif
	            <div class="inner">
	              <h4><strong>{{ $item['title'] }}</strong></h4>

	               <span class="info-box-number">{{ $item['total'] }} in Total</span>
	            </div>
	            <div class="icon">
	              <i class="fa fa-shopping-cart"></i>
	            </div>
	            <a href="/requisitions/{{ $item['link']}}" class="small-box-footer">
	              <strong>ADD {{ $item['title'] }} </strong><i class="fa fa-arrow-circle-right"></i>
	            </a>
		    </div>
		</div>
	@endforeach	
	</div>

@stop