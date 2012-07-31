<?php
namespace DluTwBootstrap;

use DluTwBootstrap\Exception\InvalidParameterTypeException;

/**
 * General Utilities
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class GenUtil
{
    /* ********************* METHODS *************************** */

    /**
     * If missing in the text, adds the space separated word(s) to the text and returns the text
     * @param string|array $spec A single word, space separated words or an array of words
     * @param string $text
     * @throws Exception\InvalidParameterTypeException
     * @return string
     */
    public function addWord($spec, $text) {
        if (is_string($spec)) {
            $spec   = trim($spec);
            $spec   = preg_replace('/\s+/', ' ', $spec);
            $spec   = explode(' ', $spec);
        }
        if (!is_array($spec)) {
            throw new InvalidParameterTypeException(sprintf("%s expects either a string or an array as the 'spec' parameter.", __METHOD__));
        }
        $text   = trim($text);
        if($text) {
            $text       = preg_replace('/\s+/', ' ', $text);
            $wordsLower = explode(' ', strtolower($text));
            $words      = explode(' ', $text);
        } else {
            $wordsLower = array();
            $words      = array();
        }
        foreach ($spec as $word) {
            if (!in_array(strtolower($word), $wordsLower)) {
                $words[]    = $word;
            }
        }
        $text   = implode(' ', $words);
        return $text;
    }

    /**
     * Adds a space separated word(s) to an array item, if the word(s) is(are) missing there
     * If the array item does not exist, creates it
     * Returns the resulting array
     * @param string|array $spec
     * @param array $ay
     * @param string $key
     * @return array
     */
    public function addWordToArrayItem($spec, array $ay, $key) {
        if(!array_key_exists($key, $ay)) {
            $ay[$key]   = '';
        }
        $text       = $ay[$key];
        $text       = $this->addWord($spec, $text);
        $ay[$key]   = $text;
        return $ay;
    }
}