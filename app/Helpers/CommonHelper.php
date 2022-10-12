<?php

namespace App\Helpers;

class CommonHelper
{
    /**
     * Undocumented function
     *
     * @param [type] $text
     * @param string $charTo
     * @param string $charFrom
     */
    public static function convertText($text, $charTo = "SHIFT-JIS", $charFrom = "UTF-8")
    {
        if ($text != '') {
            return mb_convert_encoding($text, $charTo, $charFrom);
        }
        return '';
    }
    public static function formatDatetimeByStyle($date, $style = 'Y/m/d H:i')
    {
        return $date != "" ? date($style, strtotime($date)) : "";
    }

}
