<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function login()
    {
        return view('auth.login', []);
    }



    public function loginForm(Request $request)
    {
       
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            $authUser = Auth::user();
            if($authUser->isAdmin())
            {
                return redirect()->route('orderList');
            }
            $hasRestaurantInformation = $authUser->restaurant->email;
            if( ! $hasRestaurantInformation) {
                return redirect()->route('restaurant_info_create',['id' =>$authUser->restaurant_id] )->with('success', 'You are successfully logged in. Now give your restaurant information');
            }

            else {
                // enter the dashboard
                return redirect()->intended(route('dashboard',['id' => $authUser->id]));
            }
        }
        else
        {
            return redirect()->back()->with('danger', 'Email or Password is not correct. Try Again !!!');
        }
    }

    public function logOut()
    {
        Auth::logOut();
        return redirect()->route('home');
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
