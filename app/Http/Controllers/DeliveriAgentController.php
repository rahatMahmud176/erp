<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\CashDetails;
use App\Models\DeliveriAgent;
use App\Models\DeliveriAgentDetails;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DeliveriAgentController extends Controller
{
    public $deliveriagent;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.delivery-agent.add',[
            'agents' => DeliveriAgent::orderBy('id','desc')->get()
        ]);
    }

    public function managePayments()
    {
        return view('back-end.delivery-agent.manage',[
            'agents' => DeliveriAgent::where('due','!=','0')->orderBy('id','desc')->get()
        ]);
    }
    public function agentPaymentDetails($id)
    {
        return view('back-end.delivery-agent.payment-details',[
            'agentsDetails' => DeliveriAgentDetails::where('agent_id',$id)->where('status',0)->orderBy('id','desc')->get()
        ]);
    }
    public function receivedPayment($id)
    {
        $agentDetails = DeliveriAgentDetails::find($id); 

        $agent =  DeliveriAgent::find($agentDetails->agent_id);
        $agent->due = $agent->due - $agentDetails->amount;
        $agent->save();

        $cashId =  Cash::cashInFromDeliveryAgent($agentDetails->amount); 
        CashDetails::cashDetailsFromDeleveriAgent($agent->id,$cashId,$agentDetails->amount);

        $agentDetails->status = 1;
        $agentDetails->save();
        Alert::success('Received','Payment Recieved Successfull');
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
    public function deliveriagentInfoValidate($request)
    {
        $this->validate($request,[
            'title'         =>'required | max:30',
            'description'   =>'nullable | max:200', 
            'status'        =>'required',
        ],[
            'title.required' => 'DeliveriAgent title required', 
        ]);
    }
    public function store(Request $request)
    { 
        $this->deliveriagentInfoValidate($request);
        DeliveriAgent::deliveriagentInfoSave($request);
        Alert::success('Success','DeliveriAgent Save Succefully');
        return redirect()->back();
        
    }
    public function updateDeliveriAgentStatus($id)
    {
        DeliveriAgent::updateDeliveriAgentStatus($id);
        Alert::success('Success','DeliveriAgent update Succefully');
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
        return view('back-end.delivery-agent.edit',[
            'deliveriagent' => DeliveriAgent::find($id),
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
        $this->deliveriagentInfoValidate($request);
          DeliveriAgent::deliveriagentUpdate($request,$id);
          Alert::success('Updated', 'Update Successfull');
          return redirect('deliveriAgent');
    }
    public function deliveriagentDeleteAlert($id)
    {
        // example:
        alert()->question('Are you sure?', 'You won\'t be able to revert this!')
        ->showConfirmButton('<a class="text-decoration-none text-light" href="deliveriagent-delete/'.$id.'">Delete</a>', '#f22e02')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function deliveriagentDelete($id)
    {
        $this->deliveriagent = DeliveriAgent::find($id);
        $this->deliveriagent->delete();
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
