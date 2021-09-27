<?php

namespace App\Helpers;

 
use Exception;

class CurrencyHelperClass
{
    
   

    public static function convertToStringIntByNumberOfDecimals($amount, $numberOfDecimals)
    {
        return bcmul($amount, bcpow(10, $numberOfDecimals));
    }

    public static function displayAmountToUserByNumberOfDecimals($amount, $numberOfDecimals)
    {
        return bcdiv(bcdiv($amount, bcpow(10, $numberOfDecimals), $numberOfDecimals), 1, $numberOfDecimals);
    }

    public static function displayAmountWithoutCommasByNumberOfDecimals($amount, $numberOfDecimals)
    {

        return str_replace(',', '', self::displayAmountToUserByNumberOfDecimals($amount, $numberOfDecimals));

    }

   

 
}