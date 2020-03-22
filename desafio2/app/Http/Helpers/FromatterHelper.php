<?php

namespace App\Helpers;

/**
 * Class Formatter
 *
 * @package App\Http\Helpers
 */
class FormatterHelper
{
    /**
     * Retira tudo o que não é número de uma string
     * @param $sString string
     * @return string
     */
    static public function onlyNumbers($sString){
        return preg_replace("/[^A-Za-z0-9]/","",$sString);
    }
}
