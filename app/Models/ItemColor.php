<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemColor extends Model
{
    public static $itemColor;
    use HasFactory;
    public static function saveItemColorInfo($item_id, $color)
    {
         self::$itemColor = new ItemColor();
         self::$itemColor->item_id  =  $item_id;
         self::$itemColor->color_id =  $color;
         self::$itemColor->save();
    }
public static function updateItemColorInfo($item_id,$colors)
{
    ItemColor::where('item_id',$item_id)->delete();
    foreach ($colors as $color) {
         self::saveItemColorInfo($item_id, $color);
    }
}
public function colors()
{
    return $this->belongsTo('App\Models\Color','color_id');
}



}//model
