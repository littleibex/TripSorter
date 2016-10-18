<?php

namespace PropertyFinder\BoardingCards;


class AirportBusBoardingCard extends BoardingCard
{

    protected $seatNo;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->_setSeatNumber($data);
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
        $this->seatNo = isset($data[3]) ? $data[3] : '';
    }

    public function getMessage()
    {
        return sprintf(
            'Take the airport bus from %s to %s. %s',
            $this->getSource(),
            $this->getDestination(),
            $this->getSeatNumberStatement()
        );
    }
}
