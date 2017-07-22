<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use App\User;
use Auth;
use App\Restaurant;
use App\FoodItem;
use App\Catagory;
use App\Order;
use App\OrderFoodItem;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{

    function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function dashboard($id)
    {
        $authUser = Auth::user();

        $restaurantId = $authUser->restaurant_id;
        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();



        //order in that date (number, total_price)
        $orders = Order::where('restaurant_id', '=', $restaurantId)
            ->whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            ->get();

        $orderCount =  $orders->count();


        $price_total = 0;
        foreach ($orders as $order) {
            $price_total += $order->total_price;
        }


        $data = Order::where('restaurant_id', '=', $restaurantId)
                ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->groupBy(DB::raw('DATE(created_at)'))
                ->select('created_at', DB::raw('DAY(created_at) as day_num') ,DB::raw('count(*) as total'))
                ->get();

                
        $daysArray = [];
        $dailyOrderCounts = [];
        for($i = 1; $i <= Carbon::now()->endOfMonth()->day; $i++){
            array_push($daysArray, $i);
            array_push($dailyOrderCounts, 0);
        }

        foreach ($data as $orderData) {
            $dailyOrderCounts[$orderData->day_num - 1] = $orderData->total;
        }

       // return response()->json([$daysArray, $dailyOrderCounts]);



        return view('dashboard.user_dashboard', [
            'authUser'          => $authUser,
            'categoriesList'    => $categoriesList,
            'orderCount'        => $orderCount,
            'price_total'       => $price_total,
            'daysArray'         => json_encode($daysArray),
            'dailyOrderCounts'  => json_encode($dailyOrderCounts)
        ]);
    }


    public function individualFoodStat()
    {
        $authUser = Auth::user();

        $restaurantId = $authUser->restaurant_id;

        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();


        $orderFoodItems = OrderFoodItem::with('foodItem')
            ->whereHas('foodItem', function($query) use ($restaurantId){
                $query->where('restaurant_id','=', $restaurantId);
            })
            ->groupBy('food_id')
            ->select('food_id',DB::raw('count(*) as total'))
            ->get();

        $foodItemsList = [];
        $orderCounts = [];
        foreach ($orderFoodItems as  $orderFoodItem) {
            array_push($foodItemsList, $orderFoodItem->foodItem->name);
            array_push($orderCounts, $orderFoodItem->total);
        }


        return view('dashboard.food_stat', [
            'authUser'      => $authUser,
            'foodItemsList' => json_encode($foodItemsList),
            'orderCounts'   => json_encode($orderCounts),
            'categoriesList'=> $categoriesList
        ]);
    }


    public function restaurantStat() 
    {
        $authUser = Auth::user();
        
        $restaurantId = $authUser->restaurant_id;
        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();
       
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

        return view('dashboard.restaurant_stat',[
            'authUser'          => $authUser,
            'categoriesList'    => $categoriesList,
            'restaurantsData'   => json_encode($restaurantsData)
        ]);
    }





    public function singleCategory($id) 
    {
        $authUser = Auth::user();
        
        $restaurantId = $authUser->restaurant_id;
        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();

        $foodItems = FoodItem::where('category_id', '=', $id)->get();

        return view('dashboard.category_food_item',[
            'authUser'          => $authUser,
            'categoriesList'    => $categoriesList,
            'foodItems'         => $foodItems
        ]);
    }


    public function foodUpdate($id)
    {
        $authUser = Auth::user();
        
        $restaurantId = $authUser->restaurant_id;
        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();

        $foodDetails = FoodItem::where('id', '=', $id)->first();

        return view('dashboard.food_update', [
            'authUser'          => $authUser,
            'categoriesList'    => $categoriesList,
            'foodDetails'       => $foodDetails
        ]);
    }


    public function foodUpdateForm(Request $request, $id)
    {

        $image = $this->uploadFile($request->file('image'), '/image/foods/');

        $foodItem = FoodItem::find($id);
        $foodItem->name = $request->name;
        $foodItem->price = $request->price;
        $foodItem->image = $image;
        $foodItem->person_count = $request->person_count;
        $foodItem->ingredients = $request->ingredients;
        $foodItem->description = $request->description;
        $foodItem->save();

        $authUser = Auth::user();
        
        /*$restaurantId = 1;*/
        $restaurantId = $authUser->restaurant_id;
        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();

        $foodItems = FoodItem::where('category_id', '=', $foodItem->category_id)->get();

        return view('dashboard.category_food_item',[
            'authUser'          => $authUser,
            'categoriesList'    => $categoriesList,
            'foodItems'         => $foodItems
        ])->with('success', 'Food item is successfully updated!');
    }



    public function foodDelete($id)
    {
        $foodDelete = FoodItem::find($id);
        $foodDelete->delete();

        $authUser = Auth::user();
        
        /*$restaurantId = 1;*/
        $restaurantId = $authUser->restaurant_id;
        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();

        $foodItems = FoodItem::where('category_id', '=', $id)->get();
        return $foodItems;
        return view('dashboard.category_food_item',[
            'authUser'          => $authUser,
            'categoriesList'    => $categoriesList,
            'foodItems'         => $foodItems
        ])->with('success', 'Food item is successfully deleted');
    }


    public function foodCreate()
    {
        $authUser = Auth::user();

        $restaurantId = $authUser->restaurant_id;
        /*$restaurantId = 1;*/
        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();

        return view('dashboard.food_item_create', [
            'authUser'          => $authUser,
            'categoriesList'    => $categoriesList
        ]);
    }


    public function foodCreateForm(Request $request, $id)
    {

        $authUser = Auth::user();

        /*$restaurantId = 1;*/
        $restaurantId = $authUser->restaurant_id;
        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'price'         => 'required',
            'image'         => 'required',
            'person_count'  => 'required',
            'ingredients'   => 'required',
            'category_id'   => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        else {
            $image = $this->uploadFile($request->file('image'), '/image/foods/');

            $newfood = new FoodItem();

            $newfood->name = $request->name;
            $newfood->price = $request->price;
            $newfood->image = $image;
            $newfood->person_count = $request->person_count;
            $newfood->ingredients = $request->ingredients;
            $newfood->description = $request->description;
            $newfood->category_id = $request->category_id;
            $newfood->restaurant_id = $id;
            $newfood->save();


            //order in that date (number, total_price)
            $orders = Order::where('restaurant_id', '=', $restaurantId)
                ->whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
                ->get();

            $orderCount =  $orders->count();


            $price_total = 0;
            foreach ($orders as $order) {
                $price_total += $order->total_price;
            }



            $data = Order::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->select('created_at', DB::raw('DAY(created_at) as day_num') ,DB::raw('count(*) as total'))
                    ->get();
        
            $daysArray = [];
            $dailyOrderCounts = [];
            for($i = 1; $i <= Carbon::now()->endOfMonth()->day; $i++){
                array_push($daysArray, $i);
                array_push($dailyOrderCounts, 0);
            }

            foreach ($data as $orderData) {
                $dailyOrderCounts[$orderData->day_num - 1] = $orderData->total;
            }
            
            return view('dashboard.user_dashboard', [
                'authUser'          => $authUser,
                'categoriesList'    => $categoriesList,
                'orderCount'        => $orderCount,
                'price_total'       => $price_total,
                'daysArray'         => json_encode($daysArray),
                'dailyOrderCounts'  => json_encode($dailyOrderCounts)
            ])->with('success', 'New food item is successfully created');
        }
    }


    public function categoryCreate()
    {
        $authUser = Auth::user();

        /*$restaurantId = 1;*/
        $restaurantId = $authUser->restaurant_id;
        $categoriesList = Catagory::where('restaurant_id', '=', $restaurantId)->get();

        return view('dashboard.category_create', [
            'authUser'          => $authUser,
            'categoriesList'    => $categoriesList
        ]);
    }


    public function categoryCreateForm(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name'          => 'required',
        ]);

        if ($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        else {
            $categories = Catagory::where('restaurant_id', '=', $id)->lists('category_name')->toArray();
            //return $categories;

            for ($i=0; $i < count($categories) ; $i++) { 
                if($request->category_name == $categories[$i])
                {
                    return redirect()->back()->with('unsuccess', 'You have a category with same name');
                }
            }

            $newcategory = new Catagory();

            $newcategory->category_name = $request->category_name;
            $newcategory->restaurant_id = $id;

            $newcategory->save();
            
            return $this->foodCreate();
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
