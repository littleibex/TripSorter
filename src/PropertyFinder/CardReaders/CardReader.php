<?php

namespace PropertyFinder\CardReaders;

interface CardReader
{

    /**
     * Returns an array of boarding cards.
     *
     * @return array
     */
    public function getCards();
}
