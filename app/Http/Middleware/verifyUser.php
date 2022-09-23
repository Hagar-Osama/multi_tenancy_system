<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class verifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   //try {
    //     // attempt to verify the credentials and create a token for the user
    //     $token = JWTAuth::getToken();
    //     $apy = JWTAuth::getPayload($token)->toArray();
    // } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

    //     return response()->json(['token_expired'], 500);

    // } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

    //     return response()->json(['token_invalid'], 500);

    // } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

    //     return response()->json(['token_absent' => $e->getMessage()], 500);

    // }


        return $next($request);
    }
}
