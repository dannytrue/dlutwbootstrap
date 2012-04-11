<?php
namespace DluTwBootstrap\Form\Element;

/**
 * InlineHelp Interface
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
interface InlineHelp
{
    /**
     * Sets inline help
     * @param string $inlineHelp
     */
    public function setInlineHelp($inlineHelp);

    /**
     * Returns the inline help
     * @return string
     */
    public function getInlineHelp();
}