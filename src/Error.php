<?php

namespace Startcode\Profiler;

class Error extends ErrorAbstract
{

    public function handle(int $errno, string $errstr, string $errfile, int $errline)
    {
        $this->getErrorData()
            ->setCode($errno)
            ->setMessage($errstr)
            ->setFile($this->filterFilePath($errfile))
            ->setLine($errline);
        $this
            ->display()
            ->log();
    }
}
