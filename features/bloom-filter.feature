Feature: BloomFilter
  In order to confirm that an element is not member of a set
  As a developer
  I need a very fast filter

  Scenario: BloomFilter confirms a value is in set
    Given a BloomFilter for "2" elements with probability ".01" for a false-positive
    When I insert "foo"
    And I insert "bar"
    Then it should confirm "foo" is in set

  Scenario: Bloom Filter confirms a value is not in set
    Given a BloomFilter for "2" elements with probability ".001" for a false-positive
    When I insert "foo"
    And I insert "bar"
    Then it may confirm "baz" is not in set
