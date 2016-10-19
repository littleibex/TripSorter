<?php

namespace PropertyFinder\BoardingCards;


use InvalidArgumentException;

class FlightBoardingCard extends BoardingCard
{

    protected $flightNo;
    protected $gateNo;
    protected $seatNo;
    protected $baggageDropCounterNo;

    /**
     * FlightBoardingCard constructor.
     *
     * Creates a Boarding Card for a flight.
     *
     * @param array $data [3] => Flight number
     *                    [4] => Gate number
     *                    [5] => Seat number
     *                    [6] => Ticket counter number for baggage drop (optional)
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->_setFlightNumber($data);
        $this->_setGateNumber($data);
        $this->_setSeatNumber($data);
        $this->_setBaggageDropCounterNumber($data);
    }

    /**
     * @return string Returns the flight number.
     */
    public function getFlightNumber()
    {
        return $this->flightNo;
    }

    /**
     * Sets the flight number of this card received
     * from the data in the constructor.
     *
     * @param array $data
     *
     * @throws InvalidArgumentException If the flight number is empty.
     */
    protected function _setFlightNumber(array $data)
    {
        if (isset($data[3]) && '' !== (string)$data[3]) {
            $this->flightNo = $data[3];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for flight: Flight number.');
        }
    }

    /**
     * @return string Returns the gate number for boarding the flight.
     */
    public function getGateNumber()
    {
        return $this->gateNo;
    }

    /**
     * Sets the gate number for boarding this flight
     * received from the data in the constructor.
     *
     * @param array $data
     *
     * @throws InvalidArgumentException If the gate number is empty.
     */
    protected function _setGateNumber(array $data)
    {
        if (isset($data[4]) && '' !== (string)$data[4]) {
            $this->gateNo = $data[4];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for flight: Gate number.');
        }
    }

    /**
     * @return string Returns the seat number on this flight.
     */
    public function getSeatNumber()
    {
        return $this->seatNo;
    }

    /**
     * Sets the seat number on the flight received
     * from the data in the constructor.
     *
     * @param array $data
     *
     * @throws InvalidArgumentException If the seat number is empty.
     */
    protected function _setSeatNumber(array $data)
    {
        if (isset($data[5]) && '' !== (string)$data[5]) {
            $this->seatNo = $data[5];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for flight: Seat number.');
        }
    }

    /**
     * @return string Returns the ticket counter number for baggage drop.
     */
    public function getBaggageDropCounterNumber()
    {
        return $this->baggageDropCounterNo;
    }

    /**
     * @return string Generates and returns a statement based on
     *                the baggage drop ticket counter number.
     */
    public function getBaggageDropStatement()
    {
        return
            $this->getBaggageDropCounterNumber()
                ? sprintf('Baggage drop at ticket counter %s.', $this->getBaggageDropCounterNumber())
                : 'Baggage will be automatically transferred from your last leg.';
    }

    /**
     * Sets the ticket counter number for baggage drop received from the
     * data in the constructor. If this is empty, then it is assumed
     * that the baggage will be automatically transferred from
     * the last leg.
     *
     * @param array $data
     */
    protected function _setBaggageDropCounterNumber(array $data)
    {
        $this->baggageDropCounterNo = isset($data[6]) ? $data[6] : '';
    }

    /**
     * @return string Returns a message indicating how to go from
     *                source to destination containing all the
     *                flight details.
     */
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
