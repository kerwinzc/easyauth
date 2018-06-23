<?php

namespace Kerwinzc\EasyAuth;

class TokenService
{
    use ApiResponse;

    public function make($key)
    {
        $token = $this->generate_token();

        easy_auth_cache_token($key, '', $token);

        return $token;
    }

    public function generate_token()
    {
        $token = md5(uniqid());

        if ( ! empty(cache($token))) {
            return $this->generate_token();
        }

        return $token;
    }

    public function check($token)
    {
        $value = cache($token);

        if (empty($value)) {
            return $this->setCode('060001')->setMsg('token不存在')->respond();
        }

        $cache_key = easy_auth_get_cache_key($value['key']);
        $key_token = cache($cache_key);

        if ($key_token != $token && config('easyauth.request.api_check_only')) {
            return $this->setCode('060002')->setMsg('账号在另一地点登录')->respond();
        }

        return $value;
    }

}
