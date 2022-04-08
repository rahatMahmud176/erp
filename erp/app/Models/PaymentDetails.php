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

    public static function savePaymentDetailsFromSellReturn($cashId,$amount,$agentId)
    {
        self::$pay = new PaymentDetails();
        self::$pay->date                 = date('Y-m-d');
        self::$pay->cash_id              = $cashId;
        self::$pay->delivery_agent_id    = $agentId;
        self::$pay->amount               = $amount;
        self::$pay->description          = "This payment was taken from the delivery agent";
        self::$pay->save();
    }
    public static function cashPayViaBuy($cashId,$date,$supplier_id,$grandTotal)
    {
        self::$pay = new PaymentDetails();
        self::$pay->date                 = $date;
        self::$pay->cash_id              = $cashId;
        self::$pay->supplier_id          = $supplier_id;
        self::$pay->amount               = $grandTotal;
        self::$pay->description          = 'You Pay when product buy';
        self::$pay->save();
    }

  public function supplier()
  {
      return $this->belongsTo('App\Models\Supplier','supplier_id');
  }
   
 public function agent()
 {
    return $this->belongsTo('App\Models\DeliveriAgent','delivery_agent_id');
 }

}//Models
