<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    public function index(){
        return view('backend.wallet.index');
    }

    public function server(){


        return Datatables::of(Wallet::with('userInfo'))
        ->addColumn('account_owner' , function($e){
            $user=  $e->userInfo;
            if($user){
                return '
                <p>Name : ' .$user->name . '</p>
                <p>Email : ' .$user->email . '</p>
                ';
            }
            return '-';
        })
        ->editColumn('amount' , function($e){
            return number_format($e->amount,2);
        })
        ->editColumn('created_at', function ($e) {
            $create = Carbon::parse($e->created_at)->format('Y-m-d H:i:s');
            return $create;
        })
        ->editColumn('updated_at', function ($e) {
            $update = Carbon::parse($e->updated_at)->format('Y-m-d H:i:s');
            return $update;
        })
        ->rawColumns(['account_owner' , 'created_at' , 'updated_at'])
            ->make(true);
    }
}
