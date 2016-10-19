<?php

namespace PropertyFinder;

use PropertyFinder\BoardingCards\BoardingCard;

class TripSorter
{

    public static function sort(array &$cards)
    {
        if (!$cards) {
            return;
        }

        $sources      = [];
        $destinations = [];

        /** @var BoardingCard $card */
        foreach ($cards as $card) {
            $sources[]      = $card->getSource();
            $destinations[] = $card->getDestination();
        }

        asort($sources);
        asort($destinations);

        $map   = [];
        $start = null;
        $end   = null;

        while (null !== ($sourceKey = key($sources)) && null !== ($destinationKey = key($destinations))) {
            $sourceValue      = current($sources);
            $destinationValue = current($destinations);

            if ($sourceValue === $destinationValue) {
                $map[$destinationKey] = $sourceKey;

                next($sources);
                next($destinations);
            } else {
                $peekSourceValue = next($sources);
                false === $peekSourceValue ? end($sources) : prev($sources);

                $peekDestinationValue = next($destinations);
                false === $peekDestinationValue ? end($destinations) : prev($destinations);

                if ($sourceValue !== $peekDestinationValue) {
                    $start = $sourceKey;
                    unset($sources[$sourceKey]);
                }

                if ($destinationValue !== $peekSourceValue) {
                    $end = $destinationKey;
                    unset($destinations[$destinationKey]);
                }
            }
        }

        if (null === $start) {
            end($map);
            $start = key($map);
        }

        if (null === $end) {
            $end = end($map);
        }

        while ($start !== $end) {
            $sortedCards[] = $cards[$start];
            $start         = $map[$start];
        }

        $sortedCards[] = $cards[$end];

        $cards = $sortedCards;
    }
}
