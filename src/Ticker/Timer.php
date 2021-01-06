<?php

namespace Startcode\Profiler\Ticker;

class Timer
{

    /**
     * @var float
     */
    private $ended;

    /**
     * @var float
     */
    private $started;

    public function end() : self
    {
        $this->ended = microtime(true);
        return $this;
    }

    public function getElapsed() : float
    {
        return $this->ended - $this->started;
    }

    public function start() : self
    {
        $this->started = microtime(true);
        return $this;
    }
}
