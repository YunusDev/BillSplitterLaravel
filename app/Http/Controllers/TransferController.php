<?php

namespace App\Http\Controllers;

use App\Model\Split;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    //


    public function PayDebt(Request $request){

        $ch = curl_init();

        $amount = 5000;
        // $amount = $request->amount;

        curl_setopt($ch, CURLOPT_URL, 'https://api.paystack.co/transfer');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"source\": \"balance\", \"reason\": \"Bill Payment\", 
        \"amount\":$amount, \"recipient\": \"RCP_w3ae9pwcajqb7w2\"}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = 'Authorization: Bearer sk_test_353f94078589837865c24b85eddcc8e6b0dacb49';
        $headers[] = 'Content-Type: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $split = Split::find($request->split_id);

        $split->settled = 1;

        $split->save();

        return $result;


    }



}
