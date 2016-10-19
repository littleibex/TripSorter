<?php

namespace PropertyFinder\BoardingCards;


use InvalidArgumentException;

abstract class BoardingCard
{

    protected $source;
    protected $destination;

    /**
     * BoardingCard constructor.
     *
     * Creates a new Boarding Card. The $data must contain
     * source and destination of this leg.
     *
     * @param array $data [1] => Source of the leg
     *                    [2] => Destination of the leg
     */
    public function __construct(array $data)
    {
        $this->_setSource($data);
        $this->_setDestination($data);
    }

    /**
     * @return string Returns the starting point of this leg
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Sets the starting point of this leg received
     * from the data in the constructor. This
     * is a required field.
     *
     * @param array $data
     *
     * @throws InvalidArgumentException
     */
    protected function _setSource(array $data)
    {
        if (isset($data[1]) && '' !== (string)$data[1]) {
            $this->source = $data[1];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for card: Source.');
        }
    }

    /**
     * @return string Returns the destination of this leg
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Sets the destination of this leg received
     * from the data in the constructor. This
     * is a required field.
     *
     * @param array $data
     *
     * @throws InvalidArgumentException
     */
    protected function _setDestination(array $data)
    {
        if (isset($data[2]) && '' !== (string)$data[2]) {
            $this->destination = $data[2];
        } else {
            throw new InvalidArgumentException('Invalid data. Missing required field for card: Destination.');
        }
    }

    /**
     * This method returns a string explaining how to
     * reach from the source to destination with
     * all the relevant details of this
     * boarding card.
     *
     * @return string
     */
    abstract public function getMessage();
}
