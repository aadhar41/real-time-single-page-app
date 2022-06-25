<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login', 'signup']]);
    }

    /**
     * The function takes the email and password from the request, and if the credentials are correct,
     * it returns a token. Get a JWT via given credentials.
     * 
     * @return \Illuminate\Http\JsonResponse A token
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * It creates a new user with the data from the request, and then logs the user in
     * 
     * @param SignupRequest request The request object.
     * 
     * @return The login function is being returned.
     */
    public function signup(SignupRequest $request)
    {
        $request->password = Hash::make($request->password);
        User::create($request->all());
        return $this->login($request);
    }


    /**
     * It returns the currently authenticated user. Get the authenticated User.
     * 
     * @return \Illuminate\Http\JsonResponse The user that is currently logged in.
     */
    public function me()
    {
        return response()->json(auth()->user());
    }


    /**
     * It logs out the user. Log the user out (Invalidate the token).
     * 
     * @return \Illuminate\Http\JsonResponse A JSON response with a message.
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * It takes the token from the request, decodes it, and returns the user's ID. Refresh a token.
     * 
     * @return \Illuminate\Http\JsonResponse The token is being returned.
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * It returns a JSON response with the access token, token type, expiration time, and the user's
     * name. Get the token array structure.
     * 
     * @param string $token The JWT
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name
        ]);
    }


    /**
     * It returns the payload of the authenticated user.
     * 
     * @param Type|null $var
     * @return The payload is being returned.
     */
    public function payload()
    {
        return $payload = auth()->payload();
    }
}