<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;

class FormLabelRadioOptionInlineTwb extends AbstractFormLabel
{

    /* ************************ METHODS ***************************** */

    /**
     * Adds attributes specific for this helper
     * @param array $attributes
     * @return array
     */
    protected function garnishAttributes(array $attributes) {
        $attributes = $this->genUtil->addWordToArrayItem('radio inline', $attributes, 'class');
        return $attributes;
    }



}