<?php

# Times New Roman from here https://ofont.ru/view/1249
# For get real time changes after change code use:
# while true; do php seaBattle.php 2>/dev/null; sleep 1; done;

const HEIGHT = 470;
const WIDTH = 240;

const FONT = __DIR__ . '/TimesNewRoman.ttf';

const ROW_PADDING = 20;
const COLUMN_PADDING = 20;

const ENEMY_ROWS_STARTS_AT_X = 10;
const ENEMY_ROWS_STARTS_AT_Y = 30;
const ENEMY_COLUMNS_STARTS_AT_X = 20;
const ENEMY_COLUMNS_STARTS_AT_Y = 30;
const COLUMN_HEIGHT = 206;
const ROW_WIDTH = 210;

# const TYPE_NOTHING = 0;
const TYPE_MISSED = 1;
const TYPE_ALIVE = 2;
const TYPE_DEAD = 3;

const ENEMY = [
    [0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
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

const YOU = [
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

imageLine($img, 20, 20, 89, 20, WHITE);
imageLine($img, 95, 20, WIDTH - 20, 20, WHITE);
imageFill($img, 21, 21, BLUE);

imageTtfText(
    $img,
    14,
    0,
    65,
    19,
    WHITE,
    FONT,
    'Морской Бот'
);

drawEmptyField(
    COLUMN_PADDING,
    ROW_PADDING,
    ENEMY_ROWS_STARTS_AT_X,
    ENEMY_ROWS_STARTS_AT_Y,
    ENEMY_COLUMNS_STARTS_AT_X,
    ENEMY_COLUMNS_STARTS_AT_Y,
    COLUMN_HEIGHT,
    ROW_WIDTH
);

drawEmptyField(
    COLUMN_PADDING,
    ROW_PADDING,
    ENEMY_ROWS_STARTS_AT_X + 10,
    ENEMY_ROWS_STARTS_AT_Y + 226,
    ENEMY_COLUMNS_STARTS_AT_X,
    ENEMY_COLUMNS_STARTS_AT_Y + 220,
    COLUMN_HEIGHT,
    ROW_WIDTH
);

verticalText('противник', 225, 70, 16);
verticalText('Вы', 3, 344, 15);
verticalText('123456789', 8, 46, 20);
imageTtfText(
    $img,
    14,
    0,
    1,
    226,
    WHITE,
    FONT,
    '10'
);
verticalText('123456789', 223, 272, 20);
imageTtfText(
    $img,
    14,
    0,
    221,
    452,
    WHITE,
    FONT,
    '10'
);
horizontalText('абвгдежзик', 25, 248, 20);

fillField(
    ENEMY,
    ENEMY_COLUMNS_STARTS_AT_X,
    ENEMY_COLUMNS_STARTS_AT_Y,
    COLUMN_PADDING,
    ROW_PADDING
);
fillField(
    YOU,
    ENEMY_COLUMNS_STARTS_AT_X,
    ENEMY_COLUMNS_STARTS_AT_Y + 226,
    COLUMN_PADDING,
    ROW_PADDING
);

# Выводим изображение
imageJpeg($img, __DIR__ . '/SeaBattleVertical.jpg', 100);
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
    for ($column = 0; $column <= 10; $column++) {
        imageLine(
            $img,
            ($column * $columnPadding) + $columnsStartsAtX,
            $columnsStartsAtY,
            ($column * $columnPadding) + $columnsStartsAtX,
            $columnsStartsAtY + $columnHeight,
            WHITE
        );
    }
    for ($row = 0; $row <= 10; $row++) {
        imageLine(
            $img,
            $rowsStartsAtX,
            ($row * $rowPadding) + $rowsStartsAtY,
            $rowsStartsAtX + $rowWidth,
            ($row * $rowPadding) + $rowsStartsAtY,
            WHITE
        );
    }
}

function verticalText($text, $x, $y, $padding)
{
    global $img;
    $imgResource = $img;
    $fontPath = FONT;
    $fontSize = 14;
    foreach (mb_str_split($text) as $char) {
        imagettftext($imgResource, $fontSize, 0, $x, $y, WHITE, $fontPath, $char);
        $y += $padding;
    }
}

function horizontalText($text, $x, $y, $padding)
{
    global $img;
    $imgResource = $img;
    $fontPath = FONT;
    $fontSize = 14;
    foreach (mb_str_split($text) as $char) {
        imagettftext(
            $imgResource,
            $fontSize,
            0,
            $x,
            $y,
            WHITE,
            $fontPath,
            $char
        );
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
                case TYPE_ALIVE:
                    imageFill(
                        $img,
                        $fieldStartX + 1,
                        $fieldStartY + 1,
                        WHITE
                    );
                    break;
                case TYPE_DEAD:
                    imageFill(
                        $img,
                        $fieldStartX + 1,
                        $fieldStartY + 1,
                        WHITE
                    );
                    imagefilledellipse(
                        $img,
                        (int)($fieldStartX + $fieldWidth / 2),
                        (int)($fieldStartY + $fieldHeight / 2),
                        10,
                        10,
                        BLUE
                    );
                    imageLine(
                        $img,
                        $fieldStartX + 1,
                        $fieldStartY + 1,
                        $fieldStartX + $fieldWidth - 1,
                        $fieldStartY + $fieldHeight - 1,
                        BLUE
                    );
                    imageLine(
                        $img,
                        (int)($fieldStartX + ($fieldWidth / 2)),
                        $fieldStartY + 1,
                        (int)($fieldStartX + ($fieldWidth / 2)),
                        $fieldStartY + $fieldHeight - 1,
                        BLUE
                    );
                    imageLine(
                        $img,
                        $fieldStartX + $fieldWidth - 1,
                        $fieldStartY + 1,
                        $fieldStartX + 1,
                        $fieldStartY + $fieldHeight - 1,
                        BLUE
                    );
                    imageLine(
                        $img,
                        $fieldStartX + 1,
                        $fieldStartY + 1,
                        $fieldStartX + 1,
                        $fieldStartY + $fieldHeight - 1,
                        BLUE
                    );
                    imageLine(
                        $img,
                        $fieldStartX + 1,
                        $fieldStartY + $fieldHeight - 1,
                        $fieldStartX + $fieldWidth - 1,
                        $fieldStartY + $fieldHeight - 1,
                        BLUE
                    );
                    imageLine(
                        $img,
                        $fieldStartX + $fieldWidth - 1,
                        $fieldStartY + $fieldHeight - 1,
                        $fieldStartX + $fieldWidth - 1,
                        $fieldStartY + 1,
                        BLUE
                    );
                    imageLine(
                        $img,
                        $fieldStartX + $fieldWidth - 1,
                        $fieldStartY + 1,
                        $fieldStartX + 1,
                        $fieldStartY + 1,
                        BLUE
                    );
                    break;
                case TYPE_MISSED:
                    imagefilledellipse(
                        $img,
                        (int)($fieldStartX + $fieldWidth / 2),
                        (int)($fieldStartY + $fieldHeight / 2),
                        6,
                        6,
                        WHITE
                    );
                    break;
            endswitch;
        }
    }
}
