<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Admin extends Model
{
    use HasFactory;
    public static $admin; 
    public static $superAdmin; 

    public static function registerInfoSave($request)
    {
        self::$superAdmin = Admin::where('adminType',1)->first();
        self::$admin = new Admin();
        self::$admin->email      = $request->email;
        self::$admin->userName   = $request->userName;
        self::$admin->password   = bcrypt($request->password);
        if(self::$superAdmin){
        self::$admin->adminType   = 0; 
        }else{
        self::$admin->adminType   = 1;
        }
        self::$admin->save();

        if(self::$admin->adminType   == 1){
            Session::put('userId', self::$admin->id);
            Session::put('userName', self::$admin->userName);
        }
        return self::$admin->adminType;


    }

public static function loginCheck()
{
     if ($id=Session::get('userId')) { 
             return Session::get('userId');  
     }
}


}//Model
