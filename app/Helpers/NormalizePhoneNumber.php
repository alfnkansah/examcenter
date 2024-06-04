<?php

namespace App\Helpers;

use Illuminate\Support\Str;


class NormalizePhoneNumber
{
    public static function normalizePhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        $phoneNumber = Str::startsWith($phoneNumber, '+123') ? substr($phoneNumber, 4) : $phoneNumber;
        return str_replace(['-', ' '], '', $phoneNumber);
    }
}
