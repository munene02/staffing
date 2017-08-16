@extends('layout')

@section('content')
<a href="/raincoats" class="btn bg-purple">GO BACK</a>
  <h1>Stock Tracking - Raincoats</h1>
  <p>Below is a list all stock changes for Raincoats.</p>

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Stock Tracking</h3>
          </div>
          <div class="box-body">
              <table class="table table-bordered">
                  <tbody>
                    
                  <tr>
                      <th style="width: 25px"></th>
                      <th>Type</th> 
                      <th>Details</th> 
                      <th>Size  </th> 
                      <th>Previous Qty</th> 
                      <th>New Qty</th> 
                      <th>Difference</th>
                      <th>Changed On</th>    
                      <th>Changed by</th>         
                  </tr>
                  @foreach($tracks as $track)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td> {{ $track->variant }} </td>
                      @if($track->raincoat->company == 'Plain')
                      <td>{{ $track->raincoat->color }} {{ $track->raincoat->company }}</td>
                      @else
                      <td>{{ $track->raincoat->color }} Printed {{ $track->raincoat->company }}</td>
                      @endif
                      <td> {{ $track->raincoat->size }} </td>
                      <td> {{ $track->before_quantity }} </td>
                      <td> {{ $track->after_quantity }} </td>
                      <td> {{ $track->quantity_increment }} </td>
                      <td> {{ Carbon\Carbon::parse($track->created_at)->format('h:i d/m/Y') }} </td>
                      <td> {{ ucfirst($track->user->name) }} {{ ucfirst($track->user->other_names) }} </td>
                  </tr>
                    @endforeach 
                  </tbody>
              </table>
          </div>
      </div>

@stop