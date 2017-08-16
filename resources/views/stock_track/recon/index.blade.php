@extends('layout')

@section('content')

  <h1>Stock Tracking - Reconciliations</h1>
  <p>Below is a list all Reconciliations. If you wish to FILTER them by Stock item select it from the dropdown:-</p>
  @foreach($recons as $recon)
    @if($recon->table_name=='aprons')
      <div class="box">
          <div class="box-header">
            <h3 class="box-title"> Apron Reconciliation Tracking</h3>
          </div>
          <div class="box-body">
              <table class="table table-bordered">
                  <tbody>
                  <tr>
                      <th style="width: 25px"></th>
                      <th>Stock Details</th> 
                      <th>Previous Qty</th> 
                      <th>New Qty</th> 
                      <th>Difference</th>
                      <th>Changed On</th>    
                      <th>Changed by</th>         
                  </tr>
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>
                          
                      </td>
                      <td> {{ $recon->before_quantity }} </td>
                      <td> {{ $recon->after_quantity }} </td>
                      <td> {{ $recon->quantity_increment }} </td>
                      <td> {{ Carbon\Carbon::parse($recon->created_at)->format('h:i d/m/Y') }} </td>
                      <td> {{ ucfirst($recon->user->name) }} {{ ucfirst($recon->user->other_names) }} </td>
                  </tr>
                  </tbody>
              </table>
          </div>
      </div>
    @endif
  @endforeach 
@stop