<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','status'];
    public static $size;  


public static function sizeBasicInfo($request, $size)
{
    $size->title        = $request->title;
    $size->description  = $request->description;  
    $size->status       = $request->status;
    $size->save();
}

public static function sizeInfoSave($request)
{   
     self::$size = new Size(); 
     self::sizeBasicInfo($request, self::$size);
}
public static function updateSizeStatus($id)
{
    self::$size = Size::find($id);
     if ( self::$size->status == 1) {
        self::$size->status = 0;
     } else {
        self::$size->status = 1;
     }
     self::$size->save(); 
} 
public static function sizeUpdate($request,$id)
{
   self::$size = Size::find($id); 
   self::sizeBasicInfo($request,self::$size); 
}  
}//Model
