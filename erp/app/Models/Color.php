<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','status'];
    public static $color;  


public static function colorBasicInfo($request, $color)
{
    $color->title        = $request->title; 
    $color->code        = $request->code; 
    $color->description  = $request->description;  
    $color->status       = $request->status;
    $color->save();
}

public static function colorInfoSave($request)
{   
     self::$color = new Color(); 
     self::colorBasicInfo($request, self::$color);
}
public static function updateColorStatus($id)
{
    self::$color = Color::find($id);
     if ( self::$color->status == 1) {
        self::$color->status = 0;
     } else {
        self::$color->status = 1;
     }
     self::$color->save(); 
} 
public static function colorUpdate($request,$id)
{
   self::$color = Color::find($id); 
   self::colorBasicInfo($request,self::$color); 
}  
}//MOdel
