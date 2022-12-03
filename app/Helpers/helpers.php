<?php

use Carbon\Carbon;

if (!function_exists('randomString')) {
    /**
     *  Generate ramdom string
     *
     *  @return String $randomString
     */
    function randomString(int $length = 10, bool $numbers = false, bool $specialCharts = false)
    {
        $characters = ($numbers ? '0123456789' : '') . 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters .= $specialCharts ? '!@#$%^&*-+=' : '';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        if ($specialCharts && !preg_match('/^.{' . $length . ',' . $length . '}$(?=.*\d)|(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $randomString)) {
            $randomString = randomString($length, $specialCharts);
        }
        return $randomString;
    }
}

if (!function_exists('americanFormat')) {
    /**
     * American format
     *
     * @param string $date
     * @return string result format date
     */
    function americanFormat(string $date)
    {
        $date = new Carbon($date);
        return $date->translatedFormat('m/d/y');
    }
}
