<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.account.add-account',[
            'accounts'  => Account::all(),
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
    public function accountInfoValidate($request)
    {
        $this->validate($request,[
            'title'         =>'required | max:30',
            'description'   =>'nullable | max:200', 
            'status'        =>'required',
        ],[
            'title.required' => 'Account title required', 
        ]);
    }
    public function store(Request $request)
    { 
        $this->accountInfoValidate($request);
        Account::accountInfoSave($request);
        Alert::success('Success','Account Save Succefully');
        return redirect()->back();
        
    }
    public function updateAccountStatus($id)
    {
        Account::updateAccountStatus($id);
        Alert::success('Success','Account update Succefully');
        return redirect()->back();
    }
    public function manageAccounts()
    {
        return view('back-end.account.manage-account',[
            'accounts'  => Account::all(),
        ]);
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
         return view('back-end.account.edit',[
             'account' => Account::find($id),
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
        $this->accountInfoValidate($request);
          Account::accountUpdate($request,$id);
          Alert::success('Updated', 'Update Successfull');
          return redirect('account');
    }
    public function accountDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="account-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function accountDelete($id)
    {
        $this->account = Account::find($id);
        $this->account->delete();
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
    public function accountsInfoForProductBuyPage()
    {
       return response()->json([
        'accounts'   => Account::where('status',1)->get(),
       ]);
    }










}
