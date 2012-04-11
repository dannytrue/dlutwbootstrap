<?php
namespace DluTwBootstrap\Form\Decorator;

/**
 * CheckboxLabel decorator
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class CheckboxLabel extends \Zend\Form\Decorator\HtmlTag
{
    /* ***************** METHODS ******************* */

    /**
     * Render a checkbox label
     * @param  string $content
     * @return string
     */
    public function render($content) {
        $element = $this->getElement();
        if(!($element instanceof \Zend\Form\Element\Checkbox)) {
            return $content;
        }
        /* @var $element \Zend\Form\Element\Checkbox */
        $this->setOption('tag', 'label');
        $this->setOption('class', 'checkbox');
        $this->setOption('for', $element->getId());
        $content    .= PHP_EOL . $element->getLabel();
        return parent::render($content);
    }
}
