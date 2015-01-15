PHP Bloom filter
================

A [Bloom filter](https://en.wikipedia.org/wiki/Bloom_filter) is a probabilistic data structure, that tests whether an element is member of a set. 
It will always confirm if the element is member of the set. But false-positives are possible.

When to use Bloom filters
-------------------------

Use this data structure when you quickly need to confirm that a certain values does not exists in a large data set.
For example a certain row is not present on your database (e.g., IP address, username, email).

Installation
------------

First install [composer](https://getcomposer.org/).

Require the bloom filter via composer:
~~~
composer require maxwilms/bloom-filter
~~~

Now you are ready to use it!

Usage
-----

~~~
<?php

require_once('vendor/autoload.php');

use maxwilms\BloomFilter\BloomFilterGenerator;

// generate a bloom filter for 1000 elements with a probability of 1% for false positives
$bloomFilter = BloomFilterGenerator::generate(1000, 0.01); 

$bloomFilter->add('foo');
$bloomFilter->add('bar');
// ... add more

$bloomFilter->contains('foo'); // true - possibly in set
$bloomFilter->contains('baz'); // false - definitely not in set

~~~

TODO
----

more examples :)




