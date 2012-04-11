<?php
namespace DluTwBootstrap\Form\Decorator;

/**
 * AppendPrependText decorator
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class AppendPrependText extends \Zend\Form\Decorator\AbstractDecorator
{
    /* ***************** METHODS ******************* */

    /**
     * Render a checkbox label
     * @param  string $content
     * @return string
     */
    public function render($content) {
        $element = $this->getElement();
        if(!($element instanceof \DluTwBootstrap\Form\Element\AppendPrepend)) {
            return $content;
        }
        /* @var $element \DluTwBootstrap\Form\Element\AppendPrepend */
        $outerDivClass  = array();
        if($element->hasPrependText()) {
            $content          = trim($content);
            $outerDivClass[]  = 'input-prepend';
            $prependText      = '<span class="add-on">'
                                . $element->getView()->escape($element->getPrependText())
                                . '</span>';
            $content          = $prependText . $content;
        }
        if($element->hasAppendText()) {
            $content          = trim($content);
            $outerDivClass[]  = 'input-append';
            $appendText       = '<span class="add-on">'
                                . $element->getView()->escape($element->getAppendText())
                                . '</span>';
            $content          = $content . $appendText;
        }
        if(count($outerDivClass) > 0) {
            $content            = '<div class="' . implode(' ', $outerDivClass) . '">'
                                  . "\n" . $content
                                  . "\n" . '</div>';
        }
        return $content;
    }
}
