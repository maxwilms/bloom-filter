<?php

namespace maxwilms\BloomFilter\Hash;

interface Hash
{
    /**
     * @param $string
     * @return integer
     */
    public function hash($string);
}
