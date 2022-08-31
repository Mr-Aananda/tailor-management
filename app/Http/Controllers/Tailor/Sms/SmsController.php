<?php

namespace App\Http\Controllers\Tailor\Sms;

use App\Helpers\SMS;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    private $paginate = 25;
    public $sender_id, $api_key;

    public function __construct()
    {
        $this->sender_id = env('SMS_SENDER_ID');
        $this->api_key = env('SMS_API_KEY');
    }

    public function groupSms()
    {
        $customers = Customer::paginate($this->paginate);
        return view('tailor.sms.groupSms',compact('customers'));
    }

    public function groupSmsSend(Request $request)
    {
        // return $request->all();
        $request->validate([
            'message' => 'required|string',
            'mobiles' => 'required|array',
            'mobiles.*' => 'string|size:11|starts_with:01'
        ]);

        $mobiles = join(',', $request->mobiles);
        $message = $request->message . " " . config('sms.regards');
        $success = SMS::groupSmsSend($this->sender_id, $this->api_key, $mobiles, $message); //send sms
        // $data = json_decode($success, true); //for decode data

        if ($success) {
            $message = "SMS has been send successfully.";
            // view
            return redirect()->route('sms.groupSms')->withSuccess($message);
        } else {
            return back()->withErrors('Your SMS has not send');
        }
    }


    public function customSms()
    {
        return view('tailor.sms.customSms');
    }


    public function customSmsSend(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'mobiles' => 'required|string',
            'mobiles.*' => 'string|size:11|starts_with:01'
        ]);

        // return $request->all();

        $message = $request->message . " " . config('sms.regards');
        $success = SMS::customSmsSend($this->sender_id, $this->api_key, $request->mobiles, $message); //send sms
        $mobiles = explode(',', $request->mobiles);
        // $data = json_decode($success, true); //for decode data


        if ($success) {

            $message = "SMS has been send successfully.";
            // view
            return redirect()->route('sms.customSms')->withSuccess($message);
        } else {
            return back()->withErrors('Your SMS has not send');
        }

    }

}
