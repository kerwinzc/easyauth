<?php

return [

    'request' => [
        // Api请求sign加密盐值
        'api_request_salt'  => env('API_REQUEST_SALT', 'default'),
        // Token过期时长(分)
        'token_expired'     => 10080,
        // 是否开启单点登录
        'api_check_only'    => false,
        // 是否开启调试模式
        'api_debug'         => false,
        // 调试模式传入user_id
        'api_debug_user_id' => 1,
    ],

];
