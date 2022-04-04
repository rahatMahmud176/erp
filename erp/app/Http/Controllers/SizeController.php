<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SizeController extends Controller
{
    public $size;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.size.manage',[
            'sizes' => Size::orderBy('id','desc')->get()
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
    public function sizeInfoValidate($request)
    {
        $this->validate($request,[
            'title'         =>'required | max:30',
            'description'   =>'nullable | max:200', 
            'status'        =>'required',
        ],[
            'title.required' => 'Size title required', 
        ]);
    }
    public function store(Request $request)
    { 
        $this->sizeInfoValidate($request);
        Size::sizeInfoSave($request);
        Alert::success('Success','Size Save Succefully');
        return redirect()->back();
        
    }
    public function updateSizeStatus($id)
    {
        Size::updateSizeStatus($id);
        Alert::success('Success','Size update Succefully');
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
        return view('back-end.size.edit',[
            'size' => Size::find($id),
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
        $this->sizeInfoValidate($request);
          Size::sizeUpdate($request,$id);
          Alert::success('Updated', 'Update Successfull');
          return redirect('size');
    }
    public function sizeDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="size-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function sizeDelete($id)
    {
        $this->size = Size::find($id);
        $this->size->delete();
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
}//Controller
