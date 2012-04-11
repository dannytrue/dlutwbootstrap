<?php
namespace DluTwBootstrap\Form\Decorator;

/**
 * DivControlGroup decorator
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class DivControlGroup extends \Zend\Form\Decorator\HtmlTag
{
    /* ***************** METHODS ******************* */

    /**
     * Render a div for control-group with optional 'error' class
     *
     * @param  string $content
     * @return string
     */
    public function render($content) {
        $element = $this->getElement();
        if(!($element instanceof \Zend\Form\Element)) {
            return $content;
        }
        /* @var $element \Zend\Form\Element */
        $class  = 'control-group';
        if($element->hasErrors()) {
            $class  .= ' error';
        }
        $this->setOption('tag', 'div');
        $this->setOption('class', $class);
        return parent::render($content);
    }
}
