@extends('layout')

@section('content')
<h1>Client Management - View a client</h1>
<p>CLICK on a client to view Client Details</p>

        <div class="box">
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tbody><tr>
                  <th style="width: 15px"></th>
                  <th>Client Name</th>
                  <th>No. of Sites</th>
                  <th>No. of Employess</th>

                </tr>
                @foreach($clients as $client)
                <tr>
                  <td>{{$loop->iteration}}.</td>
                  <td><a href="/clients/{{$client->id}}">{{$client->name}}</a></td>
                  <td>
                    {{$client->sites_count}}
                  </td>
                  <td>{{$client->employees_count}}</td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
          </div>

@endsection          