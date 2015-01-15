<?php

namespace spec\maxwilms\BloomFilter\Hash;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DJBX33XSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('maxwilms\BloomFilter\Hash\DJBX33X');
    }

    function it_hashes_strings()
    {
        $this->hash('ttuU')->shouldReturn(2087938565);
        $this->hash('come')->shouldReturn(2087770241);
        $this->hash('get')->shouldReturn(193411891);
        $this->hash('give')->shouldReturn(2087629624);
    }
}
