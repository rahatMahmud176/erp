<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveriAgent extends Model
{
    
    use HasFactory; 
    protected $fillable = ['title','description','status'];
    public static $deliveriagent;  


public static function deliveriagentBasicInfo($request, $deliveriagent)
{
    $deliveriagent->title        = $request->title;
    $deliveriagent->description  = $request->description;  
    $deliveriagent->status       = $request->status;
    $deliveriagent->save();
}

public static function deliveriagentInfoSave($request)
{   
     self::$deliveriagent = new DeliveriAgent(); 
     self::deliveriagentBasicInfo($request, self::$deliveriagent);
}
public static function updateDeliveriAgentStatus($id)
{
    self::$deliveriagent = DeliveriAgent::find($id);
     if ( self::$deliveriagent->status == 1) {
        self::$deliveriagent->status = 0;
     } else {
        self::$deliveriagent->status = 1;
     }
     self::$deliveriagent->save(); 
} 
public static function deliveriagentUpdate($request,$id)
{
   self::$deliveriagent = DeliveriAgent::find($id); 
   self::deliveriagentBasicInfo($request,self::$deliveriagent); 
} 


public static function deuFromSell($id,$amount)
{
   self::$deliveriagent = DeliveriAgent::find($id);
   self::$deliveriagent->due = self::$deliveriagent->due + $amount;
   self::$deliveriagent->save();
}
public static function deleteSell($details)
{
   self::$deliveriagent = DeliveriAgent::find($details->agent_id);
   self::$deliveriagent->due = self::$deliveriagent->due - $details->amount;
   self::$deliveriagent->save();
}





}//Model
