<?php

namespace maxwilms\BloomFilter;

class IntBitField
{
    const C = 32; // on 64-bit machines this value can be 64, on 32-bit it needs to be 32.
    protected $length;
    protected $data;

    public function __construct($length)
    {
        $this->length = $length;

        $this->data = [];
        $cells = ceil($this->length / self::C);
        for ($i = 0; $i < $cells; $i++) {
            $this->data[$i] = 0;
        }
    }

    /**
     * @param integer $bit set the bit
     * @throws \InvalidArgumentException
     */
    public function set($bit)
    {
        $this->guardAgainstBounds($bit);

        $index = (int)($bit / self::C);

        $this->data[$index] = $this->data[$index] | (1 << $bit % self::C);
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

    /**
     * @param integer $bit check if bit is set
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function has($bit)
    {
        $this->guardAgainstBounds($bit);

        $index = (int)($bit / self::C);

        return ($this->data[$index] & (1 << $bit % self::C)) !== 0;
    }
}
