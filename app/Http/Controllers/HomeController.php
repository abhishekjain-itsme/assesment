<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        $fileContents = file($request->file, FILE_IGNORE_NEW_LINES);

        foreach ($fileContents as $val)
        {
            $info = json_decode($val, true);
            $kilometers = $this->distance('53.3340285', '-6.2535495', $info['latitude'], $info['longitude'], 'K');

            if ($kilometers <= 100)
            {
                $info['distance'] = $kilometers;
                $arr[] = $info;
            }
        }

        usort($arr, function($a, $b){
            return $a['affiliate_id'] <=> $b['affiliate_id'];
        });

        return back()->with('success','You have successfully upload the file.')->with('data', $arr);
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist*60*1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}
