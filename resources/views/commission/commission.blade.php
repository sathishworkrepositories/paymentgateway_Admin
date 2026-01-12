@php
$atitle ="commission";
@endphp
@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Commission Settings</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
          <h4 class="card-title">Commission Settings </h4>
            <div class="table-responsive">
           
              @if(count($commissions))
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Currency</th>
                    <th>Name</th>
                    <th>Withdraw %</th>
                    <th>Net Fee</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody> 
                @foreach($commissions as $key => $commission)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $commission->source }}</td>
                    <td>{{ $commission->coinname }}</td>
                    <td>{{ $commission->withdraw }}</td>
                    <td>{{ number_format($commission->netfee, 8) }}</td>
                    <td><a href="{{ url('/admin/commissionsettings', Crypt::encrypt($commission->id)) }}" class="btn btn-info">View / Edit</a></td>
                    
                  </tr>
                @endforeach
                </tbody>
              </table>
              {{ $commissions->links() }}
              @else
                {{ 'No Commissions Settings' }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection