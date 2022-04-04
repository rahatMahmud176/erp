<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSize extends Model
{
    public static $itemSize;
    use HasFactory;
    public static function saveItemSizeInfo($item_id, $size)
    {
         self::$itemSize = new ItemSize();
         self::$itemSize->item_id =  $item_id;
         self::$itemSize->size_id =  $size;
         self::$itemSize->save();
    }
public static function updateItemSizeInfo($item_id, $sizes)
{
     ItemSize::where('item_id',$item_id)->delete();
     foreach($sizes as $size){
        self::saveItemSizeInfo($item_id, $size);
     }
}
public function sizes()
{
    return $this->belongsTo('App\Models\Size','size_id');
}
}
