<?php

if ( ! function_exists('easy_auth_success_return')) {

    function easy_auth_success_return($data)
    {
        return [
            'code' => config('easyauth.return.success_code'),
            'msg'  => config('easyauth.return.success_msg'),
            'data' => $data,
        ];
    }

}

if ( ! function_exists('easy_auth_error_return')) {

    function easy_auth_error_return($code = '', $msg = '')
    {
        if ($code == '') {
            $code = config('easyauth.return.error_code');
        }
        if ($msg == '') {
            $msg = config('easyauth.return.error_msg');
        }

        return [
            'code' => $code,
            'msg'  => $msg,
            'data' => (object) [ ],
        ];
    }

}

if ( ! function_exists('easy_auth_cache_token')) {

    function easy_auth_cache_token($key, $sign, $token)
    {
        $cache_key  = easy_auth_get_cache_key($key);
        $cache_time = config('easyauth.request.token_expired');

        $token_value = [
            'key'  => $key,
            'sign' => $sign,
        ];

        cache([ $token => $token_value ], $cache_time);
        cache([ $cache_key => $token ], $cache_time);
    }
}

if ( ! function_exists('easy_auth_get_cache_key')) {

    function easy_auth_get_cache_key($key)
    {
        return 'easy_auth_key_' . $key;
    }

}
