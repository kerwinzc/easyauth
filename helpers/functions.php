<?php

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
