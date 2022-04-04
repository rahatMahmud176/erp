<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class AuthController extends Controller
{

public function registerPage()
{
    return view('back-end.admin.register');
}

public function adminRegisterInfoValidate($request)
{
     $this->validate($request,[
         'email'      => 'required',
         'userName'   => 'required',
         'password'   => 'same:re-password',
     ]);
}
public function adminRegisterInfo(Request $request)
{
  $this->adminRegisterInfoValidate($request);
  $this->adminId =Admin::registerInfoSave($request);
  if($this->adminId==0){ 
    Alert::info('Waiting', 'please wait for approve!'); 
    return redirect()->back();
  }elseif($this->adminId==1){ 
    return redirect('/');
  }
}
public function loginPage()
{
    return view('back-end.admin.login');
}
public function loginInfoValidate($request)
{
   $this->validate($request,[
     'email'     => 'required',
     'password'  => 'required',
   ]);
}
public function loginInfoSubmit(Request $request)
{
    $this->loginInfoValidate($request); 
    $this->admin =  Admin::where('email',$request->email)->first();
    if($this->admin){ 
        if (password_verify($request->password, $this->admin->password)) { 
          if ($this->admin->adminType==0) {
            Alert::warning('Waiting', 'Please Wait, An admin need to approve you.');
            return redirect()->back(); 
           }elseif($this->admin->adminType==10){
            Alert::warning('Blocked', 'An admin Blocked you for violence any rules.');
            return redirect()->back(); 
           }
           else{
             Session::put('userId',$this->admin->id);
             Session::put('userName',$this->admin->userName);
            return redirect('/');
           }
          
        } else {
          Alert::error('Invalid', 'Your Password is invalid');
          return redirect()->back();
        }
      
     
    }else{
      Alert::error('Invalid', 'Your Email is invalid');
      return redirect()->back();
    }
} 


public function logout()
{
   Session::forget('userId');
   Session::forget('userName');
   Alert::error('Log out', 'You are loged out.');
      return redirect('/admin-login');
}

}//Controller
