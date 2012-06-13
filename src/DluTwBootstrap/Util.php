<?php
namespace DluTwBootstrap;

/**
 * General Utilities
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
     * If missing in the text, adds the space separated word to the text and returns the text
     * @param string $word
     * @param string $text
     * @return string
     */
    public function addWord($word, $text) {
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
        return $text;
    }

    /**
     * Adds a space separated word to an array item, if the word is missing there
     * If the array item does not exist, creates it
     * Returns the resulting array
     * @param string $word
     * @param array $ay
     * @param string $key
     * @return array
     */
    public function addWordToArrayItem($word, array $ay, $key) {
        if(!array_key_exists($key, $ay)) {
            $ay[$key]   = '';
        }
        $text       = $ay[$key];
        $text       = $this->addWord($word, $text);
        $ay[$key]   = $text;
        return $ay;
    }
}