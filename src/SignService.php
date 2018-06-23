<?php

namespace Kerwinzc\EasyAuth;

class SignService
{
    use ApiResponse;

    public function make($data)
    {
        array_forget($data, 'sign');
        ksort($data);

        $string = '';
        foreach ($data as $key => $value) {
            $string .= $key . '=' . $value . '&';
        }

        $salt   = config('easyauth.request.api_request_salt');
        $string .= $salt;

        $sign = md5($string);

        return $sign;
    }

    public function sign_check($data)
    {
        $sign = $this->make($data);

        if ($sign !== array_get($data, 'sign')) {

            return $this->setCode('060003')->setMsg('签名验证失败')->respond();
        }

        return $sign;
    }

    public function token_save($data, $token_value)
    {
        if (array_get($data, 'sign') == $token_value['sign']) {
            return $this->setCode('060004')->setMsg('请求过于频繁')->respond();
        }

        easy_auth_cache_token($token_value['key'], array_get($data, 'sign'), array_get($data, 'token'));

        return $token_value['key'];
    }

}