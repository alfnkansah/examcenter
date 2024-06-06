<?php

namespace App\Helpers;

class FormatNumber
{
    public static function formatNumber($number)
    {
        if ($number >= 1000000) {
            // Format as millions (e.g., 1.1m)
            return number_format($number / 1000000, 1) . 'm';
        } elseif ($number >= 1000) {
            // Format as thousands (e.g., 1.1k)
            return number_format($number / 1000, 1) . 'k';
        } else {
            // Return the original number
            return $number;
        }
    }
}
