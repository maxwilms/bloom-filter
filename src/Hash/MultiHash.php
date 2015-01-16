<?php

namespace maxwilms\BloomFilter\Hash;

class MultiHash
{

    protected $hashOne;

    protected $hashTwo;

    protected $upperBound;

    protected $hashCount;

    public function __construct(Hash $hashOne, Hash $hashTwo)
    {
        $this->hashOne = $hashOne;
        $this->hashTwo = $hashTwo;

        $this->upperBound = 0x0ffffffff;
        $this->hashCount = 3;
    }

    public function setUpperBound($upperBound)
    {
        $this->upperBound = $upperBound;
    }

    public function setHashCount($hashCount)
    {
        $this->hashCount = $hashCount;
    }

    /**
     * hash(i) = (a + b * i ) % m
     *
     * @param $string
     * @return array
     */
    public function hash($string)
    {
        $hashes = [];

        $a = $this->hashOne->hash($string);
        $b = $this->hashTwo->hash($string);

        for ($i = 1; $i <= $this->hashCount; $i++) {
            $hashes[] = ($a + $b * $i) % $this->upperBound;
        }

        return $hashes;
    }

}
