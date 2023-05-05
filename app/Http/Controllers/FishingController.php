<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clasess\Fishing;

use Auth;

class FishingController extends Controller
{
    public function __construct()
    {
        $this->fish                 = new Fishing;
    }
    public function view(Request $request)
    {
        $fishingdata                = $this->fish->getBoat()
                                    ->where('u.token', auth()->user()->token)
                                    ->first();
        return response()->json($fishingdata);
    }
    public function store(Request $request)
    {
        $fishinginsert              = $this->fish->create($request);

        return response()->json($fishinginsert);
    }
    public function update(Request $request)
    {
        $fishingupdate              = $this->fish->updateBoat($request);

        return response()->json($fishingupdate);
    }
}
