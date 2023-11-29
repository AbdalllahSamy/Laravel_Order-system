<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bag;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserBagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myItems = Bag::where('customer_id', Auth::user())->with('order')->get();
        return response()->json([
            'status' => 200,
            'data' => $myItems,
        ]);
    }

    public function allMyBagCount(){
        $myItemCount = Bag::where('customer_id', Auth::user())->with('order')->count();
        return response()->json([
            'status' => 200,
            'data' => $myItemCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_id' => 'required|exists:menus,id',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 404,
                'message' => 'There is no order in your bag'
            ]);
        }

        $bag = new Bag();
        $bag->customer_id = $request->user()->id;
        $bag->order_id = $request->menu_id;
        $bag->save();
        return response()->json([
            'status' => 200,
            'message' => 'Items added successfully in your bag'
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Bag::find($id);
        if(!$item){
            return response()->json([
                'status' => 404,
                'message' => 'itme not found',
            ]);
        }
        $item->delete();
        return response()->json([
            'status' => 200,
            'message' => 'itme deleted successfully',
        ]);
    }
}
