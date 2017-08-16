@extends('layout')

@section('content')
<a href="/requisitions" class="btn bg-purple">GO BACK</a> 

	<h1>PPE Requisitions - Requisition Form</h1>
  @if(count($details) <= 0)
    <p>There are no stock items on the requisition form.</p>
  @else
    <p>Below is a list of the requisition stock items</p>
   
      <div class="box">
              <div class="box-header">
                <h3 class="box-title"> Requisition List</h3>
              </div>

              <div class="box-body">
                <table class="table table-bordered">
                  <tbody><tr>
                    <th style="width: 25px"></th>
                    <th>Requested Item</th>           
                    <th>Requested Qty</th>
                    <th>Stock Item Details</th>
                    <th>Requested on</th>
                    <th>Requested by</th>
                    <th></th>
                  </tr>
                   @foreach($details as $detail)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($detail->stock_name) }} </td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->stock_details }}</td>
                    <td> {{ Carbon\Carbon::parse($detail->created_at)->format('h:i d/m/Y') }} </td>
                    <td> {{ ucfirst($detail->user->name) }} {{ ucfirst($detail->user->other_names) }} </td> 
                    <td><center>
                        <div class="btn-group">
                          <button type="button" class="btn btn-info btn-flat pull-center">Actions</button>
                          <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="/requisitions/submit/{{$detail->id}}">Submit Requisition</a></li>
                            <li><a href="/requisitions/cancel/{{$detail->id}}">Cancel Requisition</a></li>                          
                          </ul>
                        </div></center>
                    </td>                                 
                  </tr>
                  @endforeach
                  </tbody></table>
              </div>
      </div>
      
  @endif
	 
    
@stop