<?php

namespace App\Http\Controllers;

use App\Models\CashDetails;
use App\Models\Item;
use App\Models\ItemDetails;
use App\Models\Sell;
use App\Models\SellDetails;
use App\Models\Stock;
use App\Models\StockDetails;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
         return view('back-end.report.item-report',[
             'items'    => Item::where('qty','!=',0)->where('status',1)->orderBy('qty','desc')->get(['id','title','qty']),  
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function cashReport()
    {
         return view('back-end.report.cash',[
             'cashs' => CashDetails::all()
         ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        return view('back-end.report.report-by-item',[
            'items' => ItemDetails::where('item_id' , $id)->where('qty', '!=',  0)->orderBy('qty','desc')->get() 
        ]);
    }
    
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'ok';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

public function inStock()
{
    
   return view('back-end.report.in-stock',[
       'stocks'     => Stock::orderBy('id','desc')->get(),
   ]);
}

public function inToday()
{
    $leastOneDay = \Carbon\Carbon::today();  
    return view('back-end.report.in-today',[
        'stocks'    => StockDetails::where('created_at', '>=', $leastOneDay)->get(),
    ]);
    //     ->where('payment_status', 1)
    //     ->get();



    //     $leastOneDay = \Carbon\Carbon::today()->subDay(7);
    //     $today = CharacterCertificate::where('created_at', '>=', $leastOneDay)
    //         ->where('payment_status', 1)
    //         ->get();
}

public function stockDetailsReport($id)
{
    
   return view('back-end.report.stock-details-report',[
       'stocks'     => StockDetails::where('stock_id',$id)->get(),
       'stock'      => Stock::find($id),
   ]);
}
public function sellReport()
{
   return view('back-end.report.sell-stock',[
       'sells' => Sell::orderBy('id','desc')->get(),
   ]);
}
public function sellDetails($id)
{
     return view('back-end.report.sell-details',[
         'sell'        => Sell::find($id),
         'sells'       => SellDetails::where('sell_id',$id)->get()
     ]);
}





}//Controller
