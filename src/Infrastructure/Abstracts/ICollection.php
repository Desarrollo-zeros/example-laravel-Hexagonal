<?php
/**
 * Example-laravel-Hexagonal has static methods for inflecting text.
 *
 * example DDD architecture
 * use of hexagonal programming
 *
 * Hexagonal Architecture that allows us to develop and test our application in isolation from the framework,
 * the database, third-party packages and all those elements that are around our application
 *
 * @link https://github.com/Desarrollo-zeros/example-laravel-Hexagonal
 * @since  1.0
 * @author dev zeros  <wowzeros2@gmail.com>
 * @name ICollection
 * @file /src/Domain/Infrastructure/Abstracts/ICollection.php
 * @observations example ICollection domain entity
 *
 */

namespace Src\Infrastructure\Abstracts;

interface ICollection
{

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all() : array;


    /**
     * Get the average value of a given key.
     *
     * @param callable|string|null $callback
     * @return mixed
     */
    public function avg($callback = null);

    /**
     * Alias for the "avg" method.
     *
     * @param callable|string|null $callback
     * @return mixed
     */
    public function average($callback = null);

    /**
     * Get the median of a given key.
     *
     * @param string|array|null $key
     * @return mixed
     */
    public function median($key = null);

    /**
     * Get the mode of a given key.
     *
     * @param string|array|null $key
     * @return array|null
     */
    public function mode($key = null);

    /**
     * Dump the collection and end the script.
     *
     * @param mixed ...$args
     * @return void
     */
    public function dd(...$args);

    /**
     * Execute a callback over each item.
     *
     * @param callable $callback
     * @return $this
     */
    public function each(callable $callback);

    /**
     * Run a filter over each of the items.
     *
     * @param callable|null $callback
     * @return static
     */
    public function filter(callable $callback = null);

    /**
     * Filter items by the given key value pair.
     *
     * @param string $key
     * @param mixed $operator
     * @param mixed $value
     * @return static
     */
    public function where($key, $operator = null, $value = null);

    /**
     * Filter items by the given key value pair.
     *
     * @param string $key
     * @param mixed $values
     * @param bool $strict
     * @return static
     */
    public function whereIn($key, $values, $strict = false);

    /**
     * Filter items such that the value of the given key is between the given values.
     *
     * @param string $key
     * @param array $values
     * @return static
     */
    public function whereBetween($key, $values);

    /**
     * Get the first item from the collection passing the given truth test.
     *
     * @param callable|null $callback
     * @param mixed $default
     * @return mixed
     */
    public function first(callable $callback = null, $default = null);

    /**
     * Get an item from the collection by key.
     *
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Group an associative array by a field or using a callback.
     *
     * @param array|callable|string $groupBy
     * @param bool $preserveKeys
     * @return static
     */
    public function groupBy($groupBy, $preserveKeys = false);

    /**
     * Key an associative array by a field or using a callback.
     *
     * @param callable|string $keyBy
     * @return static
     */
    public function keyBy($keyBy);

    /**
     * Join all items from the collection using a string. The final items can use a separate glue string.
     *
     * @param string $glue
     * @param string $finalGlue
     * @return string
     */
    public function join($glue, $finalGlue = '');
    /**
     * Get the keys of the collection items.
     *
     * @return static
     */
    public function keys();

    /**
     * Get the max value of a given key.
     *
     * @param callable|string|null $callback
     * @return mixed
     */
    public function max($callback = null);

    /**
     * Get the min value of a given key.
     *
     * @param callable|string|null $callback
     * @return mixed
     */
    public function min($callback = null);

    /**
     * Push an item onto the end of the collection.
     *
     * @param mixed $value
     * @return $this
     */
    public function push($value);

    /**
     * Search the collection for a given value and return the corresponding key if successful.
     *
     * @param mixed $value
     * @param bool $strict
     * @return mixed
     */
    public function search($value, $strict = false);

    /**
     * Split a collection into a certain number of groups.
     *
     * @param int $numberOfGroups
     * @return static
     */
    public function split($numberOfGroups);

    /**
     * Sort through each item with a callback.
     *
     * @param callable|null $callback
     * @return static
     */
    public function sort(callable $callback = null);

    /**
     * Sort the collection using the given callback.
     *
     * @param callable|string $callback
     * @param int $options
     * @param bool $descending
     * @return static
     */
    public function sortBy($callback, $options = SORT_REGULAR, $descending = false);

    /**
     * Get the sum of the given values.
     *
     * @param callable|string|null $callback
     * @return mixed
     */
    public function sum($callback = null);

    /**
     * Take the first or last {$limit} items.
     *
     * @param int $limit
     * @return static
     */
    public function take($limit);

    /**
     * Return only unique items from the collection array.
     *
     * @param string|callable|null $key
     * @param bool $strict
     * @return static
     */
    public function unique($key = null, $strict = false);

    /**
     * Reset the keys on the underlying array.
     *
     * @return static
     */
    public function values();

    /**
     * Get the collection of items as a plain array.
     *
     * @return array
     */
    public function toArray();

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize();
    /**
     * Get the collection of items as JSON.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0);

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count();
    /**
     * Count the number of items in the collection using a given truth test.
     *
     * @param callable|null $callback
     * @return static
     */
    public function countBy($callback = null);

    /**
     * Add an item to the collection.
     *
     * @param mixed $item
     * @return $this
     */
    public function add($item);
    /**
     * Convert the collection to its string representation.
     *
     * @return string
     */
    public function __toString();

    /**
     * Dynamically access collection proxies.
     *
     * @param string $key
     * @return mixed
     *
     * @throws \Exception
     */
    public function __get($key);
}
