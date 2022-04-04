<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOtherImage extends Model
{
    public static $itemOtherImage;
    public static $images;
    public static $oldImages;
    public static $newImage;
    use HasFactory;


    public static function imageUrl($i,$img,$title)
    {
         $extension  = $img->getClientOriginalExtension();
         $imageName  = str_replace(' ','-',$title).'-'.time().'-'.$i++.'.'.$extension;
         $imageUrl   = imageUpload($img,'item-other-image/',$imageName);
         return $imageUrl;
    }
    public static function basicInfo($item_id, $img,$title,$i)
    {
        self::$itemOtherImage->item_id = $item_id;
        self::$itemOtherImage->image   = self::imageUrl($i,$img,$title);
        self::$itemOtherImage->save();
    }
    public static function saveItemOtherImage($item_id, $image,$title)
    {
        $i = 0;
        foreach ($image as $img) {  
         self::$itemOtherImage          = new ItemOtherImage();
         self::basicInfo($item_id, $img,$title,$i++);
        } 
    }

    public static function updateOtherImage($item_id,$image,$title)
    {  
        self::$oldImages = ItemOtherImage::where('item_id',$item_id)->get();
        foreach (self::$oldImages as $img) {
             unlink($img->image);
        }
        self::$oldImages = ItemOtherImage::where('item_id',$item_id)->delete();
        self::saveItemOtherImage($item_id, $image,$title);
        
    }
}
