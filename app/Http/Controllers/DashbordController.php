<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\DeliveriAgent;
use Illuminate\Http\Request;
use Session;

class DashbordController extends Controller
{
  public $totalCash = 0;
  public $totalPay = 0;
     public function dashbord()
     { 
         if (Session::get('userId')) {


          $cash = Cash::all();
          foreach ($cash as $c) {
              $this->totalCash = $this->totalCash + $c->cash;
              $this->totalPay  = $this->totalPay + $c->due;
          } 
            return view('back-end.dashbord.dashbord',[
              'cash'  =>$this->totalCash - $this->totalPay,
              'agents' => DeliveriAgent::where('due','!=','0')->orderBy('id','desc')->get(),
            ]);
         } else {
           return redirect('/admin-login');
         }
         
         
     }
}//Controller
