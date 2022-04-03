<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    public static $pay;
    use HasFactory;


    public static function savePaymentDetails($cashId,$request)
    {
        self::$pay = new PaymentDetails();
        self::$pay->date                 = $request->date;
        self::$pay->cash_id              = $cashId;
        self::$pay->supplier_id          = $request->supplier_id;
        self::$pay->amount               = $request->amount;
        self::$pay->description          = $request->description;
        self::$pay->save();
    }

 public function supplier()
 {
    return $this->belongsTo('App\Models\Supplier','supplier_id');
 }


}//Models
