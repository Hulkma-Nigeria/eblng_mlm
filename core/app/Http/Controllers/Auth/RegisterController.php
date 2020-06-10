<?php

namespace App\Http\Controllers\Auth;

use App\Bank;
use App\GeneralSetting;
use App\Helpers\Peach;
use App\StockistApplication;
use App\User;
use App\Http\Controllers\Controller;
use App\Plan;
use App\WithdrawMethod;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    protected $peach;
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
        $this->peach = new Peach();
        $this->middleware(['guest']);
        $this->middleware('regStatus')->except('registrationNotAllowed');
    }

    public function showRegistrationForm($ref = null)
    {
        $page_title = "Sign Up";
        $plans = Plan::where('status', 1)->get();
        $banks = Bank::all();
        return view(activeTemplate() . 'user.auth.register', compact('page_title', 'plans', 'banks'));
    }

    public function showRegistrationFormRef($username)
    {

        $banks = Bank::all();
        $ref_user = User::where('username', $username)->where('access_type', 'member')->first();
        $plans = Plan::where('status', 1)->get();

        if (isset($ref_user)) {
            $page_title = "Sign Up";
            if ($ref_user->plan_id == 0) {

                $notify[] = ['error', $ref_user->username . 'does not have an active plan.'];
                return redirect()->route('user.register')->withNotify($notify);
            }
            return view(activeTemplate() . '.user.auth.register', compact('page_title', 'ref_user', 'plans', 'banks'));
        } else {
            return redirect()->route('user.register');
        }
    }

    public function getReferer(Request $request)
    {
        $username = $request->username;
        $user = User::where('username', $username)->where('access_type', 'member')->first();
        if (!$user) {
            return response([
                'success' => false,
                'message' => "No user found with user name <strong>{$username}</strong>"
            ]);
        } else if ($user->plan_id == 0) {
            return response([
                'success' => false,
                'message' => "User <strong>{$username}</strong> does not have an active plan"
            ]);
        }
        return response([
            'success' => true,
            'message' => "<strong>{$user->fullname}</strong> is your referer",
            'user_id' => $user->id

        ]);
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
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        $recipient = $this->peach->createRecipient($user);
        if (!$recipient) {
            return redirect()->back()->withInput()
                ->withErrors(['incorrect_account' => 'Account information incorrect']);
        }
        event(new Registered($user));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
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

        // dd($data);

        return User::create([
            'ref_id' => $data['ref_id'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'username' => $data['username'],
            'mobile' => $data['mobile'],
            'bank_id' => $data['bank_id'],
            'bank_ac_no' => $data['account_number'],
            'address' => [
                'address' => $data['address'] ?? '',
                'state' => $data['state'] ?? '',
                'zip' => $data['zip'] ?? '',
                'country' => $data['country'] ?? '',
                'city' => $data['city'] ?? '',
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
    public function showStockistForm()
    {
        $page_title = "General Application";
        $banks = Bank::all();
        return view(activeTemplate() . 'user.auth.stockist-form', compact('page_title', 'banks'));
    }
    public function showStockistSuccessful()
    {
        $page_title = "General Application Successful";
        return view(activeTemplate() . 'user.auth.stockist-application-successful', compact('page_title'));
    }
    public function handleStockistApplication(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|string',
            'passport' => 'required|mimes:jpeg,jpg,png',
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'gender'   => 'required|string',
            'country' => 'required|string|max:80',
            'email' => 'required|string|email|max:160|unique:users',
            'mobile' => 'required|string|max:30|unique:users',
            'state' => 'required|string|max:60',
            'city' => 'required|string|max:60',
            'address' => 'required|string|max:300',
            'bank_id' => 'required|gte:1',
            'account_number' => 'required|string|min:9|max:20',
            'store_country' => 'required|string',
            'store_state' => 'required|string',
            'store_city' => 'required|string',
            'store_address' => 'required|string',
            'store_zip' => 'required|string',

        ]);

        if ($request->hasFile('passport')) {
            $validatedData['passport'] = now() . '.' . $request->file('passport')->extension();
            $request->file('passport')->move(public_path(config('constants.stockist_passport')), $validatedData['passport']);
        }
        $stockist = StockistApplication::create($validatedData);
        $recipient = $this->peach->createRecipient($stockist);
        if (!$recipient) {
            return redirect()->back()->withInput()
                ->withErrors(['incorrect_account' => 'Account information incorrect']);
        }
        return redirect()->route('user.stockist-application-successful');
    }
}
