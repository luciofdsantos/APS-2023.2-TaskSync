<?php

namespace App\Helpers;

class ArraysHelper
{
    public static function to_array($get)
    {
        $get->transform(
            function ($i) {
                return (array)$i;
            }
        );

        $get = $get->toArray();

        return $get;
    }
}
