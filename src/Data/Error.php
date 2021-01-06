<?php

namespace Startcode\Profiler\Data;

use Startcode\Profiler\ErrorData;

class Error extends LoggerAbstract
{

    /**
     * @var ErrorData
     */
    private $errorData;


    public function getRawData() : array
    {
        return [
            'id'        => md5(uniqid(microtime(), true)),
            'timestamp' => $this->getJsTimestamp(),
            'datetime'  => date('Y-m-d H:i:s'),

            'code'      => $this->errorData->getCode(),
            'type'      => $this->errorData->getName(),
            'message'   => $this->errorData->getMessage(),
            'file'      => $this->errorData->getFile(),
            'line'      => $this->errorData->getLine(),
            'trace'     => json_encode($this->errorData->getTrace()),
            'context'   => json_encode($this->errorData->getContext()),

            'hostname'  => gethostname(),
            'pid'       => getmypid(),
            'ip'        => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR']: 'cli',
            'client_ip' => $this->getClientIp(),
            'app_name'  => $this->getAppName(),
            'headers'   => json_encode($this->getXNDParameters()),
        ];
    }

    public function setErrorData(ErrorData $errorData) : self
    {
        $this->errorData = $errorData;
        return $this;
    }
}
