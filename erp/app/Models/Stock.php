<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Stock extends Model
{
    public static $stock;
    use HasFactory;


public static function saveStock($request)
{
    self::$stock = new Stock();
    self::$stock->date              = $request->date;
    self::$stock->time_stamp        = strtotime($request->date);
    self::$stock->challan           = $request->challan;
    self::$stock->supplier_id       = $request->supplier;
    self::$stock->created_by        = Session::get('userId');
    self::$stock->save();
    return self::$stock->id;
}

public static function updateStock($request,$id)
{
    self::$stock = Stock::find($id);
    self::$stock->date              = $request->date;
    self::$stock->time_stamp        = strtotime($request->date);
    self::$stock->challan           = $request->challan;
    self::$stock->supplier_id       = $request->supplier;
    self::$stock->updated_by        = Session::get('userId');
    self::$stock->save();
    return self::$stock->id;
}

public function supplier()
{
    return $this->belongsTo('App\Models\Supplier','supplier_id');
}












}//Model
