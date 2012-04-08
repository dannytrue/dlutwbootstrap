<?php
namespace DluTwBootstrap\Form;

class DgFormActions extends \Zend\Form\DisplayGroup
{
    /* ********************** METHODS ********************** */

    /**
     * Load default decorators
     * @return DgFormActions
     */
    public function loadDefaultDecorators() {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }
        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'form-actions'));
        }
        return $this;
    }

}