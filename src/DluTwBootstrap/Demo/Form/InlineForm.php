<?php
namespace DluTwBootstrap\Demo\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class InlineForm extends Form
{
    public function __construct() {
        parent::__construct();

        $this->setName('demoFormInline');
        $this->setAttribute('method', 'post');


        //Hidden
        $this->add(array(
                       'name' => 'hiddenField',
                       'attributes' => array(
                           'type'       => 'hidden',
                           'value'      => 'myHiddenValue',
                       ),
                   ));

        //Full Name
        $this->add(array(
                        'name'          => 'text',
                        'attributes'    => array(
                            'type'               => 'text',
                            'label'              => 'Text',
                            'placeholder'        => 'Placeholder',
                            'inlineHelp'         => 'Inline help',
                            'description'        => 'Description.',
                        ),
        ));

        //Password
        $this->add(array(
                        'name'  => 'password',
                        'attributes'    => array(
                            'type'              => 'password',
                            'label'             => 'Password',
                            'placeholder'       => 'Placeholder',
                            'inlineHelp'        => 'Inline help',
                            'description'       => 'Description.',
                        ),
         ));

        //Checkbox
        $this->add(array(
            'name'  => 'checkbox',
            'attributes'    => array(
                'type'              => 'checkbox',
                'label'             => 'Checkbox',
                'description'       => 'Description.',
            ),
        ));

        //Select
        $this->add(array(
            'name'              => 'select',
            'attributes'        => array(
                'type'              => 'select',
                'label'             => 'Select',
                'inlineHelp'        => 'Inline help',
                'description'       => 'Description.',
                'options'      => array(
                    'a' => 'A',
                    'b' => 'B',
                    'c' => 'C',
                    'd' => 'D',
                    'e' => 'E',
                ),
            ),
        ));

        //Multicheckbox inline
        $this->add(array(
                       'name'              => 'multiCheckbox',
                       'attributes'        => array(
                           'type'              => 'checkbox',
                           'label'             => 'Multi Checkbox',
                           'description'       => 'Description.',
                           'options'      => array(
                               'opt1'    => 'One',
                               'opt2'    => 'Two',
                               'opt3'    => 'Three',
                           ),
                       ),
                   ));

        //Text with append / prepend
        $this->add(array(
            'name'              => 'textAp',
            'attributes'        => array(
                'type'              => 'text',
                'label'             => 'Text AP',
                'placeholder'       => 'Placeholder',
                'inlineHelp'        => 'Inline help',
                'description'       => 'Description',
                'prependText'       => 'Prepend',
                'appendText'        => 'Append',
            ),
        ));

        //Csrf
        $this->add(new Element\Csrf('csrf'));

        //Submit button
        $this->add(array(
                       'name' => 'submitBtn',
                       'attributes' => array(
                           'type'  => 'submit',
                           'value' => 'Submit',
                       ),
                   ));

        //Reset button
        $this->add(array(
                       'name' => 'resetBtn',
                       'attributes' => array(
                           'type'  => 'reset',
                           'value' => 'Reset',
                       ),
                   ));

        //Plain button
        $this->add(array(
                       'name' => 'plainBtn',
                       'attributes' => array(
                           'type'  => 'button',
                           'value' => 'Button',
                       ),
                   ));
    }
}