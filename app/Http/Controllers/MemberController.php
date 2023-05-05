<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clasess\Users;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->users                = new Users;
    }
    public function userpending(Request $request)
    {
        $memberpending              = $this->users->Allusers()
                                    ->select('users.*', 'r.name as role_name')
                                    ->where('status', '0')
                                    ->paginate(10);
        return response()->json($memberpending);
    }
    public function activemember(Request $request)
    {
        $memberset                  = $this->users->setUsersstatus($request);
        return response()->json($memberset);
    }
}
