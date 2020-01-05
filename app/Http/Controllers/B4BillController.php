<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class B4BillController extends Controller
{
    //



    public function store(Request $request){

    $bill = new Bill();

    $bill->name = $request->bill_name;
    $bill->user_id = auth()->id();
    $bill->split_method = $request->split_method;
    $bill->total_price = (int) $request->total_price;

    $bill->save();

    $users_id = [];

    foreach ($request->users as $user){

        array_push($users_id, $user['id']);
    }

    $bill->users()->sync($users_id);

    foreach ($request->products as $product){

        $prod = new Product();

        $prod->bill_id = $bill->id;
        $prod->name = $product['name'];
        $prod->price = (int) $product['price'];
        $prod->user_id = $product['user_id'];

        $prod->save();

    }

    foreach ($request->splits as $split){

        $newSplit = new Split();

        $newSplit->user_id = $split['user_id'];
        $newSplit->bill_id = $bill->id;

        if($request->split_method == 'percentage'){

            $newSplit->amount = ((int) $split['percentage'] / 100) * (int) $request->total_price;
            $newSplit->percentage = (int) $split['percentage'];

        }else{

            $newSplit->amount = (int) $split['amount'];
        }


        $newSplit->save();

    }

    return $bill;


}

}
