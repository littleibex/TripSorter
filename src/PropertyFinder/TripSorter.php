<?php

namespace PropertyFinder;

use PropertyFinder\BoardingCards\BoardingCardInterface;

class TripSorter
{

    protected $cards;
    protected $prev;
    protected $next;

    public function __construct()
    {
        $this->prev = [];
        $this->next = [];
    }

    public function sort(array &$cards)
    {
        if (!$cards) {
            return;
        }

        $this->cards = $cards;

        $pivot = reset($this->cards);
        $this->populatePreviousCards($pivot);
        $this->populateNextCards($pivot);

        $cards = array_merge(array_reverse($this->prev), [$pivot], $this->next);

        $this->reset();
    }

    protected function populatePreviousCards(BoardingCardInterface $pivotCard)
    {
        /** @var BoardingCardInterface $card */
        foreach ($this->cards as $key => $card) {
            if ($card->getDestination() === $pivotCard->getSource()) {
                $this->prev[] = $card;
                unset($this->cards[$key]);
                $this->populatePreviousCards($card);
                break;
            }
        }
    }

    protected function populateNextCards(BoardingCardInterface $pivotCard)
    {
        /** @var BoardingCardInterface $card */
        foreach ($this->cards as $key => $card) {
            if ($card->getSource() === $pivotCard->getDestination()) {
                $this->next[] = $card;
                unset($this->cards[$key]);
                $this->populateNextCards($card);
                break;
            }
        }
    }

    protected function reset()
    {
        unset($this->cards);
        unset($this->prev);
        unset($this->next);
    }
}
