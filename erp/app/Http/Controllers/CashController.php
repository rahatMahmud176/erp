<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\CashDetails;
use App\Models\PaymentDetails;
use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CashController extends Controller
{
    public $cash;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastOneDay = \Carbon\Carbon::today(); 
         return view('back-end.cash.cash-in',[
             'supplier'     => Supplier::where('status',1)->get(),
             'cashs'        => CashDetails::where('supplier_id','!=','NULL')
                            ->where('created_at','>=',$lastOneDay)
                            ->get(),
         ]);
    }
    public function cashPayment( )
    {
         return view('back-end.cash.payment',[
            'supplier'     => Supplier::where('status',1)->get(),
            'payments'     => PaymentDetails::all(),
         ]);
    }

    public function cashPaymentSave(Request $request)
    {
         $this->cashInfoValidate($request);
         $cashId = Cash::cashPayment($request);
         PaymentDetails::savePaymentDetails($cashId,$request);
         Alert::success('Payment Done','Your payment Has been Done.');
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
    public function cashInfoValidate($request)
    {
         $this->validate($request,[
            'date'        => 'required',
            'supplier_id' => 'required',
            'amount'      => 'required',
            'description' => 'nullable',
         ],[
             'supplier_id.required' => 'Please select a supplier',
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
        $this->cashInfoValidate($request);
        $cashId = Cash::cashIn($request);
        CashDetails::saveDetails($cashId,$request);
        Alert::success('Cash in','Cash in successfully');
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
        //
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


    public function cashDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="cash-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function cashDelete($id)
    {
        CashDetails::where('cash_id',$id)->delete();
        $this->cash = Cash::find($id);
        $this->cash->delete();
        Alert::error('Delete','Delete Successfull');
        return redirect()->back();
    }

public function paymentDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="payment-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function paymentDelete($id)
    {
        PaymentDetails::where('cash_id',$id)->delete();
        $this->cash = Cash::find($id);
        $this->cash->delete();
        Alert::error('Delete','Delete Successfull');
        return redirect()->back();
    }





}//Controller 
