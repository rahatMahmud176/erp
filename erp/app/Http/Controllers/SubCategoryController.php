<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubCategoryController extends Controller
{
    public $subCategory;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.sub-category.manage',[
            'subCategories' => SubCategory::orderBy('id','desc')->get(),
            'categories'    => Category::orderBy('id','desc')->get(),
        ]);
    }
    public function updateSubCategoryStatus($id)
    {
        SubCategory::updateSubCategoryStatus($id);
        Alert::success('Success','Sub-Category update Succefully');
        return redirect()->back();
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
    public function subCategoryInfoValidate($request)
    {
        $this->validate($request,[
            'title'         =>'required | max:30',
            'categoryId'    =>'required',
            'description'   =>'nullable | max:200', 
            'status'        =>'required',
        ],[
            'title.required'        => 'Sub-Category title required', 
            'categoryId.required'   => 'Category select required'
        ]);
    }
    public function store(Request $request)
    {
        $this->subCategoryInfoValidate($request);
        SubCategory::subCategoryInfoSave($request);
        Alert::success('Success','Category Save Succefully');
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
        return view('back-end.sub-category.edit',[
            'subCategory'   => SubCategory::find($id),
            'categories'    => Category::orderBy('id','desc')->get(),
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
        $this->subCategoryInfoValidate($request);
        SubCategory::subCategoryUpdate($request,$id);
        Alert::success('Updated', 'Update Successfull');
        return redirect('sub_category');
    }
    public function subCategoryDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="sub-category-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function subCategoryDelete($id)
    {
        $this->subCategory = SubCategory::find($id);
        $this->subCategory->delete();
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
