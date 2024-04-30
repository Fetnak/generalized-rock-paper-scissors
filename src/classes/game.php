<?php

namespace Classes;

require_once 'moves.php';
require_once 'computer.php';
require_once 'table.php';

class Game
{
    private $moves;
    private $menuText;

    public function __construct(array $moves)
    {
        $this->moves = new Moves($moves);
        $this->menuText = $this->getMenuText();
    }


    public static function checkMove(int $move1, int $move2, Moves $moves): int
    {
        if ($move1 === $move2) {
            return 0;
        } else {
            $count = $moves->getCount();
            $count2 = intdiv($count, 2);
            return (($move1 + $count2) >= $move2 && $move2 > $move1) || (($move1 + $count2 - $count) >= $move2) ? 1 : -1;

        }
    }

    public function getMenuText(): string
    {
        $menuMoves = "";
        for($i = 0; $i < $this->moves->getCount(); $i++) {
            $menuMoves .= sprintf("%d - %s\n", $i + 1, $this->moves->getMove($i));
        }
        $menuMoves .= sprintf("%s - %s\n", "?", "help");
        $menuMoves .= sprintf("%d - %s\n", 0, "exit");
        return $menuMoves;
    }

    public function play(): bool
    {
        $comp = new Computer($this->moves->getCount());
        echo sprintf("HMAC: %s \n", $comp->getHmac());

        echo $this->menuText;

        echo "Enter your move: ";
        $input = fgets(STDIN);

        if ($input === "?\n") {
            echo Table::generateTable($this->moves);
            return true;
        } elseif($input === "0\n") {
            return false;
        } else {
            $input = (int)$input - 1;
            if(!($input >= 0 && $input < $this->moves->getCount())) {
                return true;
            }
        }

        echo sprintf("Your move: %s\n", $this->moves->getMove($input));
        echo sprintf("Computer move: %s\n", $this->moves->getMove($comp->getMove()));
        echo sprintf("HMAC key: %s\n", $comp->getHmacKey());

        $result = Game::checkMove($input, $comp->getMove(), $this->moves);
        echo [
            -1 => "You lost.",
            0 => "It's a draw.",
            1 => "You win!"
        ][$result] . "\n";
        return true;
    }
}
