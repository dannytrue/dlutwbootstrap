<?php
namespace DluTwBootstrap\Form\Element;
use DluTwBootstrap\Util\Util;

/**
 * Reset Element
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class Reset extends \Zend\Form\Element\Reset
{
    /* ******************** METHODS ************************ */

    /**
     * Load default decorators
     * @return Reset
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
            $this->addDecorator('Tooltip')
                 ->addDecorator('ViewHelper')
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
        $class = $this->getAttrib('class');
        //Add 'btn' to class
        Util::addWord('btn', $class);
        $this->setAttrib('class', $class);
        return parent::render($view);
    }

}