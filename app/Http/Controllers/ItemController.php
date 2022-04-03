<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Item;
use App\Models\ItemColor;
use App\Models\ItemDetails;
use App\Models\ItemOtherImage;
use App\Models\ItemSize;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert; 

class ItemController extends Controller
{
    public $item;
    public $itemColors;
    public $itemSizes;
    public $itemOtherImages;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
         return view('back-end.item.add',[
             'categories'    => Category::orderBy('id','desc')->get(),
             'subCategories' => SubCategory::orderBy('id','desc')->get(),
             'brands'        => Brand::orderBy('id','desc')->get(),
             'colors'        => Color::orderBy('id','desc')->get(),
             'sizes'        => Size::orderBy('id','desc')->get(),

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
    public function itemInfoValidate($request)
    {
        $this->validate($request,[
            'title'             =>'required',
            'category_id'       =>'required',
            'sub_category_id'   =>'required',
            'brand_id'          =>'required',
            's_description'     =>'required | max:250',
            'color_id'          =>'required',
            'size_id'           =>'required',
            'purchase_price'    =>'required',
            'sell_price'        =>'required',
            're_sell_price'     =>'required',
            'status'            =>'required',
            'featured_image'    =>'required',
            'slider_image'      =>'required',
            'other_image'       =>'required',
            'l_description'     =>'required'
        ],[
            'title.required'    =>'Must be write a Title',
            'category_id.required'  =>'Select a Category Please.',
            'sub_category_id.required' => 'Select a Sub-Category',
            'brand_id.required'        => 'Select a Brand',
            's_description.required'   =>'Write a Short Description',
            'color_id.required'        => 'Select Some Colors',
            'size_id.required'         => 'Select some Sizes',
            'purchase_price.required'  => 'Must be give a Purchase-price',
            'sell_price.required'      => 'Must Be give a Sell-price',
            're_sell_price.required'   => 'Must be Give a Re-sell Price',
            'l_description.required'   => 'Must Be write a logn descriptin',
            
        ]);
    }
    public function itemInfoValidateWithOutImage($request)
    {
        $this->validate($request,[
            'title'             =>'required',
            'category_id'       =>'required',
            'sub_category_id'   =>'required',
            'brand_id'          =>'required',
            's_description'     =>'required | max:250',
            'color_id'          =>'required',
            'size_id'           =>'required',
            'purchase_price'    =>'required',
            'sell_price'        =>'required',
            're_sell_price'     =>'required',
            'status'            =>'required', 
            'l_description'     =>'required'
        ],[
            'title.required'    =>'Must be write a Title',
            'category_id.required'  =>'Select a Category Please.',
            'sub_category_id.required' => 'Select a Sub-Category',
            'brand_id.required'        => 'Select a Brand',
            's_description.required'   =>'Write a Short Description',
            'color_id.required'        => 'Select Some Colors',
            'size_id.required'         => 'Select some Sizes',
            'purchase_price.required'  => 'Must be give a Purchase-price',
            'sell_price.required'      => 'Must Be give a Sell-price',
            're_sell_price.required'   => 'Must be Give a Re-sell Price',
            'l_description.required'   => 'Must Be write a logn descriptin',
            
        ]);
    }
    public function store(Request $request)
    {
         
        $this->itemInfoValidate($request); 
        $this->item_id = Item::saveItemInfo($request);
        foreach ($request->color_id as $color) {
             ItemColor::saveItemColorInfo($this->item_id, $color);
        }
        foreach ($request->size_id as $size) {
             ItemSize::saveItemSizeInfo($this->item_id, $size);
        }
        foreach ($request->color_id as $color) {
            foreach ($request->size_id as $size) {
                ItemDetails::saveItemDetails($this->item_id, $size,$color);
           }
       }
         
             ItemOtherImage::saveItemOtherImage($this->item_id, $request->other_image, $request->title);
       
        Alert::success('Success','Your Item Save Successfully');
        return redirect()->back();
    }
    public function itemManage()
    {
        return view('back-end.item.manage',[
            'items' => Item::orderBy('id','desc')->get(),
        ]);
    }
    public function updateItemStatus($id)
    {
        Item::updateItemStatus($id);
        Alert::success('Success','Item update Succefully');
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
        return view('back-end.item.view',[
            'item'         => Item::find($id),
            'otherImages'  => ItemOtherImage::where('item_id',$id)->get(),
            'itemColors'   => ItemColor::where('item_id',$id)->get(),
            'itemSizes'    => ItemSize::where('item_id',$id)->get()
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
        return view('back-end.item.edit',[
            'myItem'          => Item::find($id),
            'categories'    => Category::orderBy('id','desc')->get(),
            'subCategories' => SubCategory::orderBy('id','desc')->get(),
            'brands'        => Brand::orderBy('id','desc')->get(),
            'colors'        => Color::orderBy('id','desc')->get(),
            'sizes'         => Size::orderBy('id','desc')->get(),
            'itemColors'    => ItemColor::where('item_id',$id)->get(),
            'itemSizes'     => ItemSize::where('item_id',$id)->get(),

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
        // DB::beginTransaction();
        // try {
            $this->itemInfoValidateWithOutImage($request);
            if ($this->itemOtherImages = $request->file('other_image')) {
                ItemOtherImage::updateOtherImage($id,$this->itemOtherImages,$request->title);
             } 
            Item::updateItem($request,$id);
            ItemColor::updateItemColorInfo($id, $request->color_id);
            ItemSize::updateItemSizeInfo($id, $request->size_id); 
            ItemDetails::updateItemDetails($id,$request->size_id,$request->color_id);
            Alert::success('Success','Item update Successfully!');
            return redirect()->back();

        // } catch (ValidationException $e) {
        //    DB::rollBack();
        //    var_dump($e->getErrors());
        // }
        // DB::commit();
  
    }
    public function itemDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="item-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function itemDelete($id)
    {
        $this->item = Item::find($id);
        $this->itemColors = ItemColor::where('item_id',$id)->get();
        $this->itemSizes  = ItemSize::where('item_id',$id)->get();
        ItemDetails::where('item_id',$id)->delete();
        $this->itemOtherImages = ItemOtherImage::where('item_id',$id)->get();
        foreach ($this->itemColors as $value) {
             $value->delete();
        }
        foreach ($this->itemSizes as $value) {
             $value->delete();
        }
        foreach ($this->itemOtherImages as $value) {
            unlink($value->image);
             $value->delete();
        }
        unlink($this->item->featured_image);
        unlink($this->item->slider_image);
         $this->item->delete();
        Alert::error('Delete','Delete Successfull');
        return redirect('/item-manage');
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
}
