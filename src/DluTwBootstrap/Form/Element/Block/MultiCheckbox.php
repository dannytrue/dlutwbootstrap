<?php
namespace DluTwBootstrap\Form\Element\Block;
use DluTwBootstrap\Util\Util;

/**
 * MultiCheckbox block element
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class MultiCheckbox extends \Zend\Form\Element\MultiCheckbox
{
    /**
     * Separator to use between options
     * @var string
     */
    protected $_separator   = "\n";

    /**
     * Should be the controls displayed inline?
     * @var bool
     */
    protected $_inline      = false;

    /* ******************** METHODS ************************ */

    /**
     * Load default decorators
     * @return \Zend\Form\Element
     */
    public function loadDefaultDecorators() {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }
        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $getId = function(\Zend\Form\Decorator $decorator) {
                return $decorator->getElement()->getId() . '-element';
            };
            $this->addDecorator('ViewHelper')
                 ->addDecorator('Description', array('tag' => 'p', 'class' => 'help-block'))
                 ->addDecorator('Errors')
                 ->addDecorator(array('divControls' => 'HtmlTag'), array('tag' => 'div', 'class' => 'controls'))
                 ->addDecorator('Label', array('class' => 'control-label'))
                 ->addDecorator('DivControlGroup')
            ;
        }
        return $this;
    }

    /**
     * Render form element
     * @param  View $view
     * @return string
     */
    public function render(View $view = null) {
        $labelClass = $this->getAttrib('label_class');
        //Add 'checkbox' to label class
        Util::addWord('checkbox', $labelClass);
        //Add 'inline' to label class
        if($this->isInline()) {
            Util::addWord('inline', $labelClass);
        }
        $this->setAttrib('label_class', $labelClass);
        return parent::render($view);
    }

    /**
     * Sets if the controls should be displayed inline
     * @param boolean $inline
     */
    public function setInline($inline) {
        $this->_inline = (bool)$inline;
    }

    /**
     * Returns if the controls should be displayed inline
     * @return boolean
     */
    public function isInline() {
        return $this->_inline;
    }
}