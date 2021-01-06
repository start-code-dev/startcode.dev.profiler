<?php

namespace Startcode\Profiler\Ticker;

class Formatter
{

    /**
     * @var Timer
     */
    private $timer;

    /**
     * @var string
     */
    private $uniqid;

    public function getFormatted() : array
    {
        return [
            'elapsed_time' => $this->getFormattedTime($this->getTimer()->getElapsed()),
        ];
    }

    public function getTimer() : Timer
    {
        return $this->timer;
    }

    public function getUniqId() : string
    {
        if ($this->uniqid === null) {
            $this->uniqid = uniqid(null, true);
        }
        return $this->uniqid;
    }

    public function setTimer(Timer $timer) : self
    {
        $this->timer = $timer;
        return $this;
    }

    public function getFormattedTime(float $microtime) : string
    {
        return sprintf("%3f ms", $microtime * 1000);
    }
}
