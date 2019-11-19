<?php

namespace spec\maxwilms\BloomFilter\Hash;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JoaatHashSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('maxwilms\BloomFilter\Hash\JoaatHash');
    }

    function it_ensures_jooat_is_used()
    {
    	$this->hash('')->shouldReturn(0);
    	$this->hash('come')->shouldReturn(4083681540);
    	$this->hash('get')->shouldReturn(3199410796);
    	$this->hash('give')->shouldReturn(1203194894);
    }
}
