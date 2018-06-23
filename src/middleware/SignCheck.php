<?php

namespace Kerwinzc\EasyAuth\Middleware;

use Closure;

class SignCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('easyauth.request.api_debug')) {

            return $next($request);
        }

        $data       = $request->input();
        $sign_check = app('easyauth.sign')->sign_check($data);

        if (is_object($sign_check)) {
            return $sign_check;
        }

        return $next($request);
    }

}
