<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public $brand;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.brand.manage',[
            'brands' => Brand::orderBy('id','desc')->get()
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
    public function brandInfoValidate($request)
    {
        $this->validate($request,[
            'title'         =>'required | max:30',
            'description'   =>'nullable | max:200', 
            'status'        =>'required',
        ],[
            'title.required' => 'Brand title required', 
        ]);
    }
    public function store(Request $request)
    { 
        $this->brandInfoValidate($request);
        Brand::brandInfoSave($request);
        Alert::success('Success','Brand Save Succefully');
        return redirect()->back();
        
    }
    public function updateBrandStatus($id)
    {
        Brand::updateBrandStatus($id);
        Alert::success('Success','Brand update Succefully');
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
        return view('back-end.brand.edit',[
            'brand' => Brand::find($id),
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
        $this->brandInfoValidate($request);
          Brand::brandUpdate($request,$id);
          Alert::success('Updated', 'Update Successfull');
          return redirect('brand');
    }
    public function brandDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="brand-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function brandDelete($id)
    {
        $this->brand = Brand::find($id);
        $this->brand->delete();
        Alert::error('Delete','Delete Successfull');
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
}
