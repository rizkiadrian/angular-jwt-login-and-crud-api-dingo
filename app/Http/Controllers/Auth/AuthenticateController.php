<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;

class AuthenticateController extends Controller
{

	public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       $this->middleware('jwt.auth', ['except' => ['authenticate']]);
   }

	public function index()
	{
	  $user = User::all();
	  return response()->json($user);
	}    
	
	public function authenticate(Request $request)
	{
	$credentials = $request->only('email', 'password');
	try {
	// verify the credentials and create a token for the user
	if (! $token = JWTAuth::attempt($credentials)) {
	return response()->json(['error' => 'invalid_credentials'], 401);
	}
	} catch (JWTException $e) {
	// something went wrong
	return response()->json(['error' => 'could_not_create_token'], 500);
	}
	// if no errors are encountered we can return a JWT
	return response()->json(compact('token'));
	}


	public function getAuthenticatedUser()
	{
	try {
	if (! $user = JWTAuth::parseToken()->authenticate()) {
	return response()->json(['user_not_found'], 404);
	}
	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	return response()->json(['token_expired'], $e->getStatusCode());
	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	return response()->json(['token_invalid'], $e->getStatusCode());
	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	return response()->json(['token_absent'], $e->getStatusCode());
	}
	// the token is valid and we have found the user via the sub claim
	return response()->json($user);
	}
}
