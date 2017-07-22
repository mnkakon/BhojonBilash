<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use App\User;
use App\Restaurant;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function registration()
    {
         return view('auth.registration', []);
    }



    public function registrationForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'restaurant_name'       => 'required',
            'role'                  => 'required',
            'img'                   => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'contact'               => 'required',
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

            $img = $this->uploadFile($request->file('img'), '/image/user/');
            //dd($img);

            $restaurant = new Restaurant();
            $restaurant->name = $request->restaurant_name;
            $restaurant->save();

            $user = new User();

            $user->name = $request->name;
            $user->role = $request->role;
            $user->img = $img;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->contact = $request->contact;
            $user->restaurant_id = $restaurant->id;
            $user->save();
            
            return redirect()->route('login')->with('success', 'You are successfully registered!');
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
