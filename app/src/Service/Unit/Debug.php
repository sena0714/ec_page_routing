<?php
namespace App\Service\Unit;

class Debug
{
    static function output($any): void
    {
        var_dump($any);
        exit;
    }

    static function outputOnWeb($any): void
    {
        echo '<pre>';
        var_dump($any);
        echo '</pre>';
        exit;
    }
}