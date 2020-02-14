<?php
session_start();
class Blackjack {

    public $score;

    public function starting_game() {

        $card_one = rand(1, 11);
        $card_two = rand(1, 11);
        return [$card_one, $card_two];
    }

    public function set_hit($current_score) {
        $one_random_card = rand(1, 11);
        $this->score = $one_random_card + $current_score;
        //$_session['playerPoints'] +=  $one_random_card;
        return [$one_random_card ,$this->score ];
    }

    public function set_stand($stand) {

    }
    function set_surrender($surrender) {

    }
}
