<?php

if (!function_exists('formatNumbers')) {
    function formatNumbers($number)
    {
        if ($number >= 1000000000) {
            return number_format($number / 1000000000, 1) . 'B'; // For billions
        }
        if ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M'; // For millions
        }
        if ($number >= 1000) {
            return number_format($number / 1000, 1) . 'k'; // For thousands
        }
        return $number; // For anything less than 1000
    }
}
