<?php

namespace spec\maxwilms\BloomFilter\Hash;

use maxwilms\BloomFilter\Hash\Hash;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MultiHashSpec extends ObjectBehavior
{

    function let(Hash $hashOne, Hash $hashTwo)
    {
        $this->beConstructedWith($hashOne, $hashTwo);
    }

    function it_returns_an_empty_array_for_one_round()
    {
        $this->setHashCount(0);
        $this->hash('myString')->shouldReturn([]);
    }

    function it_generates_one_hash(Hash $hashOne, Hash $hashTwo)
    {
        $this->setHashCount(1);
        $hashOne->hash('foobar')->willReturn(1);
        $hashTwo->hash('foobar')->willReturn(2);

        // hash(i) = (a + b * i ) % m
        $this->hash('foobar')->shouldReturn([(1 + 2 * 1)]);
    }

    function it_generates_two_hash_values(Hash $hashOne, Hash $hashTwo)
    {
        $this->setHashCount(2);
        $hashOne->hash('foobar')->willReturn(1);
        $hashTwo->hash('foobar')->willReturn(2);

        $this->hash('foobar')->shouldReturn([3, 5]);
    }

    function it_generates_three_hash_values(Hash $hashOne, Hash $hashTwo)
    {
        $this->setHashCount(3);
        $hashOne->hash('foobar')->willReturn(1);
        $hashTwo->hash('foobar')->willReturn(2);

        $this->hash('foobar')->shouldReturn([3, 5, 7]);
    }

    function it_applies_modulo_on_hash(Hash $hashOne, Hash $hashTwo)
    {
        $this->setHashCount(1);
        $this->setUpperBound(10);
        $hashOne->hash('foobar')->willReturn(100);
        $hashTwo->hash('foobar')->willReturn(201);

        // hash(i) = (a + b * i ) % m
        // hash(1) = (100 + 201 * 1) % 10@
        //         = 301 % 10
        //         = 1
        $this->hash('foobar')->shouldReturn([1]);
    }

}
