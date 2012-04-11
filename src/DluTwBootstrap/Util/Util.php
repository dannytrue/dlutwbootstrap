<?php
namespace DluTwBootstrap\Util;

/**
 * Util - general utilities
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
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