<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use App\Restaurant;
use Auth;

class RestaurantInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function restaurantInfo($id)
    {
        $restaurantInfo = Restaurant::where('id', '=', $id)->first();

        return view('restaurant.restaurant_info', [
            'restaurantInfo' => $restaurantInfo
        ]);
    }


    public function restaurantInfoSubmit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_name'   => 'required',
            'logo'              => 'required',
            'email'             => 'required|email',
            'website'           => 'required',
            'phone'             => 'required',
            'address'           => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else 
        {

            $logo = $this->uploadFile($request->file('logo'), '/image/logo/');
           // dd($logo);

            $restaurant = Restaurant::find($id);
            $restaurant->name = $request->restaurant_name;
            $restaurant->logo = $logo;
            $restaurant->email = $request->email;
            $restaurant->website = $request->website;
            $restaurant->phone = $request->phone;
            $restaurant->address = $request->address;

            $restaurant->save();
            
            return redirect()->route('dashboard',['id' => Auth::id()])->with('success', 'Your Restaurant Information are successfully granted !!!');
        }
    }






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
