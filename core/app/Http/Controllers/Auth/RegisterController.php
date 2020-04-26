<?php

namespace App\Http\Controllers\Auth;

use App\GeneralSetting;
use App\User;
use App\Http\Controllers\Controller;
use App\WithdrawMethod;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware(['guest']);
        $this->middleware('regStatus')->except('registrationNotAllowed');
    }

    public function showRegistrationForm($ref = null)
    {
        $page_title = "Sign Up";
        return view(activeTemplate() . 'user.auth.register', compact('page_title'));
    }

    public function showRegistrationFormRef($username){


  $ref_user = User::where('username', $username)->first();
        if (isset($ref_user)){
            $page_title = "Sign Up";
            if ($ref_user->plan_id == 0){

                $notify[] = ['error', $ref_user->username.' did not in subscribed in any plan'];
                return redirect()->route('user.register')->withNotify($notify);


            }
            return view(activeTemplate().'.user.auth.register',compact('page_title', 'ref_user'));
        }else{
            return redirect()->route('user.register');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'country' => 'required|string|max:80',
            'email' => 'required|string|email|max:160|unique:users',
            'mobile' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|unique:users|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $gnl = GeneralSetting::first();


        return User::create([
            'ref_id' => $data['ref_id'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'mobile' => $data['mobile'],
            'address' => [
                'address' => '',
                'state' => '',
                'zip' => '',
                'country' => '',
                'city' => '',
            ],
            'status' => 1,
            'ev' =>  $gnl->ev ? 0 : 1,
            'sv' =>  $gnl->sv ? 0 : 1,
            'ts' => 0,
            'tv' => 1,
        ]);
    }

    public function registered()
    {
        return redirect()->route('user.home');
    }
}
