<?php

namespace App\Traits;

trait EnumTrait
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function toString(): string
    {
        return implode(",", array_column(self::cases(), 'value'));
    }

    public static function getValue(string $name): string
    {
        if (isset(self::array()[$name]))
            return self::array()[$name];
        return '';
    }
}
