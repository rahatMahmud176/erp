<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','status'];
    public static $brand;  


public static function brandBasicInfo($request, $brand)
{
    $brand->title        = $request->title; 
    $brand->description  = $request->description;  
    $brand->status       = $request->status;
    $brand->save();
}

public static function brandInfoSave($request)
{   
     self::$brand = new Brand(); 
     self::brandBasicInfo($request, self::$brand);
}
public static function updateBrandStatus($id)
{
    self::$brand = Brand::find($id);
     if ( self::$brand->status == 1) {
        self::$brand->status = 0;
     } else {
        self::$brand->status = 1;
     }
     self::$brand->save(); 
} 
public static function brandUpdate($request,$id)
{
   self::$brand = Brand::find($id); 
   self::brandBasicInfo($request,self::$brand); 
}  
}//Model
