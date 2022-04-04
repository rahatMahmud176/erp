<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellDetails extends Model
{
    public static $sellDetails;
    use HasFactory;
    public static function saveSellDetails($result,$sellId)
    {
        self::$sellDetails = new SellDetails();
        self::$sellDetails->sell_id   =  $sellId;
        self::$sellDetails->item_id   =  $result['item_id'];
        self::$sellDetails->color_id  =  $result['color_id'];
        self::$sellDetails->size_id   =  $result['size_id'];
        self::$sellDetails->price     =  $result['price'];
        self::$sellDetails->qty       =  $result['qty'];
        self::$sellDetails->total     =  $result['total'];
        self::$sellDetails->save();
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
