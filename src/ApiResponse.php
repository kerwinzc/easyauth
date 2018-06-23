<?php

namespace Kerwinzc\EasyAuth;

trait ApiResponse
{

    protected $statusCode = 200;

    protected $code = '0';

    protected $msg = 'success';

    protected $errorCode = '999999';

    protected $errorMsg = 'server exception, try again later.';

    protected $data = [];

    public function __construct()
    {
        $this->data = (object) null;
    }

    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function setMsg($message)
    {
        $this->msg = $message;

        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function setError()
    {
        $this->code = $this->errorCode;
        $this->msg  = $this->errorMsg;

        return $this;
    }

    public function respond()
    {
        $data = [
            'code' => $this->code,
            'msg'  => $this->msg,
            'data' => $this->data,
        ];

        return response()->json($data);
    }
}