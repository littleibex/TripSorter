<?php

//header('Content-Type: text/plain');

$test;
var_dump((string)$test);
die();

$arr   = [];
$pivot = reset($arr);
$test  = array_merge(array_reverse([]), [$pivot], []);

var_dump($pivot);
var_dump($test);

die();

/** @var Card $card */
class Card
{

    public $start;
    public $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end   = $end;
    }
}

$cards = [
    new Card('d', 'c'),
    new Card('a', 'h'),
    new Card('b', 'd'),
    new Card('h', 'b'),
    new Card('c', 'e'),
];

$next = [];
$prev = [];

function getPrevious($start)
{
    global $cards;
    global $prev;
    foreach ($cards as $key => $card) {
        if ($card->end === $start) {
            $prev[] = $card;
            unset($cards[$key]);
            getPrevious($card->start);
            break;
        }
    }
}

function getNext($end)
{
    global $cards;
    global $next;
    foreach ($cards as $key => $card) {
        if ($card->start === $end) {
            $next[] = $card;
            unset($cards[$key]);
            getNext($card->end);
            break;
        }
    }
}

$card = reset($cards);
getPrevious($card->start);
getNext($card->end);

$route = array_merge(array_reverse($prev), [$card], $next);

print_r($route);

/*
train,Madrid,Barcelona,78A,45B
airport_bus,Barcelona,Gerona Airport,
flight,Gerona Airport,Stockholm,SK455,3A,344
flight,Stockholm,New York JFK,SK22,7B,
*/
