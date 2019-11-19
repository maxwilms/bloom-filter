<?php

namespace spec\maxwilms\BloomFilter;

use maxwilms\BloomFilter\StringBitField;
use maxwilms\BloomFilter\Hash\MultiHash;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BloomFilterSpec extends ObjectBehavior
{

    function let(StringBitField $bitField, MultiHash $multiHash)
    {
        $this->beConstructedWith($bitField, $multiHash);
    }

    function it_uses_multiHash_to_add_items(StringBitField $bitField, MultiHash $multiHash)
    {
        $multiHash->hash('123')->willReturn([1, 4, 8]);

        $bitField->set(1)->shouldBeCalled();
        $bitField->set(4)->shouldBeCalled();
        $bitField->set(8)->shouldBeCalled();

        $this->add('123');
    }

    function it_confirms_existence_of_valid_items(StringBitField $bitField, MultiHash $multiHash)
    {
        $multiHash->hash('my string')->willReturn([1, 2]);

        $bitField->has(1)->willReturn(true);
        $bitField->has(2)->willReturn(true);

        $this->contains('my string')->shouldReturn(true);
    }

    function it_denies_existence_of_items_not_in_set(StringBitField $bitField, MultiHash $multiHash)
    {
        $multiHash->hash('my string')->willReturn([1, 4]);

        $bitField->has(1)->willReturn(false);
        $bitField->has(4)->willReturn(true);

        $this->contains('my string')->shouldReturn(false);
    }
}
