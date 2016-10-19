<?php

namespace PropertyFinder\BoardingCards;

use InvalidArgumentException;

class BoardingCardFactory
{

    private function __construct()
    {
        // a factory constructor should never be invoked
    }

    /**
     * Boarding Card generation.
     *
     * @param array $data [0] => Mode of transportation.
     *
     * @throws InvalidArgumentException If the mode of transportation isn't "train",
     *                                  "flight" or "airport_bus".
     *
     * @return BoardingCard
     */
    public static function createBoardingCard(array $data)
    {
        switch ($data[0]) {
            case 'airport_bus':
                return new AirportBusBoardingCard($data);

            case 'train':
                return new TrainBoardingCard($data);

            case 'flight':
                return new FlightBoardingCard($data);

            default:
                throw new InvalidArgumentException('Invalid data. The mode of transportation must be set to "train", "flight" or "airport_bus".');
        }
    }
}
