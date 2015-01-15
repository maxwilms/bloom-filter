<?php

namespace maxwilms\BloomFilter\Hash;

class FNVHash implements Hash
{

    public function hash($string)
    {
        $hash = 2166136261;

        foreach (str_split($string) as $chr) {
            $hash = ($hash << 1) + ($hash << 4) + ($hash << 7) + ($hash << 8) + ($hash << 24) + $hash ^ ord($chr);
        }

        return $hash & 0x0ffffffff;
    }

}
