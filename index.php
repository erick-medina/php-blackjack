<?php

declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Blackjack {
    public $hit;

    public function set_hit() {
        $random_array = [];
        for ($i = 0; $i < 1; $i++) {
            $value = rand(1, 11);
            array_push($random_array, $value);
        }
        return implode($random_array);
    }

    function set_stand($stand) {

    }
    function set_surrender($surrender) {

    }
}
$blackjack = new Blackjack();
$blackjack -> set_hit();

require "blackjack.php";

?>
