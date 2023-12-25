<?php
namespace App\Service\Unit;

class Number
{
    private function __construct()
    {}
    
    public static function isOdd(int $num): bool
    {
        return $num % 2 === 1;
    }

    public static function isEven(int $num): bool
    {
        return $num % 2 === 0;
    }
}