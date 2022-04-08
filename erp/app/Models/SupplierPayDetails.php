<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayDetails extends Model
{
    use HasFactory;

    public static $pay;

    public static function PayViaBuy($supplierId,$stockId,$date,$grandTotal,$accountId)
    {
         self::$pay = new SupplierPayDetails();
         self::$pay->supplier_id       = $supplierId;
         self::$pay->stock_id          = $stockId;
        //  self::$pay->cash_id           = $cashId;
         self::$pay->account_id        = $accountId;
         self::$pay->date              = $date;
         self::$pay->amount            = $grandTotal;
         self::$pay->status            = 1;
         self::$pay->save();
    }


}//MOdel
