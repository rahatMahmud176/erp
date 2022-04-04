<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockDetails extends Model
{
    public static $stockDetails;
    use HasFactory;


    public static function saveStockDetails($result,$stockId)
    {
        self::$stockDetails = new StockDetails();
        self::$stockDetails->stock_id  =  $stockId;
        self::$stockDetails->item_id   =  $result['item_id'];
        self::$stockDetails->color_id  =  $result['color_id'];
        self::$stockDetails->size_id   =  $result['size_id'];
        self::$stockDetails->price     =  $result['price'];
        self::$stockDetails->qty       =  $result['qty'];
        self::$stockDetails->total     =  $result['total'];
        self::$stockDetails->save();
    }


 public function item()
 {
     return $this->belongsTo('App\Models\Item','item_id');
 }
public function color()
 {
     return $this->belongsTo('App\Models\Color','color_id');
 } 
public function size()
 {
     return $this->belongsTo('App\Models\Size','size_id');
 }







}//Model
