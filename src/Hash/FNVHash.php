<?php

namespace maxwilms\BloomFilter\Hash;

class FNVHash implements Hash
{

    public function hash($string)
    {
        return hexdec(hash('fnv132', $string));
    }

}
