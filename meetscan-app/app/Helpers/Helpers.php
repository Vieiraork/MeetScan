<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

class Helpers
{
    public static function returnHashString($string)
    {
        return Hash::make($string);
    }

    public static function checkIfHashIsEqual($hash, $string)
    {
        return Hash::check($string, $hash);
    }
}