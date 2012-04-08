<?php
namespace DluTwBootstrap\Util;

class Util
{
    /* ********************* METHODS *************************** */

    /**
     * If missing in the text, adds the space separated word to the text
     * @param string $word
     * @param string $text
     */
    public static function addWord($word, &$text) {
        $text   = trim($text);
        if(!$text) {
            $wordsLower  = array();
            $words       = array();
        } else {
            $wordsLower  = explode(' ', strtolower($text));
            $words       = explode(' ', $text);
        }
        if(!in_array(strtolower($word), $wordsLower)) {
            $words[]     = $word;
            $text   = implode(' ', $words);
        }
    }
}