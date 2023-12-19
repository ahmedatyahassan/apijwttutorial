<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthForAll
{

    use ApiResponseTrait;
    
    public function handle(Request $request, Closure $next, $guards): Response
    {
        
        $guards = explode('&', $guards);
        foreach($guards as $guard){
            if(auth($guard)->check()){
                return $next($request);
            }
        }
        return $this->insufficientPrivilegesResponse();
    }
}
