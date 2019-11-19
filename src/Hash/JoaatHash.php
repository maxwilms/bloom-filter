<?php

namespace maxwilms\BloomFilter\Hash;

class JoaatHash implements Hash
{
    public function hash($string)
    {
        return hexdec(hash('joaat', $string));
    }
}
