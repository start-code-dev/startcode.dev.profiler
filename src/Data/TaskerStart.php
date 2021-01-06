<?php

namespace Startcode\Profiler\Data;

class TaskerStart extends LoggerAbstract
{

    private $options;

    public function getRawData() : array
    {
        return [
            'timestamp' => $this->getJsTimestamp(),
            'datetime'  => date('Y-m-d H:i:s'),
            'options'   => json_encode($this->options),
            'hostname'  => gethostname(),
            'pid'       => getmypid()
        ];
    }

    public function setOptions($options) : self
    {
        $this->options = $options;
        return $this;
    }
}
