<?php
namespace DluTwBootstrap\Demo\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class BlockForm extends Form
{
    public function __construct() {
        parent::__construct();

        $this->setName('demoFormBlock');
        $this->setAttribute('method', 'post');


        //Hidden
        $this->add(array(
                       'name' => 'hiddenField',
                       'attributes' => array(
                           'type'       => 'hidden',
                           'value'      => 'myHiddenValue',
                       ),
                   ));

        //Text
        $this->add(array(
                       'name' => 'fullName',
                       'attributes' => array(
                           'type'               => 'text',
                           'label'              => 'Name',
                           'placeholderText'    => 'Your full name',
                           'inlineHelp'         => 'Use your real name',
                           'description'        => 'Text element in error state with error messages. Supports inline help as well as placeholder text.',
                       ),
                   ));

        //Password
        $this->add(array(
            'name'  => 'password',
            'attributes'    => array(
                'type'              => 'password',
                'label'             => 'Password',
                'placeholderText'   => 'Top secret!',
                'inlineHelp'        => 'Do not tell anyone!',
                'description'       => 'Password element (required).  Supports inline help as well as placeholder text.',
            ),
        ));

        //Textarea
        $this->add(array(
            'name'  => 'notes',
            'attributes'    => array(
                'type'              => 'textarea',
                'label'             => 'Notes',
                'placeholderText'   => 'Type any notes here',
                'inlineHelp'        => 'A place for your notes',
                'description'       => 'Textarea element.  Supports inline help as well as placeholder text.',
            ),
        ));

        //Checkbox
        $this->add(array(
            'name'  => 'pastaEater',
            'attributes'    => array(
                'type'              => 'checkbox',
                'label'             => 'Do you like pasta?',
                'description'       => 'Checkbox element.',
            ),
        ));


        // MultiCheckbox
        $this->add(array(
                       'name' => 'four',
                       'attributes' => array(
                           'type'  => 'multiCheckbox',
                           'label' => 'Four',
                           'options' => array(
                               'one' => '1',
                               'two' => '2',
                           ),
                           //'id' => 'id4',
                       ),
                   ));

        // Radio
        $this->add(array(
                       'name' => 'five',
                       'attributes' => array(
                           'type'  => 'radio',
                           'label' => 'Five',
                           'options' => array(
                               'one' => '1',
                               'two' => '2',
                           ),
                           //'id' => 'id5',

                       ),
                   ));

        // Select
        $this->add(array(
                       'name' => 'six',
                       'attributes' => array(
                           'type'  => 'select',
                           'label' => 'Six',
                           'options' => array(
                               'one' => '1',
                               'two' => '2',
                           ),
                       ),
                   ));

        /*
        // Captcha
        $captcha = new Element\Captcha('seven');
        $captcha->setCaptcha(new DumbCaptchaAdapter);
        $captcha->setAttribute('label', 'Seven');
        $this->add($captcha);
        */

        // Csrf
        $this->add(new Element\Csrf('csrf'));

        // Submit button
        $this->add(array(
                       'name' => 'submit',
                       'attributes' => array(
                           'type'  => 'submit',
                           'label' => 'Submit',
                       ),
                   ));

    }
}