<?php

declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Blackjack {
    public $hit;

    public function set_hit() {
        for ($i = 0; $i < 2; $i++) {
            $value = $this-> hit = rand(1, 11);
            $randArray[] = $value ;
            var_dump($randArray);
        }
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
