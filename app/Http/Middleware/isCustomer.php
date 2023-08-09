<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Models\CustomerAuth;
use Session;

class isCustomer
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has('userId') || $request->session()->has('userId') === null ){
            return redirect()->route('logOut');
        }else{
            $customer=CustomerAuth::findOrFail(session()->get('userId'));
            app()->setLocale($customer->language); // language
            if(!$customer){
                return redirect()->route('logOut');
            }else{
                return $next($request);
            }
        }
        return redirect()->route('logOut');
    }
}
