<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Restaurant;
use App\FoodItem;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function restaurantSearch(Request $request)
    {
        $restaurantLists = Restaurant::where('address', 'like', '%'.$request->areaSearch.'%')->get();
        return view('restaurant.restaurant_search_result', [
            'restaurantLists' => $restaurantLists
        ]);
    }

    public function foodSearch($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurantName = $restaurant->name;
        $restaurantId = $restaurant->id;
        $foodItemLists = FoodItem::where('restaurant_id', '=', $restaurantId)->get();
        return view('restaurant.food_item_result', [
            'restaurantName' => $restaurantName,
            'restaurantId'  => $restaurantId,
            'foodItemLists' => $foodItemLists
        ]);
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
