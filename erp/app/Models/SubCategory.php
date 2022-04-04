<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','status'];
    public static $subCategory;  


public static function subCategoryBasicInfo($request, $subCategory)
{
    $subCategory->categoryId   = $request->categoryId;
    $subCategory->title        = $request->title;
    $subCategory->description  = $request->description;  
    $subCategory->status       = $request->status;
    $subCategory->save();
}

public static function subCategoryInfoSave($request)
{   
     self::$subCategory = new SubCategory(); 
     self::subCategoryBasicInfo($request, self::$subCategory);
}
public static function updateSubCategoryStatus($id)
{
    self::$subCategory = SubCategory::find($id);
     if ( self::$subCategory->status == 1) {
        self::$subCategory->status = 0;
     } else {
        self::$subCategory->status = 1;
     }
     self::$subCategory->save(); 
} 
public static function subCategoryUpdate($request,$id)
{
   self::$subCategory = SubCategory::find($id); 
   self::subCategoryBasicInfo($request,self::$subCategory); 
}


public function category()
{
     return $this->belongsTo('App\Models\Category','categoryId');
}



}//Model
