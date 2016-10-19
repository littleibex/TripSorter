<?php

namespace PropertyFinder\BoardingCards;


use InvalidArgumentException;

class TrainBoardingCard extends BoardingCard
{

    protected $trainNo;
    protected $seatNo;

    /**
     * TrainBoardingCard constructor.
     *
     * Creates a Boarding Card for a train.
     *
     * @param array $data [3] => Train number.
     *                    [4] => Seat number on the train (optional).
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->_setTrainNumber($data);
        $this->_setSeatNumber($data);
    }

    /**
     * @return string Returns the train number of this card.
     */
    public function getTrainNumber()
    {
        return $this->trainNo;
    }

    /**
     * Sets the train number of this leg received
     * from the data in the constructor.
     *
     * @param array $data
     *
     * @throws InvalidArgumentException If the train number is empty.
     */
    protected function _setTrainNumber(array $data)
    {
        if (isset($data[3]) && '' !== (string)$data[3]) {
            $this->trainNo = $data[3];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for train: Train number.');
        }
    }

    /**
     * @return string Returns the seat number on this train.
     */
    public function getSeatNumber()
    {
        return $this->seatNo;
    }

    /**
     * @return string Generates and returns a string about the seat number.
     */
    public function getSeatNumberStatement()
    {
        return $this->getSeatNumber() ? sprintf('Sit in seat %s.', $this->getSeatNumber()) : 'No seat assignment.';
    }

    /**
     * Sets the seat number on this train from the data
     * received in the constructor.
     *
     * @param array $data
     */
    protected function _setSeatNumber(array $data)
    {
        $this->seatNo = isset($data[4]) ? $data[4] : '';
    }

    /**
     * @return string Returns a message indicating how to go from
     *                source to destination containing all the
     *                details of this train.
     */
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
