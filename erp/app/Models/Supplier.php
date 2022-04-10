<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory; 
    protected $fillable = ['title','description','status'];
    public static $supplier;  


public static function supplierBasicInfo($request, $supplier)
{
    $supplier->title        = $request->title;
    $supplier->description  = $request->description;  
    $supplier->status       = $request->status;
    $supplier->save();
}

public static function supplierInfoSave($request)
{   
     self::$supplier = new Supplier(); 
     self::supplierBasicInfo($request, self::$supplier);
}
public static function updateSupplierStatus($id)
{
    self::$supplier = Supplier::find($id);
     if ( self::$supplier->status == 1) {
        self::$supplier->status = 0;
     } else {
        self::$supplier->status = 1;
     }
     self::$supplier->save(); 
} 
public static function supplierUpdate($request,$id)
{
   self::$supplier = Supplier::find($id); 
   self::supplierBasicInfo($request,self::$supplier); 
}  

public static function supplierDeuViaProductBuy($grandTotal,$supplierId)
{
   self::$supplier       = Supplier::find($supplierId);
   self::$supplier->due  = self::$supplier->due + $grandTotal;
   self::$supplier->save();
}


public static function payment($supplierId,$amount)
{
   self::$supplier       = Supplier::find($supplierId);
   self::$supplier->due  = self::$supplier->due - $amount;
   self::$supplier->save();
}







}//Model
