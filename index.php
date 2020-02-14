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

<?php
$prod_qty = '1';
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
        echo "Card given is : ". $hit_turn[0];
        $_SESSION['player_points'] = $hit_turn[1];
        echo "</br> Total: ". $hit_turn[1];

        if ($_SESSION['player_points'] > 21) {
            echo '<h3></br>' . 'You lost! </h3>';
        }
    }

    if (isset($_POST['stand_button'])) {
        $prod_qty = '0';
        echo " Player's score is : ". $_SESSION['player_points'];

        $stand_turn = $player->set_hit($_SESSION['dealer_points']);
        echo " <br/> Card given is: ". $stand_turn[0];
        $_SESSION['dealer_points'] = $stand_turn[1];
        echo "</br> Dealer's score is: ". $stand_turn[1];

        if ($_SESSION['dealer_points'] > 21) {
            echo '<h3></br>' . 'You lost! </h3>';
        }
    }

    if (isset($_POST['surrender_button'])) {

        echo "Player's total is : ". $_SESSION['player_points'];
        echo "<br/> Dealer's total is : ". $_SESSION['dealer_points'];
        session_destroy(); // to reset all the sessions so a new game can be started
    }
}

?>

<form method="post">
    <button type="submit" class="btn-1" name="start_button">START GAME!</button>
    <button type="submit" class="btn-1" name="hit_button" <?php if ($prod_qty == '0'){ ?> disabled <?php  } ?> > HIT!</button>
    <button type="submit" class="btn-1" name="stand_button">STAND!</button>
    <button type="submit" class="btn-1" name="surrender_button">SURRENDER!</button>
</form>


</body>

<style>
    body {
        background: url("https://ie1-gfebf.cdnppb.net/mexchangeblackjack/turbo/32/assets/gameView/tableBackground.png?v32");
        color: aliceblue;
        text-align: center;
        font-size: 25px;
    }
    .btn-1 {
        border: 1px solid #3498db;
        background: none;
        padding: 10px 20px;
        font-size: 20px;
        font-family: "DejaVu Sans";
        cursor: pointer;
        margin: 10px;
        transition: 0.8s;
        position: relative;
        overflow: hidden;
        color: #fff;

    .btn-1:hover {
        color: #fff;
    }
    .btn-1::before{
        content: "";
        position: absolute;
        width: 100%;
        height: 0%;
        background: #3498db;
        z-index: -1;
        transition: 0.8s;
    }
    }
</style>

</html>
