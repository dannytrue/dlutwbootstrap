<?php
namespace DluTwBootstrap\Form\Decorator;

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
