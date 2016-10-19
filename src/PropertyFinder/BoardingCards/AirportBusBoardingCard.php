<?php

namespace PropertyFinder\BoardingCards;


class AirportBusBoardingCard extends BoardingCard
{

    protected $seatNo;

    /**
     * AirportBusBoardingCard constructor.
     *
     * Creates a Boarding Card for Airport Bus.
     *
     * @param array $data [3] => Seat Number (optional)
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->_setSeatNumber($data);
    }

    /**
     * @return string Returns the seat number on the bus.
     */
    public function getSeatNumber()
    {
        return $this->seatNo;
    }

    /**
     * @return string Generates and returns a statement based on
     *                the seat number value.
     */
    public function getSeatNumberStatement()
    {
        return $this->getSeatNumber() ? sprintf('Sit in seat %s.', $this->getSeatNumber()) : 'No seat assignment.';
    }

    /**
     * Sets the seat number on the bus received
     * from the data in the constructor.
     *
     * @param array $data
     */
    protected function _setSeatNumber(array $data)
    {
        $this->seatNo = isset($data[3]) ? $data[3] : '';
    }

    /**
     * @return string Returns a message on how to go from
     *                source to destination by this
     *                Airport Bus.
     */
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
