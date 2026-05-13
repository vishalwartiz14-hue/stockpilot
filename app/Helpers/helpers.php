<?php

if (!function_exists('print_date')) {

    function print_date($date)
    {
        if (!$date) {
            return '-';
        }

        return \Carbon\Carbon::parse($date)->format('d-m-Y');
    }
}

if (!function_exists('print_date_time')) {

    function print_date_time($date)
    {
        if (!$date) {
            return '-';
        }

        return \Carbon\Carbon::parse($date)->format('d-m-Y h:i A');
    }
}