<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillCollection;
use App\Http\Resources\BillResource;
use App\Http\Resources\SplitResource;
use App\Model\Bill;
use App\Model\Product;
use App\Model\Split;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    use ApiResponser;


    public function __construct(){

        $this->middleware('auth:api')->except('show');

    }

    public function get(){

        $user = User::where('id', auth('api')->id())->first();

        $billsCollection = BillCollection::collection($user->bills);

        return json_encode($billsCollection);
    }

    public function show($code){

        if ($split = Split::where('code', $code)->first()) {

            $bill = $split->bill;

            $splitRes = new SplitResource($split);

            $billRes = new BillResource($split->bill);

             return response()->json([

            'id' => $bill->id,
            'name' => $bill->name,
            'my_email' => $split->email,
            'split_method' =>  $bill->split_method,
            'total_price' =>  $bill->total_price,
            'user' => $bill->user,
            'products' => $bill->products,
            'split' => $bill->splits,
            'splitting' => $bill->splitsWithUser(),
            'created_at' => (string) $bill->created_at->diffForHumans()


            ], 201);

        }

           abort(404);
    }


    public function store(Request $request){

        $users_arr = [];

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

            if($user = User::where('email', $product['email'])->first()){

                $prod->user_id = $user->id;
                $prod->email = $product['email'];
                array_push($users_arr, $user->id);

            }else{

                $prod->email = $product['email'];

            }


            $prod->save();

        }

        $bill->users()->sync($users_arr);

        foreach ($request->splits as $split){

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $newSplit = new Split();

            $newSplit->code = substr(str_shuffle($permitted_chars), 0, 15);

            if($user = User::where('email', $product['email'])->first()){

                $newSplit->user_id = $user->id;
                $newSplit->email = $split['email'];

            }else{

                $newSplit->email = $split['email'];

            }

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
