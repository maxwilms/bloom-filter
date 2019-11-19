<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use maxwilms\BloomFilter\BloomFilter;
use maxwilms\BloomFilter\BloomFilterGenerator;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    /**
     * @var BloomFilter
     */
    protected $bloomFilter;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
    

    /**
     * @Given a BloomFilter for :elements elements with probability :probability for a false-positive
     */
    public function aBloomfilterForElementsWithProbabilityForAFalsePositive($elements, $probability)
    {
        $this->bloomFilter = BloomFilterGenerator::generate($elements, $probability);
    }

    /**
     * @When I insert :item
     */
    public function iInsert($item)
    {
        $this->bloomFilter->add($item);
    }

    /**
     * @Then it should confirm :item is in set
     */
    public function itShouldConfirmIsInSet($item)
    {
        if (!$this->bloomFilter->contains($item)) {
            throw new Exception("$item is not in set!");
        }
    }

    /**
     * @Then it should confirm :item is not in set
     */
    public function itShouldConfirmIsNotInSet($item)
    {
        if ($this->bloomFilter->contains($item)) {
            throw new Exception("$item is in set");
        }
    }

    /**
     * @Given /^I serialize and unserialize$/
     */
    public function iSerializeAndUnserialize()
    {
        $serialized = serialize($this->bloomFilter);
        $this->bloomFilter = unserialize($serialized);
    }


}
