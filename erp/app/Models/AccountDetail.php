<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    use HasFactory;

    public static $account;

    public static function cashInInfoSave($request)
    {
        self::$account = new AccountDetail();
        self::$account->account_id   =  $request->account;
        self::$account->date         =  $request->date;
        self::$account->amount       =  $request->amount;
        self::$account->description  =  $request->description;
        self::$account->save();
    }






}//
