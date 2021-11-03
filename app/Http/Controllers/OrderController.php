<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {

    //------------  new order ------------------
        $dishes = Dish::orderBy('id','desc')->get();
        $tables = Table::all();

    //----------- order List -----------------
        $rawStatus = config('res.order_status');
        $status = array_flip($rawStatus);
        $orders = Order::where('status',4)->get();


        return view('order_form',compact('dishes','tables','status','orders'));
    }

    public function submit(Request $request) {
        $data = array_filter($request->except('_token','table'));
        $orderId = rand();

        foreach($data as $key => $value) {
            if($value > 1){

                for ($i=0; $i < $value; $i++) { 
                    
                    $order = new Order();
                    $order->order_id = $orderId;
                    $order->dish_id = $key;
                    $order->table_id = $request->table;
                    $order->status = config('res.order_status.new');

                    $order->save();
                    }               
            }
            else{

                    $order = new Order();
                    $order->order_id = $orderId;
                    $order->dish_id = $key;
                    $order->table_id = $request->table;
                    $order->status = config('res.order_status.new');

                    $order->save();
            }

        }
        return redirect('/')->with('message','Order Submitted');
    }

    public function serve(Order $order)
    {
        $order->status = config('res.order_status.done');
        $order->save();
        return redirect('/')->with('message','Order Served');
    }

    public function search(Request $request) {

        $tables = Table::all();

    //----------- order List -----------------
        $rawStatus = config('res.order_status');
        $status = array_flip($rawStatus);
        $orders = Order::where('status',4)->get();
    
    //---------- search ---------------------
    
        $dishes = DB::table('dishes')
        ->Where('name', $request->search)
        ->get();
         return view('search',compact('dishes','tables','status','orders'));
    }
}
