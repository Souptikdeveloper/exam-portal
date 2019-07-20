<?php

namespace App\Http\Controllers\Register;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){
        return view('register');
    }
    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required',
        ], [
            'email.required' => 'The Candidate Email is required.',
            'name.required' => 'The Candidate Name is required.',
        ]);

        $gms_iso_user = new User();
        $gms_iso_user->email = $request->get('email');
        $gms_iso_user->name = $request->get('name');
        $gms_iso_user->password = bcrypt('123456');
        $gms_iso_user->save();


        if(Auth::attempt(['email'=>$request->get('email'),'password'=>'123456'])) {

            Session::flash('success', 'New Candidate registered successfully');
            return redirect(route('exam::exam_dashboard'));
        }
    }
}
