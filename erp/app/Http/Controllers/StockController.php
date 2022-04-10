<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Brand;
use App\Models\Cash;
use App\Models\CashDetails;
use App\Models\Category;
use App\Models\Color;
use App\Models\Item;
use App\Models\ItemColor;
use App\Models\ItemDetails;
use App\Models\ItemSize;
use App\Models\PaymentDetails;
use App\Models\Size;
use App\Models\Stock;
use App\Models\StockDetails;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\SupplierPayDetails;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StockController extends Controller
{
    public $id;
    public $itemDetails;
    public $itemColors;
    public $itemSizes;
    public $colorArray = [];
    public $sizeArray = [];
    public $stockId;
    public $i;
    public $grandTotal;
    public $stockDetails;
    public $resultArray=[];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.stock.add',[
            'categories'    => Category::where('status',1)->orderBy('id','desc')->get(),
            'subCategories' => SubCategory::where('status',1)->orderBy('id','desc')->get(),
            'brands'        => Brand::where('status',1)->orderBy('id','desc')->get(),
            'colors'        => Color::where('status',1)->orderBy('id','desc')->get(),
            'sizes'         => Size::where('status',1)->orderBy('id','desc')->get(),
            'items'         => Item::where('status',1)->orderBy('id','desc')->get(),
            'suppliers'     => Supplier::where('status',1)->orderBy('id','desc')->get(),
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
         
            $this->i= 0; 
        //    return $request;
        $this->stockId = Stock::saveStock($request); 
         $this->resultArray= $this->makeArray($request);
        foreach ($this->resultArray as $result) {
            StockDetails::saveStockDetails($result,$this->stockId);
            ItemDetails::stockSave($result['item_id'],$result['color_id'],$result['size_id'],$result['qty']);
            Item::saveItemStock($result['item_id'],$result['qty']);
            $this->grandTotal = $this->grandTotal + $result['total']; 
        }
         if ($request->productBuyVia==0) {
              Supplier::supplierDeuViaProductBuy($this->grandTotal,$request->supplier); 
         } else {
            $cashId = Cash::cashPayViaBuy($request->date,$this->grandTotal);
            PaymentDetails::cashPayViaBuy($cashId,$request->date,$request->supplier,$this->grandTotal); 
            // SupplierPayDetails::PayViaBuy($request->supplier,$this->stockId,$request->date,$this->grandTotal,$request->account);
             
         }
         
        Alert::success('Buy success', 'Proudct buy Successfully');
        return redirect()->back();

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
        return view('back-end.stock.edit',[
            'stock'         => Stock::find($id),
            'stockDetails'  => StockDetails::where('stock_id',$id)->get(),
            'brands'        => Brand::where('status',1)->orderBy('id','desc')->get(),
            'colors'        => Color::where('status',1)->orderBy('id','desc')->get(),
            'sizes'         => Size::where('status',1)->orderBy('id','desc')->get(),
            'items'         => Item::where('status',1)->orderBy('id','desc')->get(),
            'suppliers'     => Supplier::where('status',1)->orderBy('id','desc')->get(),
        ]);
    }
    public function makeArray($request)
    {
        foreach ($request->stock as $item) { 
            $this->resultArray[$this->i]['item_id']    = $item['item'];
            $this->resultArray[$this->i]['color_id']   = $item['color'];
            $this->resultArray[$this->i]['size_id']    = $item['size'];
            $this->resultArray[$this->i]['price']      = $item['price'];
            $this->resultArray[$this->i]['qty']        = $item['qty'];
            $this->resultArray[$this->i]['total']      = $item['total'];
            $this->i++;
}
    return $this->resultArray;
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
        $this->i = 0;
        $this->stockDetails = StockDetails::where('stock_id',$id)->get();  
          foreach ($this->stockDetails as $stock) {
            ItemDetails::stockUpdate($stock->item_id,$stock->color_id,$stock->size_id,$stock->qty); 
            Item::stockUpdate($stock->item_id,$stock->qty); 
        } 
        StockDetails::where('stock_id',$id)->delete();

        $this->stockId = Stock::updateStock($request,$id);

        $this->resultArray= $this->makeArray($request);
        foreach ($this->resultArray as $result) {
            StockDetails::saveStockDetails($result,$this->stockId);
            ItemDetails::stockSave($result['item_id'],$result['color_id'],$result['size_id'],$result['qty']);
            Item::saveItemStock($result['item_id'],$result['qty']);
        } 
        Alert::success('Updated','Stock Updated Successfully');
        return redirect('in-stock/report'); 
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
    public function allStockInfo()
{
   return response()->json([
       'items'  => Item::where('status',1)->get(['id','title']),
       'colors' => Color::where('status',1)->get(['id','title']),
       'sizes'  => Size::where('status',1)->get(['id','title'])
   ]);
}
    public function stockInfoByItemId()
    { 
        $this->itemId = $_GET['id'];   
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
         ]);
    }
    public function stockDeleteAlert($id)
    {
         // example:
         alert()->question('Are you sure?', 'You won\'t be able to revert this!')
         ->showConfirmButton('<a class="text-decoration-none text-light" href="stock-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
         ->showCancelButton('Cancel', '#aaa')->reverseButtons();
 
         return redirect()->back();
    }

    public function stockDelete($id)
    {
        $this->stockDetails = StockDetails::where('stock_id',$id)->get();  
          foreach ($this->stockDetails as $stock) {
            ItemDetails::stockUpdate($stock->item_id,$stock->color_id,$stock->size_id,$stock->qty); 
            Item::stockUpdate($stock->item_id,$stock->qty); 
        } 
        StockDetails::where('stock_id',$id)->delete();
        Stock::find($id)->delete();
        Alert::error('Delete','Delete Successfull');
        return redirect()->back();
    }





}//Controller
