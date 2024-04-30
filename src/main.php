<?php

require_once './classes/game.php';
require_once '../vendor/autoload.php';

use Classes\Game;

try {
    $game = new Game(array_slice($argv, 1));
} catch (Exception $e) {
    echo sprintf("Error: %s\n", $e->getMessage());
    exit;
}

while($game->play()) {
    echo "\n";
}
