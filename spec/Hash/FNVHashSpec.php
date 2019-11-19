<?php

namespace spec\maxwilms\BloomFilter\Hash;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FNVHashSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('maxwilms\BloomFilter\Hash\FNVHash');
    }

    function it_hashes_strings()
    {
        $this->hash('')->shouldReturn(2166136261);
        $this->hash('come')->shouldReturn(3670383649);
        $this->hash('get')->shouldReturn(646772355);
        $this->hash('give')->shouldReturn(818645658);
    }
}
