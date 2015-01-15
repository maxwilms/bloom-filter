<?php

namespace maxwilms\BloomFilter;

class BitField
{

    protected $length;

    protected $field;

    public function __construct($length)
    {
        $this->length = $length;
        $this->data = str_repeat(chr(0), ceil($this->length / 8));
    }

    /**
     * @param integer $bit set the bit
     * @throws \InvalidArgumentException
     */
    public function set($bit)
    {
        $this->guardAgainstBounds($bit);

        $index = (int)($bit / 8);

        $this->data[$index] = chr(ord($this->data[$index]) | (1 << $bit % 8));
    }

    /**
     * @param integer $bit check if bit is set
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function has($bit)
    {
        $this->guardAgainstBounds($bit);

        $index = (int)($bit / 8);

        return (ord($this->data[$index]) & (1 << $bit % 8)) === (1 << $bit % 8) ;
    }

    /**
     * @param $bit
     * @throws \InvalidArgumentException
     */
    protected function guardAgainstBounds($bit)
    {
        if ($bit < 0 || $bit >= $this->length || intval($bit) !== $bit) {
            throw new \InvalidArgumentException('Out of bounds.');
        }
    }

}
