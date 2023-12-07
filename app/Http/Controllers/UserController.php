<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('type', 2)->get();
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
    public function user_home()
    {
        return view('admin.users.user');
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
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|string|max:50',
            'img' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 404,
                'message' => $validator->fails()
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $passHash = Hash::make($request->password);
        $user->password = $passHash;
        if ($request->file('img')) {
            $image = time() . 'user.' . $request->img->extension();
            $request->img->move(public_path('upload/user'), $image);
            $user->profile_photo_path = $image;
        }
        $user->save();
        return response()->json([
            'status' => 200,
            'message' => 'User Created Successfully',
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
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $user
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
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ]);
        }
        if($request->name){
            $user->name = $request->name;
        }
        if($request->premium == 0 || $request->premium == 1){
            $user->prime = $request->premium;
        }
        if($request->email){
            $user->email = $request->email;
        }
        if($request->password){
            $hashPass = Hash::make($request->password);
            $user->password = $hashPass;
        }
        if ($request->file('img')) {
            $des = 'upload/user/' . $user->profile_photo_path;
            File::delete($des);
            $image = time() . 'user.' . $request->img->extension();
            $request->img->move(public_path('upload/user'), $image);
            $user->profile_photo_path = $image;
        }
        $user->update();
        return response()->json([
            'status' => 200,
            'message' => 'User updated successfully'
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
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ]);
        }

        $des = 'upload/user/' . $user->profile_photo_path;
        File::delete($des);
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully'
        ]);
    }
}
