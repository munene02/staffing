@extends('layout')

@section('content')
<a href="/requisitions" class="btn bg-purple">GO BACK</a> 

	<h1>PPE Requisitions - My Requisitions</h1>
  @if(count($details) <= 0)
    <p>There are no requisition items for your account.</p>
  @else
    <p>Below is a list of the requisition stock items</p>
    @foreach($details as $action => $detailArray)
      <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                 @if($action == 'not_submitted')
                  My Yet To Be Submitted Requisitions
                 @else
                  My {{ucfirst($action)}} Requisitions
                 @endif 
                </h3>
              </div>

              <div class="box-body">
                <table class="table table-bordered">
                  <tbody><tr>
                    <th style="width: 25px"></th>
                    <th>Requested Item</th>           
                    <th>Requested Qty</th>
                    <th>Stock Item Details</th>
                    <th>Requested on</th>
                    @if($action == 'not_submitted')
                    <th></th>
                    @endif
                    @if($action == 'submitted')
                    <th>Status</th>
                    @endif
                  </tr>
                   @foreach($detailArray as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($item->stock_name) }} </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->stock_details }}</td>
                    <td> {{ Carbon\Carbon::parse($item->created_at)->format('h:i d/m/Y') }} </td>
                    @if($action == 'not_submitted')
                    <td><center>                    
                        <div class="btn-group">
                          <button type="button" class="btn btn-info bg-teal pull-center">Actions</button>
                          <button type="button" class="btn btn-info bg-teal dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="/requisitions/submit/{{$item->id}}">Submit Requisition</a></li>
                            <li><a href="/requisitions/cancel/{{$item->id}}">Cancel Requisition</a></li>
                          </ul>
                        </div></center>
                    </td>
                    @endif 
                    @if($action == 'submitted')
                      @if($item->requisition->status == 'approved')
                      <th class="text-green">{{ ucfirst($item->requisition->status) }}</th>
                      @elseif($item->requisition->status == 'denied')
                      <th class="text-red">{{ ucfirst($item->requisition->status) }}</th>
                      @else
                      <th class="text-red">{{ ucfirst($item->requisition->status) }}</th>
                      @endif
                    @endif                                
                  </tr>
                  @endforeach
                  </tbody></table>
              </div>
      </div>
     @endforeach 
  @endif
	 
    
@stop