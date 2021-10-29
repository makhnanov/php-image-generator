<?php
declare(strict_types=1);

class ArrayHelper
{
    public static function repeat(mixed $what, int $times): array
    {
        if ($times <= 0) {
            return [];
        }
        for ($i = 0; $i < $times; $i++) {
            $forReturn[] = $what;
        }
        /** @noinspection PhpUndefinedVariableInspection */
        return $forReturn;
    }
}
