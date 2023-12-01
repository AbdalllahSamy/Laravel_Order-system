<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bag;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrdersController extends Controller
{

    public function order_user_home()
    {
        $items = Menu::where('status', 'public')->get();
        $itemCount = $items->count();
        return view('user.orders.order', compact('items', 'itemCount'));
    }



    public function user_orders(){
        $orders = Order::where('customer_id', Auth::user())->get();
        return response()->json([
            'status' => 200,
            'data' => $orders
        ]);
    }

    public function store(Request $request){
        $itemIds = $request->input('items');
        $bags = Bag::whereIn('id', $itemIds)->with('menu')->get();
        foreach ($bags as $bag) {
            if($bag->menu->discount){
                $price = $bag->menu->discount * $bag->quantity;
            }else{
                $price = $bag->menu->price * $bag->quantity;
            }
            $order = new Order();
            $order->customer_id = $request->user()->id;
            $order->item_id = $bag->order_id;
            $order->quantity = $bag->quantity;
            $order->total_price = $price;
            $order->save();
            $bag->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Your order has been sent successfully'
        ]);
    }
}
