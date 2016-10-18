<?php

namespace PropertyFinder\BoardingCards;


class TrainBoardingCard extends BoardingCard
{

    protected $trainNo;
    protected $seatNo;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->_setTrainNumber($data);
        $this->_setSeatNumber($data);
    }

    public function getTrainNumber()
    {
        return $this->trainNo;
    }

    protected function _setTrainNumber(array $data)
    {
        $this->trainNo = isset($data[3]) ? $data[3] : '';
    }

    public function getSeatNumber()
    {
        return $this->seatNo;
    }

    public function getSeatNumberStatement()
    {
        return $this->getSeatNumber() ? sprintf('Sit in seat %s.', $this->getSeatNumber()) : 'No seat assignment.';
    }

    protected function _setSeatNumber(array $data)
    {
        $this->seatNo = isset($data[4]) ? $data[4] : '';
    }

    public function getMessage()
    {
        return sprintf(
            'Take train %s from %s to %s. %s',
            $this->getTrainNumber(),
            $this->getSource(),
            $this->getDestination(),
            $this->getSeatNumberStatement()
        );
    }
}
