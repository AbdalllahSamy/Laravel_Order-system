<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::with('user', 'item')->get();
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
    
    public function order_home()
    {
        return view('admin.orders.order');
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'item_id' => 'required|exists:menus,id',
            'quantity' => 'required|numeric',
            'total_price' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 404,
                'message' => $validator->fails(),
            ]);
        }

        $order = new Order();
        $order->customer_id = $request->user()->id;
        $order->item_id = $request->item_id;
        $order->quantity = $request->quantity;
        $order->total_price = $request->total_price;
        $order->save();
        return response()->json([
            'status' => 200,
            'message' => 'Order Send Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Order::find($id);
        if(!$item){
            return response()->json([
                'status' => 404,
                'message' => 'Order not found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $validator = Validator::make($request->all(),[
            'status' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 404,
                'message' => $validator->fails(),
            ]);
        }

        $order->status = $request->status;
        $order->update();
        return response()->json([
            'status' => 200,
            'message' => 'Order Updated Successfully'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if(!$order){
            return response()->json([
                'status' => 404,
                'message' => 'Order not found'
            ]);
        }


        $order->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Order deleted successfully'
        ]);
    }
}
