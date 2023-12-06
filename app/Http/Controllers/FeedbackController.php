<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Feedback::with('user', 'menu')->get();
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
    public function feedback_home()
    {
        return view('admin.orders.feedbacks');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:menus,id',
            'comment' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 404,
                'message' => 'error in validation'
            ]);
        }
        $feedback = new Feedback();
        $feedback->customer_id = $request->user()->id;
        $feedback->order_id = $request->order_id;
        $feedback->comment = $request->comment;
        $feedback->save();
        return response()->json([
            'status' => 200,
            'message' => 'Feedback sended successfully'
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
        $item = Feedback::with('user', 'menu')->find($id);
        if (!$item) {
            return response()->json([
                'status' => 404,
                'message' => 'Feedback not found'
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
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|numeric|exists:orders,id',
            'comment' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 404,
                'message' => $validator->fails()
            ]);
        }

        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json([
                'status' => 404,
                'message' => 'Feedback not found'
            ]);
        }
        $feedback->comment = $request->comment;
        $feedback->update();
        return response()->json([
            'status' => 200,
            'message' => 'Feedback updated successfully'
        ]);
    }


    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json([
                'status' => 404,
                'message' => 'Feedback not found'
            ]);
        }

        $feedback->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Feedback deleted successfully'
        ]);
    }
}
