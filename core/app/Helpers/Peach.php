<?php


namespace App\Helpers;


use App\Bank;
use App\GeneralSetting;
use App\Interfaces\PeachInterface;
use App\Jobs\ProcessPayout;
use App\Recipient;
use App\Traits\Curl;
use App\User;

class Peach implements PeachInterface
{
    use Curl;
    protected $minimumTransfer;
    protected $reason;
    protected $amount;
    public function __construct($minimumTransfer=500)
    {
        $this->minimumTransfer = $minimumTransfer;
        $this->api = config('paystack.paymentUrl').'/';
    }

    public function createRecipient(User $user, $authorization_code=false): bool {
        $user_bank = Bank::find($user->bank_id);
        $data = array(
            'type' => 'nuban',
            'name' => $user->name,
            'description' => 'Member',
            'bank_code' => $user_bank->code,
            'currency' => 'NGN',
            'metadata' => array(
                'job' => 'Payable Peach member'
            )
        );
        if($authorization_code) {
            $data['authorization_code'] = $authorization_code;
        } else {
            $data['account_number'] = $user->bank_ac_no ?? $user->account_number;
        }
        $recipientData = $this->curl(PaystackEndpoints::CreateTransferRecipient, $data);
        if(!$recipientData->status) {
            $user->delete();
            return false;
        }
        $recipient = new Recipient([
            'code' => $recipientData->data->recipient_code,
            'origin' => strlen($authorization_code) ? $authorization_code :"$user->account_number $user_bank->name"
        ]);
        $user->recipients()->save($recipient);
        return true;
    }
    public function saveBanks() {
        $response = $this->curl(PaystackEndpoints::Bank);
        foreach ($response->data as $key => $value) {
            $info = $response->data[$key];
            Bank::create([
                'name' => $info->name,
                'slug' => $info->slug,
                'code' => $info->code,
                'longcode' => $info->longcode
            ]);
        }
    }
    public function sendMoneyToUser(User $user, $amount, $reason = ''): bool{
        $recipient = $user->recipients()->where(['status' => 1])->first();

        if(!$recipient) {
            return false;
        }
        $data = array(
            'source' => 'balance',
            'reason' => $reason,
            'amount' => $amount,
            'recipient' => $recipient->code
        );
        ProcessPayout::dispatchNow($this, $user, $data);
    }
    public function payUser(User $user) {
        $general_settings = GeneralSetting::first();
        $payment_interval = $general_settings->payment_interval;
        $frequency_of_payment_in_days = ceil($payment_interval/(60*60*24));
        $lastPayout = $user->lastSuccessfulPayout(0);
        $last_date = $lastPayout->created_at ?? $user->created_at;
        $how_many_days_ago = now()->diffInDays($last_date);
        if ($how_many_days_ago >= $frequency_of_payment_in_days) {
            $amount = $general_settings->one_pv_to_naira * $user->point_value;
            $reason = 'PV compensation';
            $this->sendMoneyToUser($user, $amount, $reason);
            $notify[] = ['success', 'User successfully paid '. $amount. ' Naira'];
            return back()->withNotify($notify);
        } else{
            $diff = ceil($frequency_of_payment_in_days-$how_many_days_ago);
            $error = ['error'=>'User last pay is '.$how_many_days_ago. ' day'. ($how_many_days_ago>1?'s':'').' ago. Need to wait for '.$diff.' day'. ($diff > 1? 's': '').' more'];
            return back()->withErrors($error);
        }
    }
}
