<?php

namespace PropertyFinder;

use Countable;
use Iterator;
use PropertyFinder\CardReaders\CardReader;

class Trip implements Iterator, Countable
{

    protected $cards;

    /**
     * Trip constructor.
     *
     * Creates a new Trip. The card reader provides a set of boarding
     * for a journey. This class can be used as an array to
     * iterate from the beginning to the end of the
     * journey. Each iteration returns a boarding
     * card.
     *
     * @param CardReader $reader
     */
    public function __construct(CardReader $reader)
    {
        $this->cards = $reader->getCards();

        TripSorter::sort($this->cards);
    }

    /**
     * Returns an array of boarding cards in the sorted order.
     *
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * Return the current element
     * @link  http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->cards);
    }

    /**
     * Move forward to next element
     * @link  http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->cards);
    }

    /**
     * Return the key of the current element
     * @link  http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->cards);
    }

    /**
     * Checks if current position is valid
     * @link  http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return key($this->cards) !== null;
    }

    /**
     * Rewind the Iterator to the first element
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->cards);
    }

    /**
     * Count elements of an object
     * @link  http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->cards);
    }
}
