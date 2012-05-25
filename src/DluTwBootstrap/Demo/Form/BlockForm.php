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

        //Radio
        $this->add(array(
            'name'  => 'level',
            'attributes'    => array(
                'type'              => 'radio',
                'label'             => 'Your level',
                'description'       => 'Radio element.',
                'options'      => array(
                    'beg'   => 'Beginner',
                    'int'   => 'Intermediate',
                    'adv'   => 'Advanced',
                    'gur'   => 'Guru',
                ),
            ),
        ));

        //Radio inline
        $this->add(array(
            'name'              => 'rateUs',
            'attributes'        => array(
                'type'              => 'radio',
                'label'             => 'Rate us',
                'description'       => 'Radio element inline.',
                'inline'            => true,
                'options'      => array(
                    'a'   => 'A',
                    'b'   => 'B',
                    'c'   => 'C',
                    'd'   => 'D',
                    'e'   => 'E',
                    'f'   => 'F',
                ),
            ),
        ));

        //Multicheckbox
        $this->add(array(
            'name'              => 'settings',
            'attributes'        => array(
                'type'              => 'multiCheckbox',
                'label'             => 'Settings',
                'description'       => 'Multicheckbox element.',
                'options'       => array(
                    'runBkg'        => 'Run on background',
                    'col'           => 'Use web colour palette',
                    'slow'          => 'Compensate for slow connection',
                    'stat'          => 'Collect statistics',
                ),
            ),
        ));

        //Multicheckbox inline
        $this->add(array(
            'name'              => 'seenMovies',
            'attributes'        => array(
                'type'              => 'multiCheckbox',
                'label'             => 'What have you seen?',
                'description'       => 'Multicheckbox element inline.',
                'options'      => array(
                    'terminator'    => 'Terminator 1',
                    'eraser'        => 'Eraserhead',
                    'amBeauty'      => 'American Beauty',
                    'platoon'       => 'Platoon',
                ),
            ),
        ));

        //Select
        $this->add(array(
            'name'              => 'car',
            'attributes'        => array(
                'type'              => 'select',
                'label'             => 'Make of your car',
                'inlineHelp'        => 'What car do you drive?',
                'description'       => 'Select element. Supports inline help.',
                'options'      => array(
                    'ford'    => 'Ford',
                    'bmw'     => 'BMW',
                    'renault' => 'Renault',
                    'jag'     => 'Jaguar',
                    'other'   => 'other',
                ),
            ),
        ));

        //Multiselect
        $this->add(array(
            'name'              => 'pets',
            'attributes'        => array(
                'type'              => 'select',
                'multiple'          => true,
                'label'             => 'Your home creatures',
                'inlineHelp'        => 'Select all that apply',
                'description'       => 'Multiselect element. Supports inline help.',
                'options'               => array(
                    'dog'    => 'Dog',
                    'cat'     => 'Cat',
                    'parrot' => 'Parrot',
                    'fish'     => 'Fish',
                    'rat'    => 'Rat',
                    'other' => 'other',
                ),
            ),
        ));

        //File
        $this->add(array(
            'name'              => 'attachment',
            'attributes'        => array(
                'type'              => 'file',
                'label'             => 'Attach file',
                'inlineHelp'        => 'Max. file size 1 MB',
                'description'       => 'File element. Supports inline help.',
            ),
        ));

        //Text with append / prepend
        $this->add(array(
            'name'              => 'salary',
            'attributes'        => array(
                'type'              => 'text',
                'label'             => 'Salary',
                'placeholderText'   => 'Good old cash...',
                'inlineHelp'        => 'Yearly net salary',
                'description'       => 'Text element with prepend and append text. Renders correctly on horizontal and inline forms.',
                'prependText'       => '$',
                'appendText'        => '.00',
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