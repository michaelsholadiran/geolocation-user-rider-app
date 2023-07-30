<?php

namespace App\Http\Controllers\User;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $user_ip = '41.190.30.69';
        // $geo = Http::get("http://www.geoplugin.net/php.gp?ip=$user_ip");
        // dd($geo);
        // $country = $geo["geoplugin_countryName"];
        // $city = $geo["geoplugin_city"];
        // $location = Location::where('user_id', auth()->user()->id)->firstOrFail();

        return view('user.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'latlng' => ['required'],
            'address' => ['required'],

        ]);

        // $location = new Location;
        // $location->user_id = auth()->user()->id;
        // $location->data = $request->latlng;
        // $location->save();

        Location::updateOrCreate(['user_id' => auth()->user()->id], [
            'data' => $request->latlng,
            'address' => $request->address
        ]);

        return back()->with('message', 'success');
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
