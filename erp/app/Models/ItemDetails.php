<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetails extends Model
{
    public static $itemDetails;
    public static $stock;
    use HasFactory;



public static function saveItemDetails($itemId, $size,$color)
{
    self::$itemDetails = new ItemDetails();
    self::$itemDetails->item_id = $itemId;
    self::$itemDetails->size_id = $size;
    self::$itemDetails->color_id = $color;
    self::$itemDetails->save();
}

public static function updateItemDetails($itemId, $sizes, $colors)
{
     ItemDetails::where('item_id',$itemId)->delete();
     foreach($sizes as $size){
         foreach ($colors as $color) {
            self::saveItemDetails($itemId, $size,$color);
         } 
     }
}

public static function stockSave($itemId,$colorId,$sizeId,$qty){
    self::$stock = ItemDetails::where('item_id',$itemId)->where('color_id',$colorId)->where('size_id',$sizeId)->first();
    self::$stock->qty = self::$stock->qty+$qty;
    self::$stock->save();
}
public static function stockSell($itemId,$colorId,$sizeId,$qty){
    self::$stock = ItemDetails::where('item_id',$itemId)->where('color_id',$colorId)->where('size_id',$sizeId)->first();
    self::$stock->qty = self::$stock->qty-$qty;
    self::$stock->save();
}

public static function stockUpdate($itemId,$colorId,$sizeId,$qty)
{
    self::$itemDetails      = ItemDetails::where('item_id',$itemId)->where('color_id',$colorId)->where('size_id',$sizeId)->first();
    self::$itemDetails->qty = self::$itemDetails->qty - $qty;
    self::$itemDetails->save(); 
}

public static function sellDelete($itemId,$colorId,$sizeId,$qty)
{
    self::$itemDetails      = ItemDetails::where('item_id',$itemId)->where('color_id',$colorId)->where('size_id',$sizeId)->first();
    self::$itemDetails->qty = self::$itemDetails->qty + $qty;
    self::$itemDetails->save(); 
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


}//Models
