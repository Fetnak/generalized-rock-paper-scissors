<?php

$moves = $argv;
array_shift($moves);

if(count($moves) < 3) {
    echo "The number of moves must be >= 3.";
    exit;
}

if(count($moves) % 2 == 0) {
    echo "The number of moves must be odd.";
    exit;
}

$menuMoves = "";
for($i = 0; $i < count($moves); $i++) {
    $menuMoves .= sprintf("%d - %s\n", $i + 1, $moves[$i]);
}
$menuMoves .= sprintf("%d - %s\n", 0, "exit");


while(true) {
    $hmacKey = bin2hex(random_bytes(32));
    $computerMove = rand(1, 3);
    $hmac = hash_hmac('sha256', $computerMove, $computerMove);
    echo sprintf("HMAC: %s \n", $hmac);
    echo $menuMoves;
    echo "Enter your move: ";
    $input = fgets(STDIN);
    if(@$move = $moves[(int)$input - 1]) {
        echo sprintf("Your move: %s\n", $move);
    } else {
        break;
    }
}
