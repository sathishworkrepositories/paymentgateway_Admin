@php
$atitle ="coinlist";
@endphp
@extends('layouts.header')
@section('title', 'Coins Setting')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Token List Settings</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
          <h4 class="card-title">Token List Settings</h4>
            <div class="table-responsive">
             @if(in_array("write", explode(',',$AdminProfiledetails->coinsetting)))
              <a href="{{ url('/admin/addcoin') }}" class="btn btn-info">Add Token</a>
              @endif
              <br /><br />
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                              aria-hidden="true">&times;</span></button><strong>Success!</strong>
                      {{ session('status') }}
                  </div>
              @endif
              @if(count($commissions))
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Token Symbol</th>
                    <th>Token Type</th>
                    <th>Token Name</th>
                    <th>Withdraw Commssion</th>
                    <th>Contract Address</th>
                    <th>Decimal</th>
                    <th>Visiblity</th>
                    <th>Status</th>
                    @if(in_array("read", explode(',',$AdminProfiledetails->coinsetting)) || in_array("delete", explode(',',$AdminProfiledetails->coinsetting)))
                    <th>Action</th>
                    @endif
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($commissions as $key => $commission)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $commission->source }}</td>
                    <td>{{ ucfirst($commission->type) }}</td>
                    <td>{{ $commission->coinname }}</td>
                    <td>{{ $commission->withdraw }}</td>
                    <td>{{ $commission->contractaddress }}</td>
                    <td>{{ $commission->decimal_value }}</td>
                    <td>{{ $commission->shown == 1 ? 'Show' : 'Hide' }}</td>
                    <td>{{ $commission->status == 1 ? 'Active' : 'Inactive' }}</td>
                    @if(in_array("read", explode(',',$AdminProfiledetails->coinsetting)))
                        <td><a href="{{ url('/admin/coinsettings', Crypt::encrypt($commission->id)) }}"
                            class="btn btn-info">View / Edit</a></td>
                    @endif
                    @if(in_array("delete", explode(',',$AdminProfiledetails->coinsetting)))
                        <td><a href="{{ url('/admin/deletedcoin', Crypt::encrypt($commission->id)) }}"
                            class="btn btn-info">Delete</a></td>
                    @endif

                  </tr>
                @endforeach
                </tbody>
              </table>
              {{ $commissions->links() }}
              @else
                {{ 'No List Settings' }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
