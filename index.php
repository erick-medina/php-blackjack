<?php
declare(strict_types=1);
require "blackjack.php";
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$dealer = new Blackjack();
$player = new Blackjack();


?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blackjack PHP</title>
</head>

<body>
<form method="post">
    <button type="submit" name="start_button">START GAME!</button>
    <button type="submit" name="hit_button">HIT!</button>
    <button type="submit" name="stand_button">STAND!</button>
    <button type="submit" name="surrender_button">SURRENDER!</button>
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['start_button'])) { // click on start in order to get the 2 first cards
        $starting_game = $player->starting_game();
        echo "<h3>The cards of the player are: </h3>";
        echo "Card 1: ".$starting_game[0] ."<br/>";
        echo "Card 2: ".$starting_game[1] ."<br/>";
        $total_player_score = $starting_game[0] + $starting_game[1];
        $_SESSION['player_points'] = $total_player_score;
        echo "Total current score: ". $total_player_score;

        $starting_game = $dealer->starting_game();
        echo "<h3><br/>The cards of the dealer are: </h3>";
        echo "Card 1: ".$starting_game[0] ."<br/>";
        echo "Card 2: ".$starting_game[1] ."<br/>";
        $total_dealer_score = $starting_game[0] + $starting_game[1];
        $_SESSION['dealer_points'] = $total_dealer_score;
        echo "Total current score: ". $total_dealer_score;
    }

    if (isset($_POST['hit_button'])) {
        $hit_turn = $player->set_hit($_SESSION['player_points']);
        echo "Card number is : ". $hit_turn[0];
        $_SESSION['player_points'] = $hit_turn[1];
        echo "Total: ". $hit_turn[1];
    }

    if (isset($_POST['stand_button'])) {

        echo " the player total is : ". $_SESSION['player_points'];

        $stand_turn = $player->set_hit($_SESSION['dealer_points']);
        echo " <br/> the number is : ". $stand_turn[0];
        $_SESSION['dealer_points'] = $stand_turn[1];
        echo " the total is : ". $stand_turn[1];
    }

    if (isset($_POST['surrender_button'])) {

        echo " the player total is : ". $_SESSION['player_points'];
        echo " <br/> the dealer total is : ". $_SESSION['dealer_points'];
    }

}

?>

</body>

</html>




