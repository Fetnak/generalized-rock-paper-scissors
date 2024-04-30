<?php

namespace Classes;

use Exception;

class Moves
{
    private $moves;
    private $movesCount;

    public function __construct(array $moves)
    {
        if(count($moves) < 3) {
            throw new Exception("The number of moves must be >= 3.");
        }

        if(count($moves) % 2 == 0) {
            throw new Exception("The number of moves must be odd.");
        }

        if (count($moves) !== count(array_unique($moves))) {
            throw new Exception("Duplicates are not allowed.");
        }

        $this->moves = $moves;
        $this->movesCount = count($moves);
    }

    public function getMove(int $num): string
    {
        return $this->moves[$num];
    }

    public function getMoves(): array {
        return $this->moves;
    }

    public function getCount(): int
    {
        return $this->movesCount;
    }
}
