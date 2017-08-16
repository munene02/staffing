@extends('layout')

@section('content')
<a href="/ear_plugs" class="btn bg-purple">GO BACK</a> 
	<h1>Stock Reconciliation - Ear Plugs </h1>
	<p>Below is a list of all Ear Plug stock for reconciliation.</p>
	<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Ear Plugs </h3>
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
                  <th>Ear Plug Name</th>           
                  <th style="width: 200px">Ear Plug Quantity</th>
                  <th style="width: 200px"> Reorder Level Quantity</th>
                </tr>
                @foreach($ear_plugs as $ear_plug)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $ear_plug->ear_plug }} </td>
                  <td>
                  <form action="/ear_plugs/addrecon" method="POST" >{!! csrf_field() !!}
                  <div class="input-group"><input type="text" class="form-control" name="quantity" value="{{ $ear_plug->quantity }}"><input type="hidden" name="ear_plug" value="{{$ear_plug->id}}">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" id="btn-submit">Save</button>
                    </span></div>
				  </form>
                  </td>
				  <td>
				  <form action="/ear_plugs/addrecon" method="POST" >{!! csrf_field() !!}<div class="input-group"><input type="text" class="form-control" name="reorder_level" value="{{ $ear_plug->reorder_level }}"><input type="hidden" name="ear_plug" value="{{$ear_plug->id}}">
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