<?php

namespace Source\DAO;

abstract class GenericDAO
{

    private static int $maxRow;

    public static function setMaxRow(int $maxRow): void
    {
        self::$maxRow = $maxRow;
    }

    public static function getMaxRow(): int
    {
        return self::$maxRow;
    }
}
