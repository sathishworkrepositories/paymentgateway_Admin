<?php

namespace App\Models;
use Session;

use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    protected $connection = 'mysql';
    protected $table = 'users_profiles';

 public static function adminprofile(){

    $adminid = Session::get('adminId');
    $admin = AdminProfile::where(['user_id' => $adminid])->first();
    return $admin;
}
}
