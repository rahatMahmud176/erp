<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveriAgentDetails extends Model
{
    public static $agentDetails;
    use HasFactory;

    public static function saveDeliveriAgentDetails($request,$sellId,$amount)
    {
        self::$agentDetails   = new DeliveriAgentDetails();
        self::$agentDetails->agent_id   = $request->agent;
        self::$agentDetails->sell_id    = $sellId;
        self::$agentDetails->challan    = $request->challan;
        self::$agentDetails->amount     = $amount;
        self::$agentDetails->date       = $request->date;
        self::$agentDetails->status     = 0;
        self::$agentDetails->save();
    }




    public function sell()
    {
       return $this->belongsTo('App\Models\Sell','sell_id');
    }
    



}//Model
