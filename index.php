<?php

header('Content-Type: text/plain');

require 'vendor/autoload.php';

use PropertyFinder\CardReaders\CsvCardReader;
use PropertyFinder\Trip;

/** @var \PropertyFinder\BoardingCards\BoardingCard $card */

/**
 * @var CsvCardReader $cardReader Parses the input file to generate an array of boarding cards.
 */
$cardReader = new CsvCardReader('input.csv');

/**
 * @var Trip $trip Fetches the boarding cards from the $cardReader and sorts them to create a journey.
 *                 Looping through this $trip provides the legs of the journey to be able to
 *                 generate a description of how to complete the journey.
 */
$trip = new Trip($cardReader);


foreach ($trip as $i => $card) {
    echo ($i + 1) . '. ' . $card->getMessage() . PHP_EOL;
}
if (isset($i)) {
    echo ($i + 2) . '. You have arrived at your final destination.' . PHP_EOL;
}
