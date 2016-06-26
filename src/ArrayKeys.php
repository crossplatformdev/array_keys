<?php
namespace ArrayKeys;
use Exception;
/** 
 * @author Elías A. Angulo Klein <elias.angulo.klein(at)gmail.com>
 * @see https://github.com/crossplatformdev
 * @version nightly
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @copyright (c) Humankind, all of them (oh, and of course Dolphins too!). ☺
 */
class ArrayKeys {

    /**
     * Empty constructor. Some frameworks won't work without it. 
     */
    public function __construct() {
        
    }

    /**
     * Enhanced clone of the PHP standard function 'array_keys()'.
     * 
     * array_keys() returns the keys, numeric and string, from the array.
     * If the optional search_value is specified, then only the keys for that
     * value are returned. Otherwise, all the keys from the array are returned.
     * 
     * This function can also iterate over the input array recursively to retrieve
     * even all in-depth keys. 
     * @link http://php.net/manual/en/function.array-keys.php Official documentation.
 * @version 1.0
     * @param array $array The input array to search keys.
     * @param mixed $searchValue (Optional) If specified, then only keys containing these values are returned.
     *  It is null by default, which means that will return all indexes.
     * @param bool $strict (Optional) Determines if strict comparison (===) should be used during the search. It is false by default.
     * @param bool $expandArray (Optional) Only if this parameter is set to true, the function will act recursively.
     *  You may customize the next two parameters. Its default value is false.
     * @param int $depth (Optional) Current input array's depth level. Its default value is 0 (top level of $array).
     * @param int $MAX_DEPTH (Optional) Maximum depth iteration. Its default value is INF (bottom level of $array).
     * @param array $keys (Optional) An array containing keys to return. 
     * You can add the returning array to an existing one. Simply invoke this function
     *  like this "$your_array[] = my_array_keys(($array, $searchValue, $strict, $expandArray, $depth, $MAX_DEPTH, $your_array);".
     * @return array Containing keys.
     * @throws Exception General standard Exception exceptions with descriptive messages of the error.
     */
    function my_array_keys($array = array(), $searchValue = null, $strict = false, $expandArray = false, $depth = 0, $MAX_DEPTH = INF, $keys = array()) {
        //Stop condition    
        if ($depth == $MAX_DEPTH) {
            return $keys;
        }

        // Parameter checks to avoid possible misuses of the function.
        //'Yoda conditions' read as 'If it is false that $array is_array( )'
        if (false === is_array($array)) {
            throw new Exception('Variable $array must be of Array type.');
        }
        if (false === is_bool($strict)) {
            throw new Exception('Variable $strict must be boolean (true or false).');
        }
        if (false === is_bool($expandArray)) {
            throw new Exception('Variable $expandArray must be boolean (true or false).');
        }
        if (is_nan($MAX_DEPTH)) {
            throw new Exception('Variable $MAX_DEPTH must be 0 or greater.');
        }
        if ($depth < 0) {
            throw new Exception('Variable $depth must be 0 or greater.');
        }
        if ($depth > $MAX_DEPTH) {
            throw new Exception('Variable $depth must be greater than $MAX_DEPTH.');
        }
        //Condition to iterate recursively over and over until it evaluates as false.
        if ($depth < $MAX_DEPTH) {
            $depth += 1;
            //For each key in input array ge catch both $key and $value...
            foreach ($array as $key => $value) {

                // ... If there's a $searchValue, look for it.
                if (false === is_null($searchValue)) {

                    // ... And if strict mode is set to true, use triple equal comparisson.
                    if (true === $strict) {
                        if ($value === $searchValue) {
                            $keys[] = $key;
                        }
                    } else {
                        // otherwise, use normal comparisson.
                        if ($value == $searchValue) {
                            $keys[] = $key;
                        }
                    }
                } else {
                    // If there is not search value, just push the $key.
                    $keys[] = $key;
                }

                // If expand is true and $value is an array, we iterate recursively until reach desired depth
                if (true == $expandArray && is_array($array[$key])) {
                    $keys[$key] = my_array_keys($array[$key], $searchValue, $strict, $expandArray, $depth, $MAX_DEPTH, $keys);
                }
            }
        }

        return $keys;
    }

}
