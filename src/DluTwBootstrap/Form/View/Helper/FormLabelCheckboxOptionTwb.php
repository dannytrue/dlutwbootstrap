<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;

class FormLabelCheckboxOptionTwb extends AbstractFormLabel
{

    /* ************************ METHODS ***************************** */

    /**
     * Adds attributes specific for this helper
     * @param array $attributes
     * @return array
     */
    protected function garnishAttributes(array $attributes) {
        $attributes = $this->genUtil->addWordToArrayItem('checkbox', $attributes, 'class');
        return $attributes;
    }



}