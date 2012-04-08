<?php
namespace DluTwBootstrap\Form;

class Search extends AbstractLineForm
{
    /* ********************* METHODS ********************** */

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
                ->addDecorator('FormDecorator', array('class' => 'form-search'));
        }
        return $this;
    }
}