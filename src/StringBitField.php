<?php

namespace maxwilms\BloomFilter;

class StringBitField implements BitField
{

    protected $length;

    protected $data;

    const C = 8;

    public function __construct($length)
    {
        $this->length = $length;
        $this->data = str_repeat(chr(0), ceil($this->length / self::C));
    }

    /**
     * @param integer $bit set the bit
     * @throws \InvalidArgumentException
     */
    public function set($bit)
    {
        $this->guardAgainstBounds($bit);

        $index = (int)($bit / self::C);

        $this->data[$index] = chr(ord($this->data[$index]) | (1 << $bit % self::C));
    }

    /**
     * @param integer $bit check if bit is set
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function has($bit)
    {
        $this->guardAgainstBounds($bit);

        $index = (int)($bit / self::C);

        return (ord($this->data[$index]) & (1 << $bit % self::C)) === (1 << $bit % self::C) ;
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
