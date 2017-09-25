<?php

return [

    'request' => [
        // Api请求sign加密盐值
        'api_request_salt' => env('API_REQUEST_SALT', 'default'),
        // Token过期时间
        'token_expired'    => 10080,
        // 是否开启单点登录
        'api_check_only'   => false,
    ],

];
