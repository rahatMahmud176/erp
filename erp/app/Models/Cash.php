<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    public static $cash;
    use HasFactory;

    public static function cashInFromSell($amount,$date)
    {
         self::$cash         = new Cash();
         self::$cash->date   = $date;
         self::$cash->cash   = $amount;
         self::$cash->save();
         return self::$cash->id;
    }
     public static function cashInFromDeliveryAgent($amount)
    {
         self::$cash         = new Cash();
         self::$cash->date   = date('Y-m-d');
         self::$cash->cash   = $amount;
         self::$cash->save();
         return self::$cash->id;
    }
    
 
    public static function cashIn($request)
    {
         self::$cash         = new Cash();
         self::$cash->date   = $request->date;
         self::$cash->cash   = $request->amount;
         self::$cash->save();
         return self::$cash->id;
    }

    public static function cashPayment($request)
    {
         self::$cash         = new Cash();
         self::$cash->date   = $request->date;
         self::$cash->due   = $request->amount;
         self::$cash->save();
         return self::$cash->id;
    }

    public static function cashPaymentFromSellReturn($amount)
    {
          self::$cash         = new Cash();
          self::$cash->date   = date('Y-m-d');
          self::$cash->due    = $amount;
          self::$cash->save();
          return self::$cash->id;
    }



}
