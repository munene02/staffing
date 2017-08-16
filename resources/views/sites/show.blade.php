@extends('layout')

@section('content')
<h1></h1>

@endsection

@foreach($sites as $site)
     <div class="box-body">
     	<div class="row">
     		<div class="col-md-3">  			
     			{{ $loop->iteration }} .{{$site->site}}
     		</div>
     		<div class="col-md-3">
     			{{ $site->location}}
     		</div>
     		<div class="col-md-3">
     			{{ $site->code}}
     		</div>
     	</div>	
     </div>
  @endforeach