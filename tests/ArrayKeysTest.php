<?php

namespace ArrayKeys;

require_once '../src/ArrayKeys.php';

use \phpunit\framework\TestCase;

/**
 * @author Elías A. Angulo Klein <elias.angulo.klein(at)gmail.com>
 * @version nightly
 * @see https://github.com/crossplatformdev
 * 
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @copyright (c) Humankind, all of them (oh, and of course Dolphins too!). ☺
 */
class ArrayKeysTest extends TestCase {

    /**
     *
     * @var ArrayKeys Our instance to test.
     */
    protected $arrayKeys = null;

    /**
     * Initialices the object.
     */
    protected function setUp() {
        $this->arrayKeys = new ArrayKeys();
    }

    /**
     * Tests the first example provided by PHP documentation.
     * @link http://php.net/manual/en/function.array-keys.php Official documentation.
     */
    public function test1stExample() {
        $array = array(0 => 100, "color" => "red");
        $a = print_r(array_keys($array));
        $b = print_r($this->arrayKeys->my_array_keys($array));
        $this->assertEquals($a, $b);
    }

    /**
     * Tests the second example provided by PHP documentation.
     * @link http://php.net/manual/en/function.array-keys.php Official documentation.
     */
    public function test2ndExample() {
        $array = array("blue", "red", "green", "blue", "blue");
        $a = print_r(array_keys($array, "blue"));
        $b = print_r($this->arrayKeys->my_array_keys($array, "blue"));
        $this->assertEquals($a, $b);
    }

    /**
     * Tests the third example provided by PHP documentation.
     * @link http://php.net/manual/en/function.array-keys.php Official documentation.
     */
    public function test2Example() {
        $array = array("color" => array("blue", "red", "green"),
            "size" => array("small", "medium", "large"));
        $a = print_r(array_keys($array));
        $b = print_r($this->arrayKeys->my_array_keys($array));
        $this->assertEquals($a, $b);
    }

}
