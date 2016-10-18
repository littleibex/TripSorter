<?php

namespace PropertyFinder\BoardingCards;


use InvalidArgumentException;

class FlightBoardingCard extends BoardingCard
{

    protected $flightNo;
    protected $gateNo;
    protected $seatNo;
    protected $baggageDropCounterNo;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->_setFlightNumber($data);
        $this->_setGateNumber($data);
        $this->_setSeatNumber($data);
        $this->_setBaggageDropCounterNumber($data);
    }

    public function getFlightNumber()
    {
        return $this->flightNo;
    }

    protected function _setFlightNumber(array $data)
    {
        if (isset($data[3]) && '' !== (string)$data[3]) {
            $this->flightNo = $data[3];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for flight: Flight number.');
        }
    }

    public function getGateNumber()
    {
        return $this->gateNo;
    }

    protected function _setGateNumber(array $data)
    {
        if (isset($data[4]) && '' !== (string)$data[4]) {
            $this->gateNo = $data[4];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for flight: Gate number.');
        }
    }

    public function getSeatNumber()
    {
        return $this->seatNo;
    }

    protected function _setSeatNumber(array $data)
    {
        if (isset($data[5]) && '' !== (string)$data[5]) {
            $this->seatNo = $data[5];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for flight: Seat number.');
        }
    }

    public function getBaggageDropCounterNumber()
    {
        return $this->baggageDropCounterNo;
    }

    public function getBaggageDropStatement()
    {
        return
            $this->getBaggageDropCounterNumber()
                ? sprintf('Baggage drop at ticket counter %s.', $this->getBaggageDropCounterNumber())
                : 'Baggage will be automatically transferred from your last leg.';
    }

    protected function _setBaggageDropCounterNumber(array $data)
    {
        $this->baggageDropCounterNo = isset($data[6]) ? $data[6] : '';
    }

    public function getMessage()
    {
        return sprintf(
            'From %s, take flight %s to %s. Gate %s, seat %s. %s',
            $this->getSource(),
            $this->getFlightNumber(),
            $this->getDestination(),
            $this->getGateNumber(),
            $this->getSeatNumber(),
            $this->getBaggageDropStatement()
        );
    }
}
