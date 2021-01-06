<?php

namespace Startcode\Profiler\Data;

class TaskerEnd extends LoggerAbstract
{

    private $type;

    public function getRawData() : array
    {
        return [
            'type'         => $this->type,
            'elapsed_time' => $this->getElapsedTime(),
        ];
    }

    public function setType($type) : self
    {
        $this->type = $type;
        return $this;
    }
}
