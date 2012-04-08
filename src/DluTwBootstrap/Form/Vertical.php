<?php
namespace DluTwBootstrap\Form;

class Vertical extends AbstractBlockForm
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
                 ->addDecorator('FormDecorator', array('class' => 'form-vertical'));
        }
        return $this;
    }

}