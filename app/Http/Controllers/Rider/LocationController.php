<?php

namespace App\Http\Controllers\Rider;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Location::with('user')->get();
        // "[6.537216,3.3521664]"
        // $geolocation = 6.537216 . ',' . 3.3521664;
        // $res = Http::get('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCDv4AewhqtQJzy1Dy7CbDpTH8dA_6mzEU&latlng=' . $geolocation . '&sensor=false')->json();
        // dd($res);


        $ref = array(6.537216, 3.3521664);

        $items = $list->toArray();
        // dd($items);
        // $items = array(
        //     '0' => array('item1', 'otheritem1details....', '55.645645', '-42.5323'),
        //     '1' => array('item1', 'otheritem1details....', '100.645645', '-402.5323')
        // );

        $distances = array_map(function ($item) use ($ref) {
            // $a = array_slice($item, -2);
            $a = json_decode($item['data']);
            // dd($a);

            return $this->distance($a, $ref, $item['user']['name'], $item['address']);
        }, $items);

        $a = asort($distances);

        // dd($distances);
        // dd(key($distances));
        // dd($items[key($distances)]);
        // echo 'Closest item is: ', var_dump($items[key($distances)]);

        $list = $distances;
        return view('rider.location.index', compact('list'));
    }

    public function distance($a, $b, $user_id, $address)
    {
        list($lat1, $lon1) = $a;
        list($lat2, $lon2) = $b;

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = [$dist * 60 * 1.1515, $user_id, $address];
        return $miles;
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
