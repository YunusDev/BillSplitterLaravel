<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\BillCollection;
use App\Model\Bill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    //

    public function __construct(){

        $this->middleware('auth:api');

    }
    public function index(){

        $bills = Bill::latest()->get();

        $billsCollection = BillCollection::collection($bills);

        return json_encode($billsCollection);

    }

    public function delete(Bill $bill){

        $bill->delete();

        return response()->json('deleted');

    }
}
