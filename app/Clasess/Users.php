<?php

namespace App\Clasess;

use Illuminate\Http\Request;

use App\Models\User;

class Users{

    public function getUser()
    {
        return User::join('roles as r', 'users.role_id', 'r.id');
    }
    public function Allusers()
    {
        return User::leftjoin('roles as r', 'users.role_id', 'r.id');
    }
    public function setUsersstatus(Request $request)
    {
        if($request->user_id && $request->role_id){
            User::where('id', $request->user_id)->update(array('status' => '1', 'role_id' => $request->role_id));
            return ['msg' => 'success update'];
        }else{
            return ['msg' => 'error update'];
        }
    }
}