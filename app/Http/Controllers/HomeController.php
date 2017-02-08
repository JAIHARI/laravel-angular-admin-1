<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use App\User;
use Validator;
class HomeController extends Controller
{

  public function index(Request $request){
    if(is_null(Auth::user())){
      return view('auth');
    }else{
      return view('index');
    }
    //return response()->json(['auth'=>Auth::user(), 'users'=>User::all()]);
  }
  public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials =["email"=>$request->email,"password"=>$request->password];

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                //return response()->json(['error' => 'invalid_credentials'], 401);
                return view('auth');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        //return response()->json(compact('token'));
        return view('index');
    }
    public function register(){
      return view('reg');
    }

    public function register_user(Request $request){
      $validator = Validator::make($request->all(), [
          'name' => 'required|max:255',
          'email' => 'required|unique:users|max:255',
          'password' => 'required|min:6',
      ]);

      if ($validator->fails()) {
          return redirect()->back()
                      ->withErrors($validator)
                      ->withInput();
      }
      $user=User::firstOrCreate(['name' => $request->name,
      'email'=>$request->email,
      'password'=>bcrypt($request->password)
    ]);
      return redirect('/');

    }
}
