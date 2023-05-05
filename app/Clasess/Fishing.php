<?php

namespace App\Clasess;

use Illuminate\Http\Request;

use App\Models\MfishingBoat;

class Fishing{
    public function create(Request $request)
    {
        $imageName1                     = '';
        if(!empty($request->image)){
            $now                        = \Carbon\Carbon::now();
            $year                       = date('Y', strtotime($now));
            $month                      = date('m', strtotime($now));
            $days                       = date('d', strtotime($now));
            $minute                     = date('his', strtotime($now));
            $nmfiles                    = $days.''.$minute;
    
            $bs1                    = $request->file('file')->getClientOriginalExtension();
            $nombreCarpeta1         = preg_replace('/\s+/', '.', $year . "/" . $month . "/" . $days);
            $fileimg1               = preg_replace('/\s+/', '', 'signature-'.$nmfiles) . '.' .$bs1;
                
            $signature              = 'img/'.$nombreCarpeta1 .'/' .$fileimg1;
            $path1                  = public_path() .'/img/'.$nombreCarpeta1;
    
            $imageName1             = 'boat-'.$nmfiles. '.' .
            $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move($path1, preg_replace('/\s+/', '', $imageName1));

        }

        $fishing                    = new MfishingBoat;

        $fishing->boat_code         = $this->boatcode();
        $fishing->boat_name         = $request->boat_name;
        $fishing->address           = $request->address;
        $fishing->size_boat         = $request->size_boat;
        $fishing->captain           = $request->captain;
        $fishing->member_count      = $request->member_count;
        $fishing->images            = $request->images;
        $fishing->license_number    = $request->license_number;
        $fishing->status            = '0';
        $fishing->images            = $imageName1;
        $fishing->user_id           = $request->user_id;

        $fishing->save();

        return $fishing;
    }
    public function getBoat()
    {
        return MfishingBoat::join('users as u', 'fishing_boat.user_id', 'u.id');
    }
    public function updateBoat(Request $request)
    {
        if(!empty($request->status) && !empty($request->reasson) ){
            MfishingBoat::where('id', $request->fishing_id)->update(array('status' => $request->status,'reasson' => $request->reasson));
            return ['message' => 'sucess update'];
        }else{
            return ['message' => 'status & reasson cannot be null'];
        }
    }
    public function boatcode()
    {
        $now                                    = \Carbon\Carbon::now();
        $kode                                   = MfishingBoat::select(\DB::raw('max(boat_code) as maxcode'))->first();
        $kodefish                               = $kode->maxcode;
        $urutan                                 = (int) substr($kodefish, 5, 3);
        $urutan++;
        $huruf = "FI";
        $kodefish = $huruf . sprintf("%05s", $urutan).date('my');
        return $kodefish;
    }
}