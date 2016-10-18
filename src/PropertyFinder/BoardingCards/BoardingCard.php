<?php

namespace PropertyFinder\BoardingCards;


use InvalidArgumentException;

abstract class BoardingCard
{

    protected $source;
    protected $destination;

    public function __construct(array $data)
    {
        $this->_setSource($data);
        $this->_setDestination($data);
    }

    public function getSource()
    {
        return $this->source;
    }

    protected function _setSource(array $data)
    {
        if (isset($data[1]) && '' !== (string)$data[1]) {
            $this->source = $data[1];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for card: Source.');
        }
    }

    public function getDestination()
    {
        return $this->destination;
    }

    protected function _setDestination(array $data)
    {
        if (isset($data[2]) && '' !== (string)$data[2]) {
            $this->destination = $data[2];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for card: Destination.');
        }
    }

    abstract public function getMessage();
}
