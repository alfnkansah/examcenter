<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingController extends Controller
{
    public function greetUser($timezone)
    {
        if ($timezone ==  null) {
            $timezone = 'Africa/Accra';
        }
        // Set the timezone
        date_default_timezone_set($timezone);

        // Get the current hour in 24-hour format
        $currentTime = date('H');

        if ($currentTime >= 5 && $currentTime < 12) {
            // Morning
            $greeting = "Good morning";
        } elseif ($currentTime >= 12 && $currentTime < 18) {
            // Afternoon
            $greeting = "Good afternoon";
        } else {
            // Evening
            $greeting = "Good evening";
        }

        return $greeting;
    }
}
