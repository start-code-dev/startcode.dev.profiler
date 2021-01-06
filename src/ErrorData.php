<?php

namespace Startcode\Profiler;

class ErrorData
{

    private $code;

    private $file;

    private $exceptionFlag;

    private $line;

    private $message;

    private $trace;


    public function getContext() : array
    {
        return [
            'REQUEST' => $_REQUEST,
            'SERVER'  => $_SERVER,
        ];
    }

    public function getDataAsString() : string
    {
        return join(PHP_EOL, [
            strtoupper($this->getName()) . ": {$this->getMessage()}",
            "LINE: {$this->getLine()}",
            "FILE: {$this->getFile()}",
        ]) . PHP_EOL;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getLine() :int
    {
        return $this->line;
    }

    public function getMessage() : string
    {
        return $this->message;
    }

    public function getName() : string
    {
        return $this->exceptionFlag === true
            ? 'exception'
            : ErrorCodes::getName($this->getCode());
    }

    public function getCode() : int
    {
        return $this->code;
    }

    public function getTrace()
    {
        return empty($this->trace)
            ? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)
            : $this->trace;
    }

    public function setCode(int $code) : self
    {
        $this->code = $code;
        return $this;
    }

    public function setFile($file) : self
    {
        $this->file = $file;
        return $this;
    }

    public function setLine(int $line) : self
    {
        $this->line = $line;
        return $this;
    }

    public function setMessage(string $message) : self
    {
        $this->message = $message;
        return $this;
    }

    public function setTrace($trace) : self
    {
        $this->trace = $trace;
        return $this;
    }

    public function thisIsException() : self
    {
        $this->exceptionFlag = true;
        return $this;
    }
}
