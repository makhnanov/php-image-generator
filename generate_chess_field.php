<?php

spl_autoload_register(function ($classname) {
    /** @noinspection PhpIncludeInspection */
    include __DIR__ . '/chess/' . $classname . '.php';
});

const CELL_HEIGHT = 45;

$size = CELL_HEIGHT * 8;
$img = imageCreateTrueColor($size, $size);

define('WHITE', imageColorAllocate($img, 240, 217, 181));
define('BLACK', imageColorAllocate($img, 181, 136, 99));

$field = Field::getField();
for ($row = 0; $row < 8; $row++) {
    for ($col = 0; $col < 8; $col++) {
        $cellColor = $field[$row][$col][0] === CellColor::white ? WHITE : BLACK;
        imagefilledrectangle(
            $img,
            $col * CELL_HEIGHT,
            $row * CELL_HEIGHT,
            ($col + 1) * CELL_HEIGHT,
            ($row + 1) * CELL_HEIGHT,
            $cellColor
        );
    }
}

imagepng($img, __FILE__ . '.png');
imageDestroy($img);

$image = new Imagick();
$image->readImage(__FILE__ . '.png');

for ($row = 0; $row < 8; $row++) {
    for ($col = 0; $col < 8; $col++) {
        if (!isset($field[$row][$col][1])) {
            continue;
        }
        /** @var BackedEnum $enumFigure */
        $enumFigure = $field[$row][$col][1];
        $watermark = new Imagick();
        $watermark->readImage(__DIR__ . '/chess/' . $enumFigure->value);

        // Draw watermark on the image file with the given coordinates
        $image->compositeImage(
            $watermark,
            Imagick::COMPOSITE_OVER,
            $col * CELL_HEIGHT,
            $row * CELL_HEIGHT
        );
    }
}

$image->writeImage("image_watermark." . $image->getImageFormat());
