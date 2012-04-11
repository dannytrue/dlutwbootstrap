<?php
namespace DluTwBootstrap\Form;

class DemoVertical extends Vertical
{
    public function init() {
        $this->setName('verticalForm');
        $this->setLegend('Vertical Form Demo');

        $this->addElement('hidden', 'id', array(
            'filters'   => array(
                'int',
            )
        ));

        $this->addElement('text', 'name', array(
            'label'             => 'Name',
            'placeholderText'   => 'Your name',
            'inlineHelp'        => 'Use your real name',
            'description'       => 'Text element (required) in error state with error messages. Supports inline help as well as placeholder text.',
            'required'          => true,
            'filters'           => array(
                'stripTags', 'stringTrim'
            ),
        ));

        $this->addElement('password', 'pwd', array(
            'label'             => 'Password',
            'placeholderText'   => 'Top secret!',
            'inlineHelp'        => 'Do not tell anyone!',
            'description'       => 'Password element (required).  Supports inline help as well as placeholder text.',
            'required'  => true,
            'filters'   => array(
                'stripTags', 'stringTrim'
            ),
        ));

        $this->addElement('textarea', 'notes', array(
            'label'             => 'Notes',
            'placeholderText'   => 'Type any notes here',
            'inlineHelp'        => 'A place for your notes',
            'description'       => 'Textarea element.  Supports inline help as well as placeholder text.',
            'rows'              => 4,
            'required'  => false,
            'filters'   => array(
                'stringTrim',
            ),
        ));

        $this->addElement('checkbox', 'pastaEater', array(
            'label'             => 'Do you like pasta?',
            'description'       => 'Checkbox element.',
            'required'  => false,
        ));

        $this->addElement('radio', 'yourLevel', array(
            'label'             => 'Your level',
            'description'       => 'Radio element (required).',
            'required'          => true,
            'multiOptions'      => array(
                'beg'   => 'Beginner',
                'int'   => 'Intermediate',
                'adv'   => 'Advanced',
                'gur'   => 'Guru',
            ),
        ));

        $this->addElement('radio', 'rateUs', array(
            'label'             => 'Rate us',
            'description'       => 'Radio element inline (required).',
            'inline'            => true,
            'required'          => true,
            'multiOptions'      => array(
                'a'   => 'A',
                'b'   => 'B',
                'c'   => 'C',
                'd'   => 'D',
                'e'   => 'E',
                'f'   => 'F',
            ),
        ));

        $this->addElement('multicheckbox', 'settings', array(
            'label'             => 'Settings',
            'description'       => 'Multicheckbox element.',
            'multiOptions'      => array(
                'runBkg'   => 'Run on background',
                'col'      => 'Use web colour palette',
                'slow'     => 'Compensate for slow connection',
                'stat'     => 'Collect statistics',
            ),

        ));

        $this->addElement('multicheckbox', 'seenMovies', array(
            'label'             => 'What have you seen?',
            'description'       => 'Multicheckbox element inline.',
            'inline'            => true,
            'multiOptions'      => array(
                'terminator'    => 'Terminator 1',
                'eraser'        => 'Eraserhead',
                'amBeauty'      => 'American Beauty',
                'platoon'       => 'Platoon',
            ),

        ));

        $this->addElement('select', 'car', array(
            'label'     => 'Make of your car',
            'inlineHelp'    => 'What car do you drive?',
            'description'   => 'Select element. Supports inline help.',
            'multiOptions'      => array(
                'ford'    => 'Ford',
                'bmw'     => 'BMW',
                'renault' => 'Renault',
                'jag'     => 'Jaguar',
                'other'    => 'other',
            ),
            'class'     => 'span2',
        ));

        $this->addElement('multiselect', 'pets', array(
            'label'     => 'Your home creatures',
            'inlineHelp'    => 'Select all that apply',
            'description'   => 'Multiselect element. Supports inline help.',
            'multiOptions'      => array(
                'dog'    => 'Dog',
                'cat'     => 'Cat',
                'parrot' => 'Parrot',
                'fish'     => 'Fish',
                'rat'    => 'Rat',
                'other' => 'other',
            ),
            'class'     => 'span2',
        ));

        $this->addElement('file', 'attachment', array(
            'label'             => 'Attach file',
            'inlineHelp'        => 'Max. file size 1 MB',
            'description'       => 'File element. Supports inline help.',
            'required'          => false,
            'filters'           => array(
                'stringTrim',
            ),
        ));

        $this->addElement('hash', 'myHash', array(
            'salt'              => 'myUniqueSalt',
        ));

        $this->addElement('submit', 'submitBtn', array(
            'label'             => 'Save changes',
            'title'             => 'Submit button',
        ));

        $this->addElement('reset', 'resetBtn', array(
            'label'             => 'Clear form',
            'title'             => 'Reset button',
        ));

        $this->addElement('button', 'plainBtn', array(
            'label'             => 'Other action',
            'title'             => 'Button',
        ));
    }
}