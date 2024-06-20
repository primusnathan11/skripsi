<?php

namespace App\Helpers;

class Formatter
{
    // Format number to IDR
    public static function rupiah($value)
    {
        return "Rp " . number_format($value, 0, ",", ".");
    }

    /**
     * Format tel with indonesian code
     *
     * @param [type] $value
     * @return void
     */
    public static function IDTel($value)
    {
        $value = str_replace(" ", "", $value);
        $value = str_replace("-", "", $value);
        $value = str_replace("+", "", $value);
        $value = str_replace("(", "", $value);
        $value = str_replace(")", "", $value);
        // find the first number
        $firstNumber = strpos($value, "0");
        if ($firstNumber === 0) {
            $value = "62" . substr($value, 1);
        }
        return $value;
    }
}
