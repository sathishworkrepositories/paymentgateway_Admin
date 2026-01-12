<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Models\User;
use App\Models\UserKyc;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Traits\AddressCreation;
use App\Mail\AdminAcceptKyc;
use App\Mail\AdminRejectKyc;
use App\Models\Coinuser;
use App\Models\AdminsUser;
use Mail;

class KycController extends Controller
{
    use AddressCreation;

	public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
    	
    	$kyc = Kyc::index();

    	return view('user.kyc',[
    			'kyc' => $kyc
    		]);
    }

    public function kycview($id)
    {
        $kyc = Kyc::edit(Crypt::decrypt($id));

        return view('user.kyc_edit',[
                'kyc' => $kyc
            ]);
    }

    public function kycUpdate(Request $request)
    {
      $status = $request->status;
      $thisUser=Coinuser::find($request->uid);
      
      if($status == 1){
             
        $userkyc =Kyc::where('id',$request->kyc_id)->first();
        
        if ($userkyc->status == 0){

          //     $request->validate([
          //     'nameandsurname' => 'required|accepted',
          //     'namematchesproof' => 'required|accepted',
          //     'dobmatches' => 'required|accepted',
          //     'selfiesmatches' => 'required|accepted',
          //     'idnumbermatches' => 'required|accepted',
          //     'iddocument' => 'required|accepted',
          //     'addressproofmatches' => 'required|accepted',
          //     'proofofresidence' => 'required|accepted',

          // ], [
          //     // 'nameandsurname.required' => 'You must accept that the Name and Surname matches ID document.',
          //     // 'namematchesproof.required' => 'You must accept that the Name matches on Proof of residence, Bank statement etc.',
          //     // 'dobmatches.required' => 'You must accept that the Date of birth matches ID number.',
          //     // 'selfiesmatches.required' => 'You must accept that the Selfies matches ID.',
          //     // 'idnumbermatches.required' => 'You must accept that the Id number matches ID document.',
          //     // 'iddocument.required' => 'You must accept that the Id documents is legitimate.',
          //     // 'addressproofmatches.required' => 'You must accept that the Address matches proof of residences.',

          //     'nameandsurname.required' => 'Status can’t be successful due to the checklist not being ticked',
          //     'namematchesproof.required' => 'Status can’t be successful due to the checklist not being ticked',
          //     'dobmatches.required' => 'Status can’t be successful due to the checklist not being ticked',
          //     'selfiesmatches.required' => 'Status can’t be successful due to the checklist not being ticked',
          //     'idnumbermatches.required' => 'Status can’t be successful due to the checklist not being ticked',
          //     'iddocument.required' => 'Status can’t be successful due to the checklist not being ticked',
          //     'addressproofmatches.required' => 'Status can’t be successful due to the checklist not being ticked',
          //     'proofofresidence.required' => 'Status can’t be successful due to the checklist not being ticked',



          // ]);

          $validator = Validator::make($request->all(), [
            'nameandsurname' => 'required|accepted',
            'namematchesproof' => 'required|accepted',
            'dobmatches' => 'required|accepted',
            'selfiesmatches' => 'required|accepted',
            'idnumbermatches' => 'required|accepted',
            'iddocument' => 'required|accepted',
            'addressproofmatches' => 'required|accepted',
            'proofofresidence' => 'required|accepted',
        ], [
            'nameandsurname.required' => 'Status can’t be successful due to the checklist not being ticked',
            'namematchesproof.required' => 'Status can’t be successful due to the checklist not being ticked',
            'dobmatches.required' => 'Status can’t be successful due to the checklist not being ticked',
            'selfiesmatches.required' => 'Status can’t be successful due to the checklist not being ticked',
            'idnumbermatches.required' => 'Status can’t be successful due to the checklist not being ticked',
            'iddocument.required' => 'Status can’t be successful due to the checklist not being ticked',
            'addressproofmatches.required' => 'Status can’t be successful due to the checklist not being ticked',
            'proofofresidence.required' => 'Status can’t be successful due to the checklist not being ticked',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

          if(isset($userkyc))
          {
            $this->EmailAcceptKYC($thisUser);

            AdminsUser::updateadmin($thisUser);
            AdminsUser::updateUserkyc($userkyc);
            // AffliateTransaction::affliate_transaction($request->uid,0,'register');
          }
          
        }
       
      }
      else if($status == 2)
      {
        $this->EmailRejectKYC($thisUser,$request);
      }
     $kyc = Kyc::updateKyc($request);
      return back()->with('status','Kyc Updated Successfully');
    }


    public function EmailAcceptKYC($thisUser)
    {
        
      try {
       Mail::to($thisUser['email'])->send(new AdminAcceptKyc($thisUser));
     } catch (Exception $e){
       dd($e);
     }
    }

    public function EmailRejectKYC($thisUser)
    {
      try {
       Mail::to($thisUser['email'])->send(new AdminRejectKyc($thisUser));
     } catch (Exception $e){
       dd($e);
     }
    }


}
