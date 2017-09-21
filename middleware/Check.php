<?php

namespace Kerwinzc\EasyAuth\Middleware;

use Closure;

class Check
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
        $data = $request->input();      // 获取所有请求参数

        $result_token = app('easyauth')->check($data['token'] ?? '');

        if ( ! empty( $result_token['code'] )) {
            exit( json_encode($result_token) );
        }

        $user = app('easyauth.sign')->check($data, $result_token);

        if ( ! empty( $user['code'] )) {
            exit( json_encode($user) );
        }

        $request->attributes->add([
            'user_id' => $user,
        ]);

        return $next($request);
    }

}
