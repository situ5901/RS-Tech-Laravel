<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class Adminlogin extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt(['email' => $request->email,
             'password' => $request->password], 
             $request->get('remember'))) {
 
                $admin = Auth::guard('admin')->user();
                if($admin->role==2){
                    return redirect()->route('admin.dashboard');
                } elseif($admin->role == 1){
                       return redirect('/costmor');
                }else{
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error','You are not authorize to access admin panal');
                }
               
            } else {
                return redirect()->route('admin.login');
            }
        } else {
            return redirect()->route('admin.login')->withErrors($validator)->withInput($request->only('email'));
        }
    }
    }

