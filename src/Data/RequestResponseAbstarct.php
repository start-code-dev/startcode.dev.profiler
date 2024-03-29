<?php

namespace Startcode\Profiler\Data;

use Startcode\CleanCore\Application;

abstract class RequestResponseAbstarct extends LoggerAbstract
{

    private ?Application $application = null;

    public function getApplication() : ?Application
    {
        return $this->application;
    }

    public function setApplication(Application $application) : self
    {
        $this->application = $application;
        return $this;
    }
}
