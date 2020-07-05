<?php

namespace App\Http\Controllers\Admin;

use App\GeneralSetting;
use App\Helpers\Peach;
use App\Http\Controllers\Controller;
use App\PayoutHistory;
use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $peach;
    public function __construct()
    {
        $this->peach = new Peach();
    }
    public function manualPayment(User $user) {
        return $this->peach->payUser($user);
    }
    public function automaticPayment() {
        $userRepo  = new User();
        $users  = $userRepo->where(['access_type' => 'general'])->orWhere(['access_type' => 'member'])->get();
        $users->each(function (User $user){
            if ($user->point_value > 0) {
                $this->peach->payUser($user);
            }
        });
        $notify[] = ['success', 'Automatic payment initiated for all users with PV greater than 0'];
        return back()->withNotify($notify);
    }

    public function payoutHistories() {
        $payouts = PayoutHistory::all();
        $page_title = 'Payout Histories';
        return view('admin.users.payout-histories', compact('payouts', 'page_title'));
    }
}
