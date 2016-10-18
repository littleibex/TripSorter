<?php

namespace PropertyFinder\BoardingCards;

class TrainBoardingCard implements BoardingCardInterface
{

    protected $source;
    protected $destination;

    protected $trainNumber;
    protected $seatNumber;

    public function __construct(array $data)
    {
        $this->source      = $data[1];
        $this->destination = $data[2];
        $this->trainNumber = $data[3];
        $this->seatNumber  = $data[4];
    }

    public function getTrainNumber()
    {
        return $this->trainNumber;
    }

    public function getMessage()
    {
        return sprintf(
            'Take train %s from %s to %s. %s',
            $this->trainNumber,
            $this->getSource(),
            $this->getDestination(),
            $this->getSeatNumberStatement()
        );
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function getSeatNumberStatement()
    {
        return $this->getSeatNumber() ? sprintf('Sit in seat %s.', $this->getSeatNumber()) : 'No seat assignment.';
    }

    public function getSeatNumber()
    {
        return $this->seatNumber;
    }
}
