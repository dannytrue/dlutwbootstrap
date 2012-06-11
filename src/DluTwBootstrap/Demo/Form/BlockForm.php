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

        //Fieldset One
        $this->add(array(
            'name'          => 'fsOne',
            'type'          => 'Zend\Form\Fieldset',
            'attributes'    => array(
                'legend'        => 'Legend for Fieldset 1',
            ),
            'elements'      => array(
                //Text
                array(
                    'spec' => array(
                        'name'          => 'text',
                        'attributes'    => array(
                            'type'               => 'text',
                            'label'              => 'Text',
                            'placeholder'        => 'Placeholder',
                            'inlineHelp'         => 'Inline help',
                            'description'        => 'Description.',
                        ),
                    ),
                ),
                //Password
                array(
                    'spec'  => array(
                        'name'  => 'password',
                        'attributes'    => array(
                            'type'              => 'password',
                            'label'             => 'Password',
                            'placeholder'       => 'Placeholder',
                            'inlineHelp'        => 'Inline help',
                            'description'       => 'Description.',
                        ),
                    ),
                ),
                //Textarea
                array(
                    'spec'  => array(
                        'name'  => 'textarea',
                        'attributes'    => array(
                            'type'              => 'textarea',
                            'label'             => 'Textarea',
                            'placeholder'       => 'Placeholder',
                            'inlineHelp'        => 'Inline help',
                            'description'       => 'Description.',
                        ),
                    ),
                ),
            ),
        ));

        //Fieldset Two
        $this->add(array(
            'name'          => 'fsTwo',
            'type'          => 'Zend\Form\Fieldset',
            'attributes'    => array(
               'legend'        => 'Legend for Fieldset 2',
            ),
            'elements'      => array(
                //Checkbox
                array(
                    'spec'  => array(
                        'name'  => 'checkbox',
                        'attributes'    => array(
                            'type'              => 'checkbox',
                            'label'             => 'Checkbox',
                            'description'       => 'Description.',
                        ),
                    ),
                ),
                //Radio
                array(
                    'spec'  => array(
                        'name'  => 'radio',
                        'attributes'    => array(
                            'type'              => 'radio',
                            'label'             => 'Radio',
                            'description'       => 'Description.',
                            'options'      => array(
                                'fm'   => 'FM',
                                'am'   => 'AM',
                                'dig'  => 'Digital',
                            ),
                        ),
                    ),
                ),
                //Radio inline
                array(
                    'spec'  => array(
                        'name'              => 'radioInline',
                        'attributes'        => array(
                            'type'              => 'radio',
                            'label'             => 'Radio Inline',
                            'description'       => 'Description.',
                            'options'      => array(
                                'a'   => 'A',
                                'b'   => 'B',
                                'c'   => 'C',
                                'd'   => 'D',
                                'e'   => 'E',
                                'f'   => 'F',
                            ),
                        ),
                    ),
                ),
                //Multicheckbox
                array(
                    'spec'  => array(
                        'name'              => 'multiCheckbox',
                        'attributes'        => array(
                            'type'              => 'checkbox',
                            'label'             => 'Multi Checkbox',
                            'description'       => 'Description.',
                            'options'       => array(
                                'mon'           => 'Monday',
                                'tue'           => 'Tuesday',
                                'wed'           => 'Wednesday',
                                'thu'           => 'Thursday',
                                'fri'           => 'Friday',
                                'sat'           => 'Saturday',
                                'sun'           => 'Sunday',
                            ),
                        ),
                    ),
                ),
                //Multicheckbox inline
                array(
                    'spec'  => array(
                        'name'              => 'multiCheckboxInline',
                        'attributes'        => array(
                            'type'              => 'checkbox',
                            'label'             => 'Multi Checkbox Inline',
                            'description'       => 'Description.',
                            'options'      => array(
                                'spring'        => 'Spring',
                                'summer'        => 'Summer',
                                'autumn'        => 'Autumn',
                                'winter'        => 'Winter',
                            ),
                        ),
                    ),
                ),
            )));

        //Select
        $this->add(array(
            'name'              => 'select',
            'attributes'        => array(
                'type'              => 'select',
                'label'             => 'Select',
                'inlineHelp'        => 'Inline help',
                'description'       => 'Description.',
                'options'       => array(
                    'alpha'     => 'Alpha',
                    'beta'      => 'Beta',
                    'gamma'     => 'Gamma',
                    'delta'     => 'Delta',
                ),
            ),
        ));

        //Multiselect
        $this->add(array(
            'name'              => 'multiSelect',
            'attributes'        => array(
                'type'              => 'select',
                'multiple'          => true,
                'label'             => 'Multi Select',
                'inlineHelp'        => 'Inline help',
                'description'       => 'Description.',
                'options'               => array(
                    'white'     => 'White',
                    'red'       => 'Red',
                    'black'     => 'Black',
                    'blue'      => 'Blue',
                    'green'     => 'Green',
                    'yellow'    => 'Yellow',
                ),
            ),
        ));

        //File
        $this->add(array(
            'name'              => 'file',
            'attributes'        => array(
                'type'              => 'file',
                'label'             => 'File',
                'inlineHelp'        => 'Inline help',
                'description'       => 'Description.',
            ),
        ));

        //Text with append / prepend
        $this->add(array(
            'name'              => 'textAp',
            'attributes'        => array(
                'type'              => 'text',
                'label'             => 'Text append/prepend',
                'placeholder'       => 'Placeholder',
                'inlineHelp'        => 'Inline help',
                'description'       => 'Description.',
                'prependText'       => 'Prepend text',
                'appendText'        => 'Append text',
            ),
        ));

        /*
        // Captcha
        $captcha = new Element\Captcha('seven');
        $captcha->setCaptcha(new DumbCaptchaAdapter);
        $captcha->setAttribute('label', 'Seven');
        $this->add($captcha);
        */

        //Csrf
        $this->add(new Element\Csrf('csrf'));

        //Submit button
        $this->add(array(
                       'name' => 'submitBtn',
                       'attributes' => array(
                           'type'  => 'submit',
                           'value' => 'Save changes',
                       ),
                   ));

        //Reset button
        $this->add(array(
                       'name' => 'resetBtn',
                       'attributes' => array(
                           'type'  => 'reset',
                           'value' => 'Clear form',
                       ),
                   ));

        //Plain button
        $this->add(array(
                       'name' => 'plainBtn',
                       'attributes' => array(
                           'type'  => 'button',
                           'value' => 'Other action',
                       ),
                   ));
    }
}