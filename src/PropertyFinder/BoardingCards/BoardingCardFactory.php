<?php

namespace PropertyFinder\BoardingCards;

use InvalidArgumentException;

class BoardingCardFactory
{

    private function __construct()
    {

    }

    public static function createBoardingCard(array $data)
    {
        switch ($data[0]) {
            case 'train':
                return new TrainBoardingCard($data);
                break;

            default:
                throw new InvalidArgumentException('Invalid data. The mode of transportation must be set to "train", "flight" or "airport_bus".');
        }
    }
}
