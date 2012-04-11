<?php
namespace DluTwBootstrap\Form\Element;

/**
 * PlaceholderText Interface
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
interface PlaceholderText
{
    /**
     * Sets the placeholder text
     * @param string $placeholderText
     */
    public function setPlaceholderText($placeholderText);

    /**
     * Returns the placeholder text
     * @return string
     */
    public function getPlaceholderText();
}