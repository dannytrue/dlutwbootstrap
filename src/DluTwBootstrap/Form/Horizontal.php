<?php
namespace DluTwBootstrap\Form;
use \Zend\Form\Form;

class Horizontal extends AbstractBlockForm
{
    /* **************** METHODS ******************** */

    /**
     * Load the default decorators
     * @return AbstractForm
     */
    public function loadDefaultDecorators() {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }
        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormLegend', array('tag' => 'legend'))
                 ->addDecorator('FormElements')
                 ->addDecorator('HtmlTag', array('tag' => 'fieldset'))
                 ->addDecorator('FormDecorator', array('class' => 'form-horizontal'));
        }
        return $this;
    }

}