<?php
namespace DluTwBootstrap\Form\View\Helper;

use DluTwBootstrap\Form\View\Helper\FormMultiCheckboxTwb;

use Zend\Form\ElementInterface;

/**
 * FormRadioTwb
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormRadioTwb extends FormMultiCheckboxTwb
{
    /**
     * @var array
     */
    protected $twbLabelAttributes  = array(
        'class'     => 'radio',
    );

    /**
     * Return input type
     * @return string
     */
    protected function getInputType()
    {
        return 'radio';
    }

    /**
     * Get element name
     * @param  ElementInterface $element
     * @return string
     */
    protected static function getName(ElementInterface $element)
    {
        return $element->getName();
    }
}