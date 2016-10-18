<?php

namespace PropertyFinder\BoardingCards;

interface BoardingCardInterface
{

    public function getSource();

    public function getDestination();

    public function getMessage();
}
