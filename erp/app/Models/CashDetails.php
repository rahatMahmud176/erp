<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashDetails extends Model
{
    use HasFactory;
    public static $cash;

    public static function CashInFromSell($request,$sellId,$amount,$cashId)
    {
         self::$cash = new CashDetails();
         self::$cash->date       = $request->date;
         self::$cash->cash_id    = $cashId;
         self::$cash->sell_id    = $sellId;
         self::$cash->amount     = $amount;
         self::$cash->save();
    }
    public static function cashDetailsFromDeleveriAgent($agent_id,$cashId,$amount){
        self::$cash = new CashDetails();
        self::$cash->date                 = date('Y-m-d');
        self::$cash->cash_id              = $cashId;
        self::$cash->delivery_agent_id    = $agent_id;
        self::$cash->amount               = $amount;
        self::$cash->save();
    }
    public static function saveDetails($cashId,$request)
    {
        self::$cash = new CashDetails();
        self::$cash->date                 = $request->date;
        self::$cash->cash_id              = $cashId;
        self::$cash->supplier_id          = $request->supplier_id;
        self::$cash->amount               = $request->amount;
        self::$cash->description          = $request->description;
        self::$cash->save();
    }

    




    public function agent()
    {
        return $this->belongsTo('App\Models\DeliveriAgent','delivery_agent_id');
    } 
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }

}//Model 
