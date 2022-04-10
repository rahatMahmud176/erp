<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    public $supplier;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.supplier.add',[
            'suppliers' => Supplier::orderBy('id','desc')->get()
        ]);
    }
    public function supplierManage()
    {
        return view('back-end.supplier.manage',[
            'suppliers'  => Supplier::where('status',1)->get(),
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
    public function supplierInfoValidate($request)
    {
        $this->validate($request,[
            'title'         =>'required | max:30',
            'description'   =>'nullable | max:200', 
            'status'        =>'required',
        ],[
            'title.required' => 'Supplier title required', 
        ]);
    }
    public function store(Request $request)
    { 
        $this->supplierInfoValidate($request);
        Supplier::supplierInfoSave($request);
        Alert::success('Success','Supplier Save Succefully');
        return redirect()->back();
        
    }
    public function updateSupplierStatus($id)
    {
        Supplier::updateSupplierStatus($id);
        Alert::success('Success','Supplier update Succefully');
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
        return view('back-end.supplier.edit',[
            'supplier' => Supplier::find($id),
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
        $this->supplierInfoValidate($request);
          Supplier::supplierUpdate($request,$id);
          Alert::success('Updated', 'Update Successfull');
          return redirect('supplier');
    }
    public function supplierDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="supplier-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function supplierDelete($id)
    {
        $this->supplier = Supplier::find($id);
        $this->supplier->delete();
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
