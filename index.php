<?php

require 'vendor/autoload.php';

use PropertyFinder\CardReaders\CsvCardReader;
use PropertyFinder\Trip;

/** @var \PropertyFinder\BoardingCards\BoardingCard $card */

$cardReader = new CsvCardReader('input.csv');
$trip       = new Trip($cardReader);
?>

<ol>
    <?php foreach ($trip as $card) { ?>
        <li><?php echo htmlentities($card->getMessage()); ?></li>
    <?php } ?>
    <li>You have arrived at your final destination.</li>
</ol>
