<?php

namespace maxwilms\BloomFilter;

use maxwilms\BloomFilter\Hash\MultiHash;

class BloomFilterGenerator
{

    /**
     * @param $expectedValues
     * @param float $falsePositiveProbability
     * @return BloomFilter
     */
    public static function generate($expectedValues, $falsePositiveProbability = 0.1)
    {
        $sizeOfBitField = (int) ceil(($expectedValues * log($falsePositiveProbability)) / log(1 / (pow(2, log(2)))));
        $hashFunctions = (int) ($sizeOfBitField / $expectedValues * log(2));

        $multiHash = new MultiHash();

        $multiHash->setUpperBound($sizeOfBitField);
        $multiHash->setHashCount($hashFunctions);

        return new BloomFilter(
            new StringBitField($sizeOfBitField),
            $multiHash
        );
    }

}
