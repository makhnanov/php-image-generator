<?php

const FILE = 'SeaBattleHorizontal.png';
const WIDTH = 388;
const HEIGHT = 172;
const FONT = './TimesNewRoman.ttf';
const FONT_SIZE = 8;

const ROW_WIDTH = 160;
const COLUMN_HEIGHT = 150;
const ROW_PADDING = 15;
const COLUMN_PADDING = 15;

const PLAYER_ROWS_STARTS_AT_X = 10;
const PLAYER_ROWS_STARTS_AT_Y = 10;
const PLAYER_COLUMNS_STARTS_AT_X = 20;
const PLAYER_COLUMNS_STARTS_AT_Y = 10;

const ASSISTANT_ROWS_STARTS_AT_X = PLAYER_ROWS_STARTS_AT_X + ROW_WIDTH + (ROW_PADDING * 3) + 5;
const ASSISTANT_ROWS_STARTS_AT_Y = PLAYER_ROWS_STARTS_AT_Y;
const ASSISTANT_COLUMNS_STARTS_AT_X = PLAYER_COLUMNS_STARTS_AT_X + ROW_WIDTH + (ROW_PADDING * 3) + 5;
const ASSISTANT_COLUMNS_STARTS_AT_Y = PLAYER_COLUMNS_STARTS_AT_Y;

const MISSED = 1;
const BOAT = 2;
const HIT = 3;

const ASSISTANT = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 3, 0, 3, 3, 1, 0, 3, 0],
    [0, 0, 0, 1, 1, 1, 1, 1, 0, 0],
    [0, 0, 0, 0, 0, 1, 3, 1, 1, 1],
    [0, 0, 0, 0, 0, 1, 1, 1, 1, 3],
    [0, 0, 0, 1, 3, 1, 0, 0, 1, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [1, 3, 0, 0, 0, 0, 0, 0, 0, 3],
    [1, 0, 0, 0, 0, 0, 0, 0, 1, 3],
];

const PLAYER = [
    [0, 0, 0, 0, 0, 0, 1, 3, 1, 0],
    [0, 2, 0, 2, 2, 2, 1, 1, 1, 0],
    [0, 3, 0, 0, 0, 0, 0, 0, 0, 2],
    [0, 3, 0, 0, 0, 0, 0, 0, 0, 2],
    [0, 2, 0, 0, 2, 3, 2, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 2, 2, 3, 2, 0, 0, 0, 0],
    [2, 0, 0, 0, 0, 0, 0, 0, 1, 1],
    [0, 0, 0, 0, 2, 3, 1, 0, 1, 3],
];

$img = imageCreateTrueColor(WIDTH, HEIGHT);

define('BLUE', imageColorAllocate($img, 66, 133, 244));
define('WHITE', imageColorAllocate($img, 255, 255, 255));
define('BLACK', imageColorAllocate($img, 0, 0, 0));

imageFill($img, 21, 21, BLUE);

drawEmptyField(
    COLUMN_PADDING,
    ROW_PADDING,
    PLAYER_ROWS_STARTS_AT_X,
    PLAYER_ROWS_STARTS_AT_Y,
    PLAYER_COLUMNS_STARTS_AT_X,
    PLAYER_COLUMNS_STARTS_AT_Y,
    COLUMN_HEIGHT,
    ROW_WIDTH
);

drawEmptyField(
    COLUMN_PADDING,
    ROW_PADDING,
    ASSISTANT_ROWS_STARTS_AT_X,
    ASSISTANT_ROWS_STARTS_AT_Y,
    ASSISTANT_COLUMNS_STARTS_AT_X,
    ASSISTANT_COLUMNS_STARTS_AT_Y,
    COLUMN_HEIGHT,
    ROW_WIDTH
);

verticalText('Игрок', ROW_WIDTH + 13 + FONT_SIZE, 50, 16);
imageLine(
    $img,
    ROW_WIDTH + 37,
    0,
    ROW_WIDTH + 37,
    HEIGHT,
    BLACK
);
verticalText('Алиса', ROW_WIDTH + 47, 50, 16);

fillField(
    PLAYER,
    PLAYER_COLUMNS_STARTS_AT_X,
    PLAYER_COLUMNS_STARTS_AT_Y,
    COLUMN_PADDING,
    ROW_PADDING
);

fillField(
    ASSISTANT,
    ASSISTANT_COLUMNS_STARTS_AT_X,
    ASSISTANT_COLUMNS_STARTS_AT_Y,
    COLUMN_PADDING,
    ROW_PADDING
);

# Выводим изображение
//imageJpeg($img, FILE, 100);
$imgQuality = 100;
imagejpeg($img, FILE, $imgQuality);
imageDestroy($img);

function drawEmptyField(
    $columnPadding,
    $rowPadding,
    $rowsStartsAtX,
    $rowsStartsAtY,
    $columnsStartsAtX,
    $columnsStartsAtY,
    $columnHeight,
    $rowWidth
) {
    global $img;

    $hf = (int)(FONT_SIZE / 2) - 2;
    $letters = chars_of('абвгдежзик');
    for ($column = 0; $column < 11; $column++) {
        imageLine(
            $img,
            ($column * $columnPadding) + $columnsStartsAtX,
            $columnsStartsAtY,
            ($column * $columnPadding) + $columnsStartsAtX,
            $columnsStartsAtY + $columnHeight,
            WHITE
        );

        if ($column < 10) {
            $x = ($column * $columnPadding) + $columnsStartsAtX + $hf + 2;
            $y = $columnsStartsAtY - $hf;
            imagettftext($img, FONT_SIZE, 0, $x, $y, WHITE, FONT, $letters[$column]);
        }
    }

    for ($row = 0; $row < 11; $row++) {
        imageLine(
            $img,
            $rowsStartsAtX,
            ($row * $rowPadding) + $rowsStartsAtY,
            $rowsStartsAtX + $rowWidth,
            ($row * $rowPadding) + $rowsStartsAtY,
            WHITE
        );

        if ($row < 10) {
            $x = $rowsStartsAtX;
            if ($row < 9) {
                $x += $hf;
            } else {
                $x -= $hf;
            }
            $y = $rowPadding - $hf + ($row * $rowPadding) + $rowsStartsAtY;
            imagettftext($img, FONT_SIZE, 0, $x, $y, WHITE, FONT, $row + 1);
        }
    }

}

function chars_of($str)
{
    return preg_split('/(?<!^)(?!$)/u', $str);
}

function drawNumbers($text, $x, $y, $padding)
{
    global $img;
    $imgResource = $img;
    $fontPath = FONT;
    $fontSize = FONT_SIZE;
    foreach (chars_of($text) as $char) {
        imagettftext($imgResource, $fontSize, 0, $x, $y, WHITE, $fontPath, $char);
        $y += $fontSize;
    }
}

function verticalText($text, $x, $y, $padding)
{
    global $img;
    $imgResource = $img;
    $fontPath = FONT;
    $fontSize = FONT_SIZE;
    foreach (chars_of($text) as $char) {
        imagettftext($imgResource, $fontSize, 0, $x, $y, WHITE, $fontPath, $char);
        $y += $padding;
    }
}

function horizontalText($text, $x, $y, $padding)
{
    global $img;
    $imgResource = $img;
    $fontPath = FONT;
    $fontSize = FONT_SIZE;
    foreach (chars_of($text) as $char) {
        imagettftext($imgResource, $fontSize, 0, $x, $y, WHITE, $fontPath, $char);
        $x += $padding;
    }
}

function fillField($data, $startX, $startY, $fieldWidth, $fieldHeight)
{
    global $img;
    foreach (range(0, 9) as $row) {
        foreach (range(0, 9) as $col) {
            $fieldStartX = ($col * $fieldWidth) + $startX;
            $fieldStartY = ($row * $fieldHeight) + $startY;
            switch ($data[$row][$col]):
                case BOAT:
                    imageFill(
                        $img,
                        $fieldStartX + 1,
                        $fieldStartY + 1,
                        WHITE
                    );
                    break;
                case HIT:
                    $boom = imagecreatefrompng(dirname(__FILE__) . "/boom.png");
                    imagecopymerge($img, $boom, $fieldStartX + 1, $fieldStartY, 0, 0, 14, 15, 100);
                    imagedestroy($boom);
                    break;
                case MISSED:
                    imagefilledellipse(
                        $img,
                        $fieldStartX + $fieldWidth / 2,
                        $fieldStartY + $fieldHeight / 2,
                        6,
                        6,
                        WHITE
                    );
                    break;
            endswitch;
        }
    }
}
