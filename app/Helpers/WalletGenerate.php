<?php

namespace App\Helpers;
use App\Models\Wallet;
use App\Models\Transcation;

class WalletGenerate{
    public static function accountNumber(){
        $num = mt_rand(1000000000000000, 9999999999999999);
        if(Wallet::where('account_number' , $num)->exists()){
            self::accountNumber();
        }
        return $num;
    }

    public static function refNumber(){
        $num = mt_rand(1000000000000000, 9999999999999999);
        if(Transcation::where('ref_no' , $num)->exists()){
            self::refNumber();
        }
        return $num;
    }

    public static function transcationID(){
        $num = mt_rand(1000000000000000, 9999999999999999);
        if(Transcation::where('transcation_id' , $num)->exists()){
            self::transcationID();
        }
        return $num;
    }
}


?>
