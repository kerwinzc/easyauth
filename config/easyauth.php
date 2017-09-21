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

    'return'  => [
        // 成功默认返回的code
        'success_code' => '0',
        // 成功默认返回的message
        'success_msg'  => 'success',
        // 服务器状态异常默认返回的code
        'error_code'   => '999999',
        // 服务器状态异常默认返回的message
        'error_msg'    => '发生未知错误,请联系客服!',
    ],

];
