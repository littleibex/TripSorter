<?php

namespace PropertyFinder\CardReaders;

use InvalidArgumentException;
use PropertyFinder\BoardingCards\BoardingCardFactory;

class CsvCardReader implements CardReader
{

    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function getCards()
    {
        $cards = [];

        if (($handle = @fopen($this->getFile(), "r")) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                $cards[] = BoardingCardFactory::createBoardingCard($data);
            }
            fclose($handle);
        } else {
            throw new InvalidArgumentException('Failed to open CSV input file.');
        }

        return $cards;
    }

    public function getFile()
    {
        return $this->file;
    }
}
