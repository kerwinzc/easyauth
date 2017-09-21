<?php

namespace Kerwinzc\EasyAuth;

class SignService
{

    public function make($data)
    {
        array_forget($data, 'sign');
        ksort($data);

        $string = '';
        foreach ($data as $key => $value) {
            $string .= $key . '=' . $value . '&';
        }

        $salt = config('easyauth.request.api_request_salt');
        $string .= $salt;

        $sign = md5($string);

        return $sign;
    }

    public function check($data, $token_value)
    {
        $sign = $this->make($data);

        if ($sign !== $data['sign']) {
            return easy_auth_error_return('060003', '签名验证失败');
        }

        $request_sign = $token_value['sign'];

        if ($request_sign == $sign) {
            return error_default_return('060004', '请求过于频繁');
        }

        easy_auth_cache_token($token_value['key'], $data['sign'], $data['token']);

        return $token_value['key'];
    }

}