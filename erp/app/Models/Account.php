<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    
    use HasFactory; 
    protected $fillable = ['title','description','status'];
    public static $account;  


public static function accountBasicInfo($request, $account)
{
    $account->title        = $request->title;
    $account->description  = $request->description;  
    $account->status       = $request->status;
    $account->save();
}

public static function accountInfoSave($request)
{   
     self::$account = new Account(); 
     self::accountBasicInfo($request, self::$account);
}
public static function updateAccountStatus($id)
{
    self::$account = Account::find($id);
     if ( self::$account->status == 1) {
        self::$account->status = 0;
     } else {
        self::$account->status = 1;
     }
     self::$account->save(); 
} 
public static function accountUpdate($request,$id)
{
   self::$account = Account::find($id); 
   self::accountBasicInfo($request,self::$account); 
}
public static function cashIn($request)
{
   self::$account = Account::find($request->account);
   self::$account->pay_amount = self::$account->pay_amount + $request->amount;
   self::$account->save();
}
 
public static function payment($accountId,$amount)
{
   self::$account = Account::find($accountId);
   self::$account->pay_amount = self::$account->pay_amount - $amount;
   self::$account->save();
}

}//Model
