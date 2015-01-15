<?php

namespace spec\maxwilms\BloomFilter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BitFieldSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith(100);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('maxwilms\BloomFilter\BitField');
    }

    function it_can_set_a_bit()
    {
        $this->set(10);
        $this->has(10)->shouldReturn(true);

        $this->set(0);
        $this->has(0)->shouldReturn(true);

        $this->set(99);
        $this->has(99)->shouldReturn(true);
    }

    function it_stores_zero_bits()
    {
        $this->has(0)->shouldReturn(false);
        $this->has(10)->shouldReturn(false);
        $this->has(99)->shouldReturn(false);
    }

    function it_assures_all_bits_are_zero()
    {
        $this->beConstructedWith(10);

        for ($i = 0; $i < 10; $i++) {
            $this->has($i)->shouldReturn(false);
        }

    }

    function it_guards_against_wrong_access()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSet(100);
        $this->shouldThrow('InvalidArgumentException')->duringSet(101);
        $this->shouldThrow('InvalidArgumentException')->duringHas(55.5);
    }

    function it_prevents_wrong_access()
    {
        $this->shouldThrow('InvalidArgumentException')->duringHas(-1);
        $this->shouldThrow('InvalidArgumentException')->duringHas(100);
        $this->shouldThrow('InvalidArgumentException')->duringHas(101);
    }

}
