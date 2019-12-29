<?php

use App\Model\Bill;
use App\Model\Product;
use App\Model\Split;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BillSplitSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);

        $bill = new Bill;

        $bill->name = 'Get Together';
        $bill->user_id = $user1->id;
        $bill->split_method = 'amount';
        $bill->total_price = 18000;

        $bill->save();

        $bill->users()->sync([$user1->id, $user2->id, $user3->id]);

        $products = [

            ["name" => "Rice and Chicken", "price" => 3000, "user_id" => $user1->id, "bill_id" => $bill->id],
            ["name" => "Wine", "price" => 4000, "user_id" => $user1->id, "bill_id" => $bill->id],
            ["name" => "Meat Pie", "price" => 1000, "user_id" => $user1->id, "bill_id" => $bill->id],
            ["name" => "Chicken and Chips", "price" => 2000, "user_id" => $user2->id, "bill_id" => $bill->id],
            ["name" => "Soft Drink", "price" => 1000, "user_id" => $user2->id, "bill_id" => $bill->id],
            ["name" => "Yam and Egg", "price" => 3000, "user_id" => $user3->id, "bill_id" => $bill->id],
            ["name" => "Noodles", "price" => 2000, "user_id" => $user3->id, "bill_id" => $bill->id],
            ["name" => "Drink", "price" => 200, "user_id" => $user3->id, "bill_id" => $bill->id],

        ];

        foreach ($products as $product){

            $prod = new Product();

            $prod->bill_id = $product['bill_id'];
            $prod->user_id = $product['user_id'];
            $prod->name = $product['name'];
            $prod->price = $product['price'];
            $prod->user_id = $product['user_id'];

            $prod->save();

        }

        $splits = [

            ["user_id" => $user1->id, "amount" => 7000, "bill_id" => $bill->id],
            ["user_id" => $user2->id,  "amount" => 6000, "bill_id" => $bill->id],
            ["user_id" => $user3->id,  "amount" => 5000, "bill_id" => $bill->id],

        ];

        foreach ($splits as $split){

            $newSplit = new Split();

            $newSplit->user_id = $split['user_id'];
            $newSplit->bill_id = $bill->id;

            if($bill->split_method == 'percentage'){

                $newSplit->amount = ( $split['percentage'] / 100) *  $bill->total_price;
                $newSplit->percentage = $split['percentage'];

            }else{

                $newSplit->amount = $split['amount'];

            }

            $newSplit->save();

        }




        $bill = new Bill;

        $bill->name = 'Birthday Hangout';
        $bill->user_id = $user2->id;
        $bill->split_method = 'percentage';
        $bill->total_price = 25000;

        $bill->save();

        $bill->users()->sync([$user2->id, $user3->id]);

        $products = [

            ["name" => "Shawarma", "price" => 2000, "user_id" => $user2->id, "bill_id" => $bill->id],
            ["name" => "Wine", "price" => 14000, "user_id" => $user2->id, "bill_id" => $bill->id],
            ["name" => "Chicken Pie", "price" => 1000, "user_id" => $user2->id, "bill_id" => $bill->id],
            ["name" => "Bread", "price" => 1000, "user_id" => $user2->id, "bill_id" => $bill->id],
            ["name" => "Spagetti", "price" => 3000, "user_id" => $user3->id, "bill_id" => $bill->id],
            ["name" => "Soft Drinks", "price" => 2000, "user_id" => $user3->id, "bill_id" => $bill->id],
            ["name" => "Noodles", "price" => 1000, "user_id" => $user3->id, "bill_id" => $bill->id],

        ];

        foreach ($products as $product){

            $prod = new Product();

            $prod->bill_id = $product['bill_id'];
            $prod->user_id = $product['user_id'];
            $prod->name = $product['name'];
            $prod->price = $product['price'];
            $prod->user_id = $product['user_id'];

            $prod->save();

        }

        $splits = [

            ["user_id" => $user2->id,  "percentage" => 40, "bill_id" => $bill->id],
            ["user_id" => $user3->id,  "percentage" => 60, "bill_id" => $bill->id],

        ];

        foreach ($splits as $split){

            $newSplit = new Split();

            $newSplit->user_id = $split['user_id'];
            $newSplit->bill_id = $bill->id;

            if($bill->split_method == 'percentage'){

                $newSplit->amount = ( $split['percentage'] / 100) *  $bill->total_price;
                $newSplit->percentage = $split['percentage'];

            }else{

                $newSplit->amount = $split['amount'];

            }

            $newSplit->save();

        }



    }
}
