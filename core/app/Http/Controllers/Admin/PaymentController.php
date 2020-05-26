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
    public function payoutHistories() {
        $payouts = PayoutHistory::all();
        $page_title = 'Payout Histories';
        return view('admin.users.payout-histories', compact('payouts', 'page_title'));
    }
}
