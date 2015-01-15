<?php

namespace maxwilms\BloomFilter;

use maxwilms\BloomFilter\Hash\MultiHash;

class BloomFilter
{

    protected $bitField;

    protected $multiHash;

    public function __construct(BitField $bitField, MultiHash $multiHash)
    {
        $this->bitField = $bitField;
        $this->multiHash = $multiHash;
    }

    /**
     * @param string $item add item to set
     */
    public function add($item)
    {
        foreach ($this->multiHash->hash($item) as $bit) {
            $this->bitField->set($bit);
        }
    }

    /**
     * @param string $item
     * @return bool "possibly in set" or "definitely not in set"
     */
    public function contains($item)
    {
        foreach ($this->multiHash->hash($item) as $bit) {
            if (!$this->bitField->has($bit)) {
                return false;
            }
        }

        return true;
    }

}
