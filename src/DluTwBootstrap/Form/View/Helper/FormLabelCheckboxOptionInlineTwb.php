<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;

/**
 * FormLabelCheckboxOptionInlineTwb
 * Label for Multicheckbox options rendered inline
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormLabelCheckboxOptionInlineTwb extends AbstractFormLabel
{

    /* ************************ METHODS ***************************** */

    /**
     * Adds attributes specific for this helper
     * @param array $attributes
     * @return array
     */
    protected function garnishAttributes(array $attributes) {
        $attributes = $this->genUtil->addWordToArrayItem('checkbox inline', $attributes, 'class');
        return $attributes;
    }



}