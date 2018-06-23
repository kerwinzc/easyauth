<?php

namespace Kerwinzc\EasyAuth\Middleware;

use Closure;

class TokenCheck
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
            $request->attributes->add([
                'user_id' => config('easyauth.request.api_debug_user_id'),
            ]);

            return $next($request);
        }

        $data = $request->input();

        $result_token = app('easyauth')->check($data['token'] ?? '');

        if (is_object($result_token)) {
            return $result_token;
        }

        $user_id = app('easyauth.sign')->token_save($data, $result_token);

        if (is_object($user_id)) {
            return $user_id;
        }

        $request->attributes->add([
            'user_id' => $user_id,
        ]);

        return $next($request);
    }

}
