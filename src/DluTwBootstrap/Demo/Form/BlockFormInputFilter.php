<?php
namespace DluTwBootstrap\Demo\Form;
use Zend\InputFilter\InputFilter;

class BlockFormInputFilter extends InputFilter
{
    public function __construct() {

        //FullName
        $this->add(array(
            'name'          => 'fullName',
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

        //Notes
        $this->add(array(
            'name'          => 'notes',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //PastaEater
        $this->add(array(
            'name'          => 'pastaEater',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Level
        $this->add(array(
            'name'          => 'level',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //RateUs
        $this->add(array(
            'name'          => 'rateUs',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Settings
        $this->add(array(
            'name'          => 'settings',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //SeenMovies
        $this->add(array(
            'name'          => 'seenMovies',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Car
        $this->add(array(
            'name'          => 'car',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Pets
        $this->add(array(
            'name'          => 'pets',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Attachment
        $this->add(array(
            'name'          => 'attachment',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));

        //Salary
        $this->add(array(
            'name'          => 'salary',
            'required'      => false,
            'validators'    => array(
            ),
            'filters'       => array(
            ),
        ));
   }
}