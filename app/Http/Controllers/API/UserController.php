<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = request()->input('name');
        $username = request()->input('username');
        $email = request()->input('email');
        $page = request()->input('page', 1);
        $limit = request()->input('limit', 10);

        $user = User::query();

        if ($name) {
            $user->where('name', 'like', '%' . $name . '%');
        }

        if ($username) {
            $user->where('username', 'like', '%' . $username . '%');
        }

        if ($email) {
            $user->where('email', 'like', '%' . $email . '%');
        }

        if ($page) {
            $user->skip(($page - 1) * $limit);
        }

        return ResponseFormatter::success(
            $user->paginate($limit),
            'Data list user berhasil',
        );
    }

    /**
     * Display a detail profile based on token.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile() {
        $user = Auth::user();
        return ResponseFormatter::success($user, 'Data profile user berhasil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
