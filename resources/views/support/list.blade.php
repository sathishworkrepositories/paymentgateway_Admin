@php
$atitle ="support";
@endphp
@extends('layouts.header')
@section('title', 'Support Ticket')
@section('content')
<section class="content">
<header class="content__title">
  <h1>Support</h1>
</header>
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      @if($tickets->count() > 0)
      <table class="table">
        <thead>
          <tr>
            <th>Date & Time</th>
            <th>Ticket Id</th>
            <th>Full name</th>
            <th>Subject</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tickets as $ticket)
          <tr>
            <td>{{ date('d-m-Y H:i:s', strtotime($ticket->created_at)) }}</td>
            <td>{{ $ticket->ticket_id }}</td>
            <td>{{ $ticket->name }}</td>
            <td>{{ $ticket->subject }}</td>
            <td><a class="btn btn-primary btn-xs"  href="{{ url('/admin/reply/'.Crypt::encrypt($ticket->id)) }}" class="btn btn-info">Chat</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else 
      Yet no one raise support ticket
      @endif
    </div>
  </div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> Delete </div>
      <div class="modal-body"> Are you sure you want to delete this user? </div>
      <div class="modal-footer"> <a class="btn btn-danger btn-ok">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
</div>
</section>
@endsection