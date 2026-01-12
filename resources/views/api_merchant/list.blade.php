@php
$atitle ="category";
@endphp
@extends('layouts.header')
@section('title', 'Merchant Api Category List')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1 class="card-title">Merchant Api Category List</h1>
    </header>
    <div class="row">

      <div class="col-md-12">
        <a href="{{ url('/admin/addcat') }}" class="btn btn-info">Add Category</a>
        </br><br>

          @if(session('status'))
          <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
          </div>
          @endif
        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
           
              @if(count($forum) > 0)
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Category</th>
                    <th>Date/time</th>
                    @if(in_array("write", explode(',',$AdminProfiledetails->merchant_api)))
                    <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody> 
                  @php
                $limit=10;
                $i=1;
                if(isset($_GET['page'])){
                $page = $_GET['page'];
                $i = (($limit * $page) - $limit)+1;
                }else{
                $i =1;
                }
                @endphp
                @foreach($forum as $key => $value)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $value->category }}</td>
                    <td>{{ $value->created_at }}</td>
                     @if(in_array("write", explode(',',$AdminProfiledetails->merchant_api)))
                    <td><a href="{{ url('/admin/viewcategory', Crypt::encrypt($value->id)) }}" class="btn btn-info">View / Edit </a>
                    @endif
                     @if(in_array("delete", explode(',',$AdminProfiledetails->merchant_api)))
                    <a href="{{ url('/admin/cat_delete/'.Crypt::encrypt($value->id)) }}" class="btn btn-info">Remove </a>
                    @endif
                    </td>

               
                    
                  </tr>
                  @php $i++; @endphp  
                @endforeach
                </tbody>
              </table>
              {{ $forum->links() }}
              @else
                {{ 'No Records Settings' }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection