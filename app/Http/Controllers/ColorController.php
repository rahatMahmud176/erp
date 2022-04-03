<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ColorController extends Controller
{
    public $color;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.color.manage',[
            'colors' => Color::orderBy('id','desc')->get()
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
    public function colorInfoValidate($request)
    {
        $this->validate($request,[
            'title'         =>'required | max:30',
            'description'   =>'nullable | max:200', 
            'status'        =>'required',
        ],[
            'title.required' => 'Color title required', 
        ]);
    }
    public function store(Request $request)
    { 
        $this->colorInfoValidate($request);
        Color::colorInfoSave($request);
        Alert::success('Success','Color Save Succefully');
        return redirect()->back();
        
    }
    public function updateColorStatus($id)
    {
        Color::updateColorStatus($id);
        Alert::success('Success','Color update Succefully');
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
        return view('back-end.color.edit',[
            'color' => Color::find($id),
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
        $this->colorInfoValidate($request);
          Color::colorUpdate($request,$id);
          Alert::success('Updated', 'Update Successfull');
          return redirect('color');
    }
    public function colorDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="color-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function colorDelete($id)
    {
        $this->color = Color::find($id);
        $this->color->delete();
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
