<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
}
