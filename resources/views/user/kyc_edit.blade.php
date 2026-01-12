@php
$atitle ="user";
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>KYC Submits</h1>
    </header>
    @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
    @endif
    <div class="card">
      <div class="card-body">
        <a href="{{ url('admin/kyc') }}"><i class="zmdi zmdi-arrow-left"></i> Back to KYC Submit</a>
		    <br />
        <br />
        <form method="POST" action="{{ url('admin/kycupdate') }}">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>First Name</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fname" class="form-control" value="{{ $kyc->fname }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Last Name</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="lname" class="form-control" value="{{ $kyc->lname }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Gender</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="gender_type" class="form-control" value="{{ $kyc->gender_type }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Date of Birth</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="dob" class="form-control date-picker" value="{{ $kyc->dob }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>State</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="state" class="form-control" value="{{ $kyc->state }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>City</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="city" class="form-control" value="{{ $kyc->city }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Zip Code</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="zip_code" class="form-control" value="{{ $kyc->zip_code }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Country</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="country" class="form-control" value="{{ $kyc->country }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Telegram Name</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="telegram_name" class="form-control" value="{{ $kyc->telegram_name }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

            <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Address Line1</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <textarea  name="address_line1" class="form-control" >{{ $kyc->address_line1 ? $kyc->address_line1 : '-' }}</textarea>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Address Line2</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <textarea  name="address_line2" class="form-control" >{{ $kyc->address_line2 ? $kyc->address_line2 : '-' }}</textarea>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Type</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="id_type" class="form-control" value="{{ $kyc->id_type }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Number</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="id_number" class="form-control" value="{{ $kyc->id_number }}" >
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
        <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Expiry Date</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="id_exp" class="form-control date-picker" value="{{ $kyc->id_exp  }}" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div> 

         
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Front Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->front_img }}"><img width="200px" src="{{ $kyc->front_img }}"></a> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Back Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->back_img }}"><img width="200px" src="{{ $kyc->back_img }}"></a></div>
            </div>
          </div> 

         
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Selfie Image Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->selfie_img }}"><img width="200px" src="{{ $kyc->selfie_img }}"></a> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Recident Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->proofpaper }}"><img width="200px" src="{{ $kyc->proofpaper }}"></a></div>
            </div>
          </div>

       <!--     <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Selfie identity photo</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="{{ $kyc->selfie_img }}"><img width="200px" src="{{ $kyc->selfie_img }}"></a></div>
            </div>
          </div> -->
          
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Status</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                  <select class="form-control" name="status" @if($kyc->status != 0) disabled @endif>
                    <option value="0" @if($kyc->status == 0) selected @endif>Waiting</option>
                    <option value="1" @if($kyc->status == 1) selected @endif>Accepted</option>
                    <option value="2" @if($kyc->status == 2) selected @endif>Rejected</option>
                  </select> 
              </div>
            </div>
          </div>
            @if($kyc->status != 0)
              <input type="hidden" name="status" value="{{$kyc->status}}"/>
            @endif
              <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Remark</label>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                @if($kyc->status == 2)
                <textarea type="text" name="remark" class="form-control">{{ $kyc->remark ? $kyc->remark :' ' }}</textarea>
                @else
                   <textarea type="text" name="remark" class="form-control"></textarea>
                @endif
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

          <br>
          <div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="nameandsurname" name="nameandsurname">
									<label class="form-check-label" for="nameandsurname">Name and Surname matches ID document</label>
					</div>

          <div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="namematchesproof" name="namematchesproof">
									<label class="form-check-label" for="namematchesproof">Name matches on Proof of residence, Bank statement etc</label>
					</div>

          <div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="dobmatches" name="dobmatches">
									<label class="form-check-label" for="dobmatches">Date of birth matches ID number</label>
					</div>

          <div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="selfiesmatches" name="selfiesmatches">
									<label class="form-check-label" for="selfiesmatches">Selfies matches ID</label>
					</div>

          <div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="idnumbermatches" name="idnumbermatches">
									<label class="form-check-label" for="idnumbermatches">Id number matches ID document</label>
					</div>

          <div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="iddocument" name="iddocument">
									<label class="form-check-label" for="iddocument">Id documents is legitimate</label>
					</div>

          <div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="addressproofmatches" name="addressproofmatches">
									<label class="form-check-label" for="addressproofmatches">Address matches proof of residences</label>
					</div>

          <div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="proofofresidence" name="proofofresidence">
									<label class="form-check-label" for="proofofresidence">Proof of Residence not older than 3 months</label>
					</div>


          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            <div class="col-md-12">
               <input type="hidden" name="kyc_id" value="{{ $kyc->id }}"/>
               <input type="hidden" name="uid" value="{{ $kyc->uid }}"/>
               <input type="submit" class="btn btn-md btn-warning" value="Update"> <br /><br />
               <p class='text text-info'>Note : Once you accept / reject kyc, You can't update the status again!</p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
   @if($errors->any())
        toastr.error('{{$errors->first() }}'); 
  @endif
 </script>
 
@endsection


