<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    public static $sell;
    use HasFactory;


    public static function saveSell($request)
{
    self::$sell = new Sell();
    self::$sell->date              = $request->date;
    self::$sell->time_stamp        = strtotime($request->date);
    self::$sell->challan           = $request->challan;
    self::$sell->customer          = $request->customer;
    self::$sell->delivery_agent    = $request->agent;
    self::$sell->created_by        = Session::get('userId');
    self::$sell->save();
    return self::$sell->id;
}

public static function updateSellInfo($id,$request)
{
    self::$sell = Sell::find($id);
    self::$sell->date              = $request->date;
    self::$sell->time_stamp        = strtotime($request->date);
    self::$sell->challan           = $request->challan;
    self::$sell->customer          = $request->customer;
    self::$sell->delivery_agent    = $request->agent;
    self::$sell->created_by        = Session::get('userId');
    self::$sell->save();
}






}//Model
