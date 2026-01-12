@php
$atitle ="withdraw";
@endphp
@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>{{ $currency }} Withdraw History</h1>
	</header>
	@if(session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
        </div>

    @endif
	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
		   <div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>Date & Time</th>
							<th>Full Name</th>
							<th>Sender</th>
							<th>Recipient</th>
							<th>Amount</th> 
							<th>Fee</th> 
							<th>Status</th> 
						</tr>
					</thead>
					<tbody>
					    @if(count($transaction) > 0)
					@foreach($transaction as $transactions)
						<tr>
							<td>{{ date('Y/m/d h:i:s', strtotime($transactions->created_at)) }}</td>
							<td><a href="{{ url('admin/users_edit/'.Crypt::encrypt($transactions->user_id)) }} ">{{  $transactions->user['name'] }}</a></td>
							<td>{{ $transactions->sender }}</td>
							<td>{{ $transactions->reciever }}</td>
							<td>{{ number_format($transactions->request_amount, 8, '.', '') }}</td>
							<td>{{ number_format($transactions->admin_fee, 8, '.', '') }}</td>
							<td>
							    @if($transactions->status == 1) 
							     <a class="btn btn-success btn-xs" href="{{ url('/admin/crypto_withdraw_edit/'.$transactions->id) }}"><i class="zmdi zmdi-edit"></i> View </a> 
                                @elseif($transactions->status == 0)  Waiting email confirmation
                                @elseif($transactions->status == 2) 
                                 Sent/complete.
                                @endif
							</td> 
						</tr>
					@endforeach
					@else
					    <tr><td colspan="7"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($transaction->count())
				@endif
                </div>
              </div>
			</div>
		</div>
	</div>
	</div>
	</div>
</section>
@endsection