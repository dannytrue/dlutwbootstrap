<?php
namespace DluTwBootstrap\Form\Element\Line;
use DluTwBootstrap\Util\Util;

class File extends \Zend\Form\Element\File
{
    /* ******************** METHODS ************************ */

    public function loadDefaultDecorators() {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }
        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $getId = function(\Zend\Form\Decorator $decorator) {
                return $decorator->getElement()->getId() . '-element';
            };
            $this->addDecorator('File')
                //->addDecorator('Errors')
                ->addDecorator('Label')
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
        $class  = $this->getAttrib('class');
        //Add 'input-file' to class
        Util::addWord('input-file', $class);
        $this->setAttrib('class', $class);
        return parent::render($view);
    }
}