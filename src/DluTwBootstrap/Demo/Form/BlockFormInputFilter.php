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
        ));

        //Password
        $this->add(array(
            'name'          => 'password',
            'required'      => true,
        ));

        //Multi Select
        $this->add(array(
            'name'          => 'multiSelect',
            'required'      => true,
        ));
   }
}