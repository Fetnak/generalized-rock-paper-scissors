<?php

include 'game.php';

$moves = $argv;
array_shift($moves);

$game = new Game($moves);

$menuMoves = $game->generateMenu();

while(true) {
    echo "\n\n";
    $move = $game->makeMove();
    echo sprintf("HMAC: %s \n", $move["hmac"]);
    echo $menuMoves;
    echo "Enter your move: ";
    $input = fgets(STDIN);

    if ($input === "?\n") {
        echo $game->generateWinTable();
        continue;
    } else {
        $input = (int)$input - 1;
        if(!($input >= 0 && $input < $game->getCount())) {
            break;
        }
    }

    echo sprintf("Your move: %s\n", $game->getMove($input));
    echo sprintf("Computer move: %s\n", $game->getMove($move["computerMove"]));
    echo sprintf("HMAC key: %s\n", $move["hmacKey"]);
    echo "\n".(Game::getText($game->checkMove($input, $move["computerMove"])))."\n";
}
