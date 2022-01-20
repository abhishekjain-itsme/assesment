<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $myLat;
    public $myLong;

    public function __construct()
    {
        $this->myLat  = "53.3340285";
        $this->myLong = "-6.2535495";
    }

    public function getNearestLocation(Request $request) // get nearest location
    {
        $validator = \Validator::make($request->all(), [
            'file' => 'required|mimes:json|file',
        ]);

        if ($validator->fails()) {
            $result = [
                'status'  => 'validation',
                'message' => 'Please upload valid JSON-encoded file',
            ];

            return response()->json($result);
        }

        if (!empty($request->file))
        {
            $fileContents = file($request->file, FILE_IGNORE_NEW_LINES);

            foreach ($fileContents as $val)
            {
                $info = json_decode($val, true);
                $kilometers = $this->distance($this->myLat, $this->myLong, $info['latitude'], $info['longitude'], 'K');

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
        } else {
            return back()->with('error','Please upload valid file.')->with('data', []);
        }
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
