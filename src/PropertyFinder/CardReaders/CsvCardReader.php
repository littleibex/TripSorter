<?php

namespace PropertyFinder\CardReaders;

use InvalidArgumentException;
use PropertyFinder\BoardingCards\BoardingCardFactory;

class CsvCardReader implements CardReader
{

    protected $file;

    /**
     * CsvCardReader constructor.
     *
     * Creates a reader for generating Boarding Cards from
     * a CSV file input.
     *
     * @param string $file Path to the CSV file input containing stack
     *                     of boarding cards for a single journey.
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Returns an array of boarding cards parsed from
     * the CSV input file.
     *
     * @return array
     */
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

    /**
     * Returns the path of the CSV file.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }
}
