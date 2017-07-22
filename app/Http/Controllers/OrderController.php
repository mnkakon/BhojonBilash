<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Restaurant;
use App\FoodItem;
use App\Order;
use App\OrderFoodItem;
use App\DeliveryMan;
use Validator;
use \Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function foodOrder($id)
    {
        $foodItem = FoodItem::where('id', '=', $id)->first();
        Cart::add($foodItem->id, $foodItem->name, 1, $foodItem->price);
        

        return redirect()->back()->with('success', 'A food item is successfully added to your cart!');
    }


    public function checkout($id)
    {
        $restaurant = Restaurant::find($id);
        return view('order.order_food', [
            'restaurant' => $restaurant
        ]);
    }


    public function orderForm($id, Request $request)
    {
       // return \Cart::content();
        $validator = Validator::make($request->all(), [
            'contact'   => 'required',
            'address'   => 'required',
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
            $blacklist_check = $request->contact;
            $blacklisted = Order::where([
                ['contact', '=', $blacklist_check],
                ['is_blacklisted', '=', 1]
            ])->first();

            $deliver = DeliveryMan::where('delivering_area', 'like', '%'.$request->address.'%')->first();
            $delivery_man = $deliver->name;

            if(!$blacklisted) 
            {
                $order = new Order();

                $order->contact = $request->contact;
                $order->address = $request->address;
                $order->delivered_by = $delivery_man;
                $order->restaurant_id = $id;
                $order->total_price = \Cart::total();

                $order->save();


                foreach (\Cart::content() as $orderItem) {

                    $orderFoodItem = new OrderFoodItem();

                    $orderFoodItem->order_id = $order->id; 
                    $orderFoodItem->food_id = $orderItem->id;
                    $orderFoodItem->price = $orderItem->price;
                    $orderFoodItem->quantity = $orderItem->qty;
                    $orderFoodItem->save();    
                }

                Cart::destroy();

                $restaurantsList = Restaurant::get();
                return view('home.restaurants',[
                    'restaurantsList' => $restaurantsList
                ])->with('success', 'Food Item is successfully ordered! Order from another restaurant');
            }

            else
            {

                $cartContent = \Cart::content();
                $restaurantId = $id;
                /*return $blacklisted;*/
                /*return $cartContent;*/
                return view('order.user_alert',[
                    'blacklisted' => $blacklisted,
                    'restaurantId' => $restaurantId
                ]);
            }
            
        }
    }


    public function removeBlacklist($id, $restaurantId)
    {
        $blacklistId = Order::find($id);
        $blacklistId->is_blacklisted = 0;
        $blacklistId->save();

        $deliver = DeliveryMan::where('delivering_area', 'like', '%'.$blacklistId->address.'%')->first();
        $delivery_man = $deliver->name;

        $order = new Order();

        $order->contact = $blacklistId->contact;
        $order->address = $blacklistId->address;
        $order->delivered_by = $delivery_man;
        $order->restaurant_id = $restaurantId;
        $order->total_price = \Cart::total();

        $order->save();


        foreach (\Cart::content() as $orderItem) {

            $orderFoodItem = new OrderFoodItem();

            $orderFoodItem->order_id = $order->id; 
            $orderFoodItem->food_id = $orderItem->id;
            $orderFoodItem->price = $orderItem->price;
            $orderFoodItem->quantity = $orderItem->qty;
            $orderFoodItem->save();    
        }
        Cart::destroy();

        $restaurantsList = Restaurant::get();
        return view('home.restaurants',[
            'restaurantsList' => $restaurantsList
        ])->with('success', 'Food Item is successfully ordered! Order from another restaurant');
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
