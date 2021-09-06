<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transcation;
use Illuminate\Http\Request;
use App\Helpers\WalletGenerate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransferPhone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TransferAmount;
use App\Http\Requests\UpdatePassword;

class PageController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        return view('frontend.home', compact('user'));

    }
    public function wallet()
    {
        $user = Auth::user();

        return view('frontend.wallet', compact('user'));
    }

    public function transfer(Request $request)
    {
        $user = Auth::user();

        return view('frontend.transfer', compact('user'));
    }

    public function phoneVerify(Request $request)
    {
        $sentUser = Auth::user();

        if ($sentUser->phone != $request->phone) {
            $user = User::where('phone', $request->phone)->first();

            if ($user) {
                return response()->json([
                    'status' => 'success',
                    'data' => $user,
                ]);
            }
        }

        return response()->json([
            'status' => 'fail',
        ]);

    }

    public function drawAmount(TransferPhone $request)
    {
        $user = Auth::user();

        $phone = $request->to_phone;

        if ($user->phone == $request->to_phone) {
            return back()->withErrors(["to_phone" => "Invalid Phone Number"])->withInput();
        }

        $checkPhoneNumber = User::where('phone', $request->to_phone)->first();

        if (!$checkPhoneNumber) {
            return back()->withErrors(["to_phone" => "Invalid Phone Number"])->withInput();
        }

        /*
        $amount = $request -> amount;
        $request -> validate([
        "to_phone" => "required|numeric|min:9",
        ]);

         */

        return view('frontend.draw_amount', compact('user', 'phone', 'checkPhoneNumber'));
    }

    public function transferConfirmPassword(TransferAmount $request)
    {

        $from_user = Auth::user();
        $to_user = User::where('phone', $request->to_phone)->first();

        if ($request->amount < 500) {
            return back()->withErrors(["amount" => "Transfer amount must be greater than 500 MMK"])->withInput();
        }

        if (!$from_user->walletInfo || !$to_user->walletInfo) {
            return back()->withErrors(["fail" => "Invalid User"])->withInput();
        }

        DB::beginTransaction();
        try
        {
            $from_user_wallet = $from_user->walletInfo;
            $from_user_wallet->decrement('amount', $request->amount);
            $from_user_wallet->update();

            $to_user_wallet = $to_user->walletInfo;
            $to_user_wallet->increment('amount', $request->amount);
            $to_user_wallet->update();

            $refNumber = WalletGenerate::refNumber();
            $from_user_transcation = new Transcation();
            $from_user_transcation->ref_no = $refNumber;
            $from_user_transcation->transcation_id = WalletGenerate::transcationID();
            $from_user_transcation->user_id = $from_user->id;
            $from_user_transcation->type = 2;
            $from_user_transcation->amount = $request->amount;
            $from_user_transcation->source_id = $to_user->id;

            $from_user_transcation->save();

            $to_user_transcation = new Transcation();
            $to_user_transcation->ref_no = $refNumber;
            $to_user_transcation->transcation_id = WalletGenerate::transcationID();
            $to_user_transcation->user_id = $to_user->id;
            $to_user_transcation->type = 1;
            $to_user_transcation->amount = $request->amount;
            $to_user_transcation->source_id = $from_user->id;

            $to_user_transcation->save();

            DB::commit();
            return redirect('/')->with('transfer', "{$request->amount} Succefully Transfered !");
        } catch (Exception $error) {
            DB::rollBack();
        }

        //return $request->all();
    }

    public function passwordCheck(Request $request)
    {
        $user = Auth::user();

        if (!$request->password) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Enter your password!',
            ]);
        }

        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'success',
                'message' => 'success money transfer',
            ]);
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'Password incorrect!',
        ]);
    }

    public function transcation()
    {
        $user = Auth::user();
        $transcations = Transcation::with('userTranscation', 'transcationSource')->where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(10);

        return view('frontend.transcation', compact('transcations', 'user'));
    }

    public function transcationDetail($transcation_id)
    {
        $user = Auth::user();
        $transcation = Transcation::with('userTranscation', 'transcationSource')->where('user_id', $user->id)->where('transcation_id', $transcation_id)->first();

        return view('frontend.transcation_detail' , compact('user' , 'transcation'));
    }

    public function account()
    {
        $user = Auth::user();

        return view('frontend.account', ['user' => $user]);
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('frontend.change_password', compact('user'));
    }
    public function changePasswordStore(UpdatePassword $request)
    {

        $old = $request->old_password;
        $new = $request->new_password;
        $confirm = $request->confirm_password;

        $user = Auth::user();

        if (Hash::check($old, $user->password)) {

            $user->password = Hash::make($confirm);
            $user->update();

            return redirect()->route('account')->with('change', 'New Password Updated !');
        }

    }


    public function language(){

        return view('frontend.language');
    }

    public function languageStore(Request $request, $language){



        return redirect()->back();
    }
}
