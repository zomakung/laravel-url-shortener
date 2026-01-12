<?php

namespace App\Helpers;

class Base62
{
    protected static string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function encode(int $number): string
    {
        $base = strlen(self::$chars);
        $result = '';

        while ($number > 0) {
            $result = self::$chars[$number % $base] . $result;
            $number = intdiv($number, $base);
        }

        return $result ?: '0';
    }
}