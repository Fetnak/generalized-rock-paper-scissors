<?php

require 'vendor/autoload.php';

class Game
{
    private $moves;
    private $movesCount;
    private $movesCountDiv2;

    public function __construct(array $moves)
    {
        if(count($moves) < 3) {
            echo "The number of moves must be >= 3.";
            exit;
        }

        if(count($moves) % 2 == 0) {
            echo "The number of moves must be odd.";
            exit;
        }
        $this->moves = $moves;
        $this->movesCount = count($moves);
        $this->movesCountDiv2 = intdiv(count($moves), 2);
    }

    public function getMove(int $num): string
    {
        return $this->moves[$num];
    }

    public function getCount(): int
    {
        return $this->movesCount;
    }

    public function makeMove(): array
    {
        $hmacKey = bin2hex(random_bytes(32));
        $computerMove = rand(0, $this->movesCount - 1);
        $hmac = hash_hmac('sha256', $computerMove + 1, $hmacKey);
        return [
            'hmacKey' => $hmacKey,
            'computerMove' => $computerMove,
            'hmac' => $hmac
        ];
    }

    public function checkMove(int $move1, int $move2): int
    {
        if ($move1 === $move2) {
            return 0;
        } else {
            return (($move1 + $this->movesCountDiv2) >= $move2 && $move2 > $move1) || (($move1 + $this->movesCountDiv2 - $this->movesCount) >= $move2) ? 1 : -1;

        }
    }

    public static function getText(int $result): string
    {
        switch ($result) {
            case -1:
                return "Lose";
            case 0:
                return "Draw";
            case 1:
                return "Win";
        }
    }

    public function generateMenu(): string
    {
        $menuMoves = "";
        for($i = 0; $i < $this->movesCount; $i++) {
            $menuMoves .= sprintf("%d - %s\n", $i + 1, $this->getMove($i));
        }
        $menuMoves .= sprintf("%s - %s\n", "?", "help");
        $menuMoves .= sprintf("%d - %s\n", 0, "exit");
        return $menuMoves;
    }

    public function generateWinTable(): string
    {
        $tbl = new Console_Table();
        $header = array_merge(['v PC\User >'], $this->moves);
        $tbl->addRow($header);
        $tbl->addSeparator();
        for($i = 0; $i < $this->movesCount; $i++) {
            $row = [];
            $row[] = $this->getMove($i);
            for($j = 0; $j < $this->movesCount; $j++) {
                $row[] = self::getText($this->checkMove($i, $j));
            }
            $tbl->addRow($row);
        }
        return $tbl->getTable();
    }

}
