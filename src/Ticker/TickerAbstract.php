<?php

namespace Startcode\Profiler\Ticker;

abstract class TickerAbstract implements TickerInterface
{

    /**
     * @var int
     */
    private $totalElapsedTime;

    /**
     * @var array
     */
    private $data;

    public function getTotalElapsedTime() : int
    {
        return $this->totalElapsedTime;
    }

    public function getTotalNumQueries() : int
    {
        return $this->data === null
            ? 0
            : count($this->data);
    }

    public function end(string $uniqueId) : self
    {
        $this->data[$uniqueId]->getTimer()->end();
        $this->totalElapsedTime += $this->data[$uniqueId]->getTimer()->getElapsed();
        return $this;
    }

    public function getDataPart(string $uniqueId)
    {
        return $this->data[$uniqueId];
    }

    public function getDataFormatterInstance() : Formatter
    {
        return new Formatter();
    }

    public function getFormatted() : array
    {
        return [
            'total_number_of_queries' => $this->getTotalNumQueries(),
            'total_elapsed_time'      => $this->getDataFormatterInstance()->getFormattedTime($this->getTotalElapsedTime()),
            'queries'                 => $this->getQueries(),
        ];
    }

    public function getQueries() : array
    {
        if (count($this->getData()) > 0) {
            foreach($this->getData() as $data) {
                $queries[] = $data->getFormatted();
            }
        }
        return $queries ?? [];
    }

    public function start() : string
    {
        $formatter = $this->getDataFormatterInstance();
        $formatter
            ->setTimer((new Timer())->start());
        $this->data[$formatter->getUniqId()] = $formatter;
        return $formatter->getUniqId();
    }

    private function getData() : array
    {
        return $this->getTotalNumQueries() > 0
            ? $this->data
            : [];
    }
}
