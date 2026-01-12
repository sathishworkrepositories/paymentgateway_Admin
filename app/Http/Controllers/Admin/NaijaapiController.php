<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Apicategory;
use App\Models\Subapicategory;

class NaijaapiController extends Controller {

    public function __construct() {
        $this->middleware('admin');
    }

    public function index() {
        $forum = Apicategory::index();
        return view('api_merchant.list',[
            'forum' => $forum
        ]);
    }

    public function addforum() {
        return view('api_merchant.add');
    }

    public function addcategory(Request $request) {
        $this->validate($request, [
            'category' => 'required|max:50'
        ]);
        if($request->category !="" ) {
            $forum = Apicategory::addforum($request);
            return redirect('/admin/category')->with('status','Added Successfully!');
        } else {
            return redirect('/admin/addforum')->with('error','Field required!');
        }
    }

    public function viewcategory($id) {
        $id = Crypt::decrypt($id);
        $forum = Apicategory::view($id);
        return view('api_merchant.edit',[
            'forum' => $forum
        ]);
    }

    public function updatecategory(Request $request) {
        $this->validate($request, [
            'category' => 'required|max:50'
        ]);
        if($request->category !="" ) {
            $forum = Apicategory::formupdate($request);
            return redirect('/admin/category')->with('status','Updated Successfully!');
        } else {
            $id = Crypt::encrypt($request->id);
            return redirect('/admin/viewcategory/'.$id)->with('error','Field required!');
        }
    }

    public function cat_rem($id) {
        $id = \Crypt::decrypt($id);
        $faq = Apicategory::catdestroy($id);
        if($faq){
            return redirect('admin/category')->with('status',$faq);
        } else {
            return redirect('admin/category')->with('error','Failed try again!');
        }
    }

    public function subcategory() {
        $forum = Subapicategory::index();
        return view('sub_api_merchant.list',[
            'forum' => $forum
        ]);
    }

    public function subaddcat() {
        $category = Apicategory::index();
        return view('sub_api_merchant.add',['category' => $category]);
    }

    public function subaddcategory(Request $request) {
        $this->validate($request, [
            'category' => 'required|max:50',
            'subcategory' => 'required|max:50',
            'description' => 'required',
        ]);
        $forum = Subapicategory::addforum($request);
        return redirect('/admin/subcategory')->with('status','Added Successfully!');
    }

    public function subviewcategory($id) {
        $id = Crypt::decrypt($id);
        $forum = Subapicategory::view($id);
        $category = Apicategory::index();
        return view('sub_api_merchant.edit',[
            'forum' => $forum,
            'category' => $category
        ]);
    }

    public function subupdatecategory(Request $request) {
        $this->validate($request, [
            'category' => 'required|max:50',
            'subcategory' => 'required|max:50',
            'description' => 'required',
        ]);
        $forum = Subapicategory::formupdate($request);
        return redirect('/admin/subcategory')->with('status','Updated Successfully!');
    }

    public function subcat_delete($id) {
        $id = \Crypt::decrypt($id);
        $faq = Subapicategory::catdestroy($id);
        if($faq) {
            return redirect('admin/subcategory')->with('status',$faq);
        } else {
            return redirect('admin/subcategory')->with('error','Failed try again!');
        }
    }

}