<?php

class Field
{
    public static function startFigurePosition()
    {
        return [
            self::whiteStart(),
            ArrayHelper::repeat(LichessFigure::w_pawn, 8),
            [],
            [],
            [],
            [],
            ArrayHelper::repeat(LichessFigure::b_pawn, 8),
            self::blackStart(),
        ];
    }

    private static function whiteStart(): array
    {
        return [
            LichessFigure::w_rook,
            LichessFigure::w_king,
            LichessFigure::w_bishop,
            LichessFigure::w_king,
            LichessFigure::w_queen,
            LichessFigure::w_bishop,
            LichessFigure::w_king,
            LichessFigure::w_rook,
        ];
    }

    private static function blackStart(): array
    {
        return [
            LichessFigure::b_rook,
            LichessFigure::b_king,
            LichessFigure::b_bishop,
            LichessFigure::b_king,
            LichessFigure::b_queen,
            LichessFigure::b_bishop,
            LichessFigure::b_king,
            LichessFigure::b_rook,
        ];
    }

    public static function getField()
    {
        $figures = self::startFigurePosition();
        for ($row = 0; $row < 8; $row++) {
            $field[$row] = [];
            for ($col = 0; $col < 8; $col++) {
                $field[$row][$col] = [
                    ($row + $col) % 2 === 0
                        ? CellColor::white
                        : CellColor::black
                    ,
                    $figures[$row][$col] ?? null
                ];
            }
        }
        return $field;
    }
}
