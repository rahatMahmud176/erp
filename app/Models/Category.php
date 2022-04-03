<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','status'];
    public static $category;  


public static function categoryBasicInfo($request, $category)
{
    $category->title        = $request->title; 
    $category->description  = $request->description;  
    $category->status       = $request->status;
    $category->save();
}

public static function categoryInfoSave($request)
{   
     self::$category = new Category(); 
     self::categoryBasicInfo($request, self::$category);
}
public static function updateCategoryStatus($id)
{
    self::$category = Category::find($id);
     if ( self::$category->status == 1) {
        self::$category->status = 0;
     } else {
        self::$category->status = 1;
     }
     self::$category->save(); 
} 
public static function categoryUpdate($request,$id)
{
   self::$category = Category::find($id); 
   self::categoryBasicInfo($request,self::$category); 
}  
}//Model
