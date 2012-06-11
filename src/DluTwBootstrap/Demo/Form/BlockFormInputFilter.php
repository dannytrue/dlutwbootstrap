<?php
namespace DluTwBootstrap\Demo\Form;
use Zend\InputFilter\InputFilter;

class BlockFormInputFilter extends InputFilter
{
    public function __construct() {

        //Text
        $this->add(array(
            'name'          => 'text',
            'required'      => true,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Password
        $this->add(array(
            'name'          => 'password',
            'required'      => true,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Textarea
        $this->add(array(
            'name'          => 'textarea',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Checkbox
        $this->add(array(
            'name'          => 'checkbox',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Radio
        $this->add(array(
            'name'          => 'radio',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Radio Inline
        $this->add(array(
            'name'          => 'radioInline',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Multi Checkbox
        $this->add(array(
            'name'          => 'multiCheckbox',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Multi Checkbox Inline
        $this->add(array(
            'name'          => 'multiCheckboxInline',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Select
        $this->add(array(
            'name'          => 'select',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Multi Select
        $this->add(array(
            'name'          => 'multiSelect',
            'required'      => true,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //File
        $this->add(array(
            'name'          => 'file',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Text Append / Prepend
        $this->add(array(
            'name'          => 'textAp',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));
   }
}