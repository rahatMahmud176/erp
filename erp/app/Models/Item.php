<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public static $item;
    public static $featuredImage;
    public static $featuredImageExtension;
    public static $featuredImageName;
    public static $featuredImageUrl; 
    public static $sliderImage;
    public static $sliderImageExtension;
    public static $sliderImageName;
    public static $sliderImageUrl;

    use HasFactory;

public static function featuredImage($request)
{
    self::$featuredImage              = $request->file('featured_image');
    self::$featuredImageExtension     = self::$featuredImage->getClientOriginalExtension();
    self::$featuredImageName          = str_replace(' ','-',$request->title).'-'.'f-image'.'-'.time().'.'.self::$featuredImageExtension;
    self::$featuredImageUrl           = imageUpload(self::$featuredImage, 'item-image/',self::$featuredImageName);
    return self::$featuredImageUrl;
}

public static function sliderImage($request)
{
    self::$sliderImage              = $request->file('slider_image');
    self::$sliderImageExtension     = self::$sliderImage->getClientOriginalExtension();
    self::$sliderImageName          = str_replace(' ','-',$request->title).'-'.'s-image'.'-'.time().'.'.self::$sliderImageExtension;
    self::$sliderImageUrl           = imageUpload(self::$sliderImage, 'item-slider-image/',self::$sliderImageName);
    return self::$sliderImageUrl;
}
public static function itemBasicInfo($request)
{
   self::$item->title                      = $request->title;
     self::$item->category_id                = $request->category_id;
     self::$item->sub_category_id            = $request->sub_category_id;
     self::$item->brand_id                   = $request->brand_id;
     self::$item->s_description              = $request->s_description;
     self::$item->purchase_price             = $request->purchase_price;
     self::$item->sell_price                 = $request->sell_price;
     self::$item->re_sell_price              = $request->re_sell_price;
     self::$item->status                     = $request->status;
     if ($request->featured_image) {
      self::$item->featured_image             = self::featuredImage($request);
     }
     if ($request->slider_image) {
      self::$item->slider_image               = self::sliderImage($request);
     } 
     self::$item->l_description              = $request->l_description;
     self::$item->save();
}
public static function saveItemInfo($request)
{  
     self::$item = new Item();
     self::itemBasicInfo($request);
     return self::$item->id;
}

public static function updateItem($request,$id)
{

   self::$item = Item::find($id);
   if ($request->featured_image) {
      unlink(self::$item->featured_image);
   }
  if ($request->slider_image) {
     unlink(self::$item->slider_image);
  } 
   self::itemBasicInfo($request);
}
 
public static function updateItemStatus($id)
{
    self::$item = Item::find($id);
     if ( self::$item->status == 1) {
        self::$item->status = 0;
     } else {
        self::$item->status = 1;
     }
     self::$item->save(); 
} 
 

public static function saveItemStock($itemId, $qty)
{
    self::$item = Item::find($itemId);
    self::$item->qty = self::$item->qty+$qty ;
    self::$item->save();
}

public static function stockUpdate($id,$qty)
{
   self::$item = Item::find($id);
   self::$item->qty = self::$item->qty - $qty;
   self::$item->save();
}

public static function sellDelete($id,$qty)
{
   self::$item = Item::find($id);
   self::$item->qty = self::$item->qty + $qty;
   self::$item->save();
}

public static function sellItemStock($id,$qty)
{
   self::$item = Item::find($id);
   self::$item->qty = self::$item->qty - $qty;
   self::$item->save();
}



public function category()
{
   return $this->belongsTo('App\Models\Category','category_id');
}
public function subCategory()
{
   return $this->belongsTo('App\Models\SubCategory','sub_category_id');
}
public function brand()
{
   return $this->belongsTo('App\Models\Brand','brand_id');
}



}//Model
