<?php
namespace DluTwBootstrap\Form\Element\Line;

/**
 * Text line element
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class Text extends \Zend\Form\Element\Text
           implements \DluTwBootstrap\Form\Element\PlaceholderText,
                      \DluTwBootstrap\Form\Element\AppendPrepend
{
    /**
     * Text to append after the control
     * @var string
     */
    protected $_appendText;

    /**
     * Text to prepend before the control
     * @var string
     */
    protected $_prependText;

    /* ******************** METHODS ************************ */

    /**
     * Load default decorators
     * @return Text
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
                 ->addDecorator('AppendPrependText')
                //->addDecorator('Errors')
                 ->addDecorator('Label');
        }
        return $this;
    }

    /**
     * Sets the placeholder text
     * @param string $placeholderText
     */
    public function setPlaceholderText($placeholderText) {
        $this->setAttrib('placeholder', $placeholderText);
    }

    /**
     * Returns the placeholder text
     * @return string
     */
    public function getPlaceholderText() {
        $placeholderText    = $this->getAttrib('placeholder');
        return $placeholderText;
    }

    /**
     * Sets text to append after the control
     * @param string $text
     */
    public function setAppendText($text) {
        $this->_appendText  = $text;
    }

    /**
     * Returns text to append after the control
     * @return string
     */
    public function getAppendText() {
        return $this->_appendText;
    }

    /**
     * Returns true when the control has the append text
     * @return boolean
     */
    public function hasAppendText() {
        return (!empty($this->_appendText));
    }

    /**
     * Sets text to prepend before the control
     * @param string $text
     */
    public function setPrependText($text) {
        $this->_prependText = $text;
    }

    /**
     * Returns text to prepend before the control
     * @return string
     */
    public function getPrependText() {
        return $this->_prependText;
    }

    /**
     * Returns true when the control has the prepend text
     * @return boolean
     */
    public function hasPrependText() {
        return (!empty($this->_prependText));
    }
}