<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cash;
use App\Models\CashDetails;
use App\Models\Color;
use App\Models\DeliveriAgent;
use App\Models\DeliveriAgentDetails;
use App\Models\Item;
use App\Models\ItemColor;
use App\Models\ItemDetails;
use App\Models\ItemSize;
use App\Models\Sell;
use App\Models\SellDetails;
use App\Models\Size;
use App\Models\Stock;
use App\Models\StockDetails;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SellController extends Controller
{
    public $sellId;
    public $i = 0;
    public $resultArray = [];
    public $amount = 0;
    public $cashId;
    public $itemId;
    public $sizeId;
    public $colorId;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.sell.sell',[
            'brands'        => Brand::where('status',1)->orderBy('id','desc')->get(),
            'colors'        => Color::where('status',1)->orderBy('id','desc')->get(),
            'sizes'         => Size::where('status',1)->orderBy('id','desc')->get(),
            'items'         => Item::where('status',1)->orderBy('id','desc')->get(),
            'deliveriAgents'=> DeliveriAgent::where('status',1)->orderBy('id','desc')->get(),
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->sellId=  Sell::saveSell($request);
        $this->resultArray= $this->makeArray($request);
        foreach ($this->resultArray as $result) { 
            SellDetails::saveSellDetails($result,$this->sellId);
            ItemDetails::stockSell($result['item_id'],$result['color_id'],$result['size_id'],$result['qty']);
            Item::sellItemStock($result['item_id'],$result['qty']);
            $this->amount = $this->amount + $result['total'];
        }

        if ($request->agent==0) {
                $this->cashId = Cash::cashInFromSell($this->amount,$request->date);
                CashDetails::CashInFromSell($request,$this->sellId,$this->amount,$this->cashId);
        } else {
            DeliveriAgent::deuFromSell($request->agent,$this->amount);
            DeliveriAgentDetails::saveDeliveriAgentDetails($request,$this->sellId,$this->amount);
        }
        
        
        Alert::success('Selled', 'Your Product Sell Successfully');
        return redirect()->back();
    }
    public function makeArray($request)
    {

        foreach ($request->stock as $sell) { 
            $this->resultArray[$this->i]['item_id']    = $sell['item'];
            $this->resultArray[$this->i]['color_id']   = $sell['color'];
            $this->resultArray[$this->i]['size_id']    = $sell['size'];
            $this->resultArray[$this->i]['price']      = $sell['price'];
            $this->resultArray[$this->i]['qty']        = $sell['qty'];
            $this->resultArray[$this->i]['total']      = $sell['total'];
            $this->i++;
            }
            return $this->resultArray;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('back-end.sell.edit',[
            'sell'         => Sell::find($id),
            'sellDetails'  => SellDetails::where('sell_id',$id)->get(),
            'brands'        => Brand::where('status',1)->orderBy('id','desc')->get(),
            'colors'        => Color::where('status',1)->orderBy('id','desc')->get(),
            'sizes'         => Size::where('status',1)->orderBy('id','desc')->get(),
            'items'         => Item::where('status',1)->orderBy('id','desc')->get(), 
            'deliveriAgents'=> DeliveriAgent::where('status',1)->orderBy('id','desc')->get(), 
        ]);
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
        $this->sellDetails = SellDetails::where('sell_id',$id)->get();  
        foreach ($this->sellDetails as $sell) {
          ItemDetails::sellDelete($sell->item_id,$sell->color_id,$sell->size_id,$sell->qty); 
          Item::sellDelete($sell->item_id,$sell->qty); 
      } 
      SellDetails::where('sell_id',$id)->delete();
      $sell = Sell::find($id)->first();
        if ($sell->delivery_agent==0) {
              $cashId =  CashDetails::where('sell_id',$id)->get('cash_id');
              $cash = Cash::find($cashId)->first(); 
              $cash->delete();
               CashDetails::where('sell_id',$id)->delete();
        } else {
          $details = DeliveriAgentDetails::where('sell_id',$id)->first(); 
          DeliveriAgent::deleteSell($details); 
          DeliveriAgentDetails::where('sell_id',$id)->delete();
        }

      $this->resultArray= $this->makeArray($request);
      foreach ($this->resultArray as $result) { 
          SellDetails::saveSellDetails($result,$id);
          ItemDetails::stockSell($result['item_id'],$result['color_id'],$result['size_id'],$result['qty']);
          Item::sellItemStock($result['item_id'],$result['qty']);
          $this->amount = $this->amount + $result['total'];
      }
      if ($request->agent==0) {
        $this->cashId = Cash::cashInFromSell($this->amount,$request->date);
        CashDetails::CashInFromSell($request,$id,$this->amount,$this->cashId);
        } else {
            DeliveriAgent::deuFromSell($request->agent,$this->amount);
            DeliveriAgentDetails::saveDeliveriAgentDetails($request,$id,$this->amount);
        }
      Sell::updateSellInfo($id,$request);
      Alert::success('Updated', 'Updated Successfully');
      return redirect()->back();




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
    public function allSellInfo()
    {
        return response()->json([
            'items'  => Item::where('status',1)->get(['id','title']),
            'colors' => Color::where('status',1)->get(['id','title']),
            'sizes'  => Size::where('status',1)->get(['id','title'])
        ]);
    }
public function sellInfoByItemId()
{
    $this->itemId = $_GET['id']; 
    // return response()->json($colorId); 


        $this->itemColors = ItemColor::where('item_id',$this->itemId)->get();
        $this->itemSizes = ItemSize::where('item_id',$this->itemId)->get();
        foreach ($this->itemColors as $key => $itemColor) {
             $this->colorArray[$key]['id'] = $itemColor->color_id;
             $this->colorArray[$key]['title'] = Color::find($itemColor->color_id)->title;
        }
        foreach ($this->itemSizes as $key => $itemSize) {
             $this->sizeArray[$key]['id'] = $itemSize->size_id;
             $this->sizeArray[$key]['title'] = Size::find($itemSize->size_id)->title;
        }

         return response()->json([ 
             'colors'    => $this->colorArray,
             'sizes'     => $this->sizeArray,
             'price'     => Item::find($this->itemId)->purchase_price,
             'qty'       => Item::find($this->itemId)->qty,
         ]);
}

public function sellInfoBySizeColor()
{
     $this->itemId  = $_GET['item'];
     $this->sizeId  = $_GET['size'];
     $this->colorId = $_GET['color'];

     return response()->json([
         'item' => ItemDetails::where('item_id',$this->itemId)
                                ->where('size_id',$this->sizeId)
                                ->where('color_id',$this->colorId)
                                ->first(),
        'price' => Item::find($this->itemId)->purchase_price,
     ]);
}

public function sellDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="sell-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }

    public function sellDelete($id)
    {
        $this->sellDetails = SellDetails::where('sell_id',$id)->get();  
          foreach ($this->sellDetails as $sell) {
            ItemDetails::sellDelete($sell->item_id,$sell->color_id,$sell->size_id,$sell->qty); 
            Item::sellDelete($sell->item_id,$sell->qty); 
        } 
        SellDetails::where('sell_id',$id)->delete(); 
        $sell = Sell::find($id)->first();
        if ($sell->delivery_agent==0) {
              $cashId =  CashDetails::where('sell_id',$id)->get('cash_id');
              $cash = Cash::find($cashId)->first(); 
              $cash->delete();
               CashDetails::where('sell_id',$id)->delete();
        } else {
          $details = DeliveriAgentDetails::where('sell_id',$id)->first(); 
          DeliveriAgent::deleteSell($details); 
          DeliveriAgentDetails::where('sell_id',$id)->delete();
        }
        Sell::find($id)->delete(); 
        Alert::error('Delete','Delete Successfull');
        return redirect()->back();
    }


}//Controller
