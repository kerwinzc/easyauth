### 安装
#### 下载
```
composer require kerwinzc/easyauth
```

#### 创建配置文件

```
php artisan vendor:publish --provider="Kerwinzc\EasyAuth\ServiceProvider"
```

文件内容如下，自行修改
```
<?php
return [
    'request' => [
        // Api请求sign加密盐值
        'api_request_salt' => env('API_REQUEST_SALT', 'default'),
        // Token过期时间
        'token_expired'    => 10080,
        // 是否开启单点登录
        'api_check_only'   => false,
        // 是否开启调试模式
        'api_debug' => false,
        // 调试模式传入user_id
        'api_debug_user_id' => 1,
    ],
];
```

### 使用
#### 注册服务提供者
在 `config/app.php` 注册 `ServiceProvider`
```
'providers' => [
    // ...
    Kerwinzc\EasyAuth\ServiceProvider::class,
]
```

#### 创建token
```
$token = app('easyauth')->make($user_id);
```

#### 使用签名验证中间件
前往`app/Http/Kernel.php`中注册中间件
```
protected $routeMiddleware = [
    // ...
    'easyauth' => \Kerwinzc\EasyAuth\Middleware\Check::class,
];
```
在需要签名验证的路由上添加中间件
```
Route::group(['middleware' => ['web', 'easyauth']], function () {
    Route::get('/user', function () {
        $user_id = request()->get('user_id'); // 拿到用户ID

        dd($user_id);
    });
});
```
