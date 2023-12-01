<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Menu::all();
        return response()->json([
            'status' => 200,
            'data' => $items,
        ]);
    }
    public function menu_home()
    {
        return view('admin.menu.menu');
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
            'name' => 'required|string|max:20',
            'desc' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'status' => 'nullable|in:public,private',
            'img' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->fails()
            ]);
        }

        if ($request->discount > $request->price) {
            return response()->json([
                'status' => 400,
                'message' => 'Sorry but discount is bigger than price'
            ]);
        }
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->desc = $request->desc;
        $menu->status = $request->status;
        $menu->price = $request->price;
        $menu->discount = $request->discount;
        if ($request->hasFile('img')) {
            $image = time() . 'menu.' . $request->img->extension();
            $request->img->move(public_path('upload/menu'), $image);
            $menu->img = $image;
        }
        $menu->save();
        return response()->json([
            'status' => 201,
            'message' => 'Item added successfully'
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
        $item = Menu::find($id);
        if (!$item) {
            return response()->json([
                'status' => 404,
                'message' => 'Item not found'
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
            'name' => 'required|string|max:20',
            'desc' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'status' => 'nullable|in:public,private',
            'img' => 'required|image|mimes:jpeg,png',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 404,
                'message' => 'The Validation is wrong'
            ]);
        }

        $item = Menu::find($id);
        if (!$item) {
            return response()->json([
                'status' => 404,
                'message' => 'Item not found'
            ]);
        }

        $item->name = $request->name;
        $item->desc = $request->desc;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->status = $request->status;
        if ($request->hasFile('img')) {
            $des = 'upload/menu/' . $item->img;
            File::delete($des);
            $image = time() . 'menu.' . $request->img->extension();
            $request->img->move(public_path('upload/menu'), $image);
            $item->img = $image;
        }
        $item->update();
        return response()->json([
            'status' => 200,
            'message' => 'Item Updated Successfully'
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
        $item = Menu::find($id);
        if (!$item) {
            return response()->json([
                'status' => 404,
                'message' => 'Item not found'
            ]);
        }
        $des = 'upload/menu/' . $item->img;
        File::delete($des);
        $item->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Item deleted successfully',
            'data' => $item
        ]);
    }
}
