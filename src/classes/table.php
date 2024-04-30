<?php

namespace Classes;

use Console_Table;

class Table
{
    public static function generateTable(Moves $moves): string
    {
        $tbl = new Console_Table();
        $tbl->addRow(array_merge(['v PC\User >'], $moves->getMoves()));
        $tbl->addSeparator();
        for($i = 0; $i < $moves->getCount(); $i++) {
            $row = [$moves->getMove($i)];
            for($j = 0; $j < $moves->getCount(); $j++) {
                $row[] = self::getText(Game::checkMove($i, $j, $moves));
            }
            $tbl->addRow($row);
        }
        return $tbl->getTable();
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
}
