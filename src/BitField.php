<?php

namespace maxwilms\BloomFilter;

interface BitField
{
    public function __construct($length);

    /**
     * @param integer $bit set the bit
     * @throws \InvalidArgumentException
     */
    public function set($bit);

    /**
     * @param integer $bit check if bit is set
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function has($bit);

}
