<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Restaurant;
use App\User;
use App\DeliveryMan;
use App\OrderFoodItem;

class AdminController extends Controller
{


    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function orderlist()
    {

        $orderlists = Order::with(['orderFoodItems' => function($query){
            $query->with('foodItem');
        }])->where([
            ['is_valid', '=', 0], 
            ['is_blacklisted', '=', 0],
        ])->get();


    	return view('admin.orderlist',[
            'orderlists' => $orderlists
        ]);
    }


    public function ordervalidity($id)
    {
        $validId = Order::find($id);
        $validId->is_valid = 1;
        $validId->save();

        return $this->orderlist();
    }


    public function orderCancel($id)
    {
        $blacklistId = Order::find($id);
        $blacklistId->is_blacklisted = 1;
        $blacklistId->save();
        return $this->orderlist();
    }


    public function blackList()
    {
        $blacklists = Order::where('is_blacklisted', '=', 1)->get();

        return view('admin.blacklist',[
            'blacklists' => $blacklists
        ]);
    }



    public function pendingList()
    {
        $pendinglists = Order::where([
            ['is_valid', '=', 1], 
            ['is_paid', '=', 0],
        ])->get();
        
        return view('admin.pendinglist',[
            'pendinglists' => $pendinglists
        ]);
    }

    public function deliverer()
    {
        $delivererlists = DeliveryMan::get();
        return view('admin.deleivery_man',[
            'delivererlists' => $delivererlists
        ]);
    }


    public function restaurantstatistics()
    {
    	$restaurantsList = Restaurant::with(['orders'=>function($query){
            $query->where('is_valid',1);
        }])->get();
        
        $colors = ['#FDB45C','#46BF7C','#46BFBD', '#334556'];
        $highlights = ['#FFC870','#30905B', '#5AD3D1', '#2A3F54'];

        $colorCount = count($colors);

        $restaurantsData = [];
        $colorTrack = 0;
        foreach ($restaurantsList as $restaurant) {
            $data = new \stdClass();
            $data->value = $restaurant->orders->count();
            $data->color = $colors[$colorTrack];
            $data->highlight = $highlights[$colorTrack];
            $data->label = $restaurant->name;
            array_push($restaurantsData, $data);
            $colorTrack++;
            if($colorTrack >= $colorCount)
                $colorTrack = 0;

        }

        return view('admin.restaurant_stat',[
            'restaurantsData'   => json_encode($restaurantsData)
        ]); 
    }
}
