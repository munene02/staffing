@extends('layout')

@section('content')
<a href="/requisitions" class="btn bg-purple">GO BACK</a> 

	<h1>PPE Requisitions - System Requisitions</h1>
  @if(count($details) <= 0)
    <p>There are no stock items on the requisition form.</p>
  @else
    <p>Below is a list of the requisition stock items</p>
    @foreach($details as $detailArray => $action)
      <div class="box">
              <div class="box-header">
                <h3 class="box-title"> {{ucfirst($detailArray)}} Requisitions</h3>
              </div>

              <div class="box-body">
                <table class="table table-bordered">
                  <tbody><tr>
                    <th style="width: 25px"></th>
                    <th>Requested Item</th>           
                    <th>Requested Qty</th>
                    <th>Stock Item Details</th>
                    <th>Requested on</th>
                    <th>Requested By</th>
                    @if($detailArray == 'approved') 
                    <th>Approved By</th>                       
                    @endif 
                    @if($detailArray == 'denied') 
                    <th>Cancelled By</th>                       
                    @endif   
                  </tr>
                  @foreach($action as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($item->requisitionDetail->stock_name) }} </td>
                    <td>{{ $item->requisitionDetail->quantity }}</td>
                    <td>{{ $item->requisitionDetail->stock_details }}</td>
                    <td> {{ Carbon\Carbon::parse($item->requisitionDetail->created_at)->format('h:i d/m/Y') }} </td>
                    <td>{{ ucfirst($item->requisitionDetail->user->name) }} {{ ucfirst($item->requisitionDetail->user->other_names) }} </td>
                    @if($detailArray == 'pending')
                    <td><center>                    
                        <div class="btn-group">
                          <button type="button" class="btn bg-teal btn-flat pull-center">Actions</button>
                          <button type="button" class="btn bg-teal btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="/requisitions/approve/{{$item->id}}/{{$item->requisitionDetail->id}}">Approve Requisition</a></li>
                            <li><a href="/requisitions/deny/{{$item->id}}">Deny Requisition </a></li>
                          </ul>
                        </div></center>
                    </td>   
                    @endif 
                    @if($detailArray == 'approved' || $detailArray == 'denied') 
                    <td>{{ ucfirst($item->user->name) }} {{ ucfirst($item->user->other_names) }} </td>    
                    @endif                
                  </tr>
                  @endforeach
                  </tbody></table>
              </div>
      </div>
      @endforeach
  @endif
	 
    
@stop