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
            'inlineHelp'        => 'You should know this',
            'description'       => 'Enter your full name',
            'required'          => true,
            'filters'           => array(
                'stripTags', 'stringTrim'
            ),
        ));

        $this->addElement('password', 'pwd', array(
            'label'             => 'Password',
            'placeholderText'   => 'Top secret!',
            'inlineHelp'        => 'Do not tell anyone!',
            'description'       => 'Try to use the strongest password you can remember.',
            'required'  => true,
            'filters'   => array(
                'stripTags', 'stringTrim'
            ),
        ));

        $this->addElement('textarea', 'notes', array(
            'label'             => 'Notes',
            'placeholderText'   => 'Type any notes here',
            'inlineHelp'        => 'A place for your notes',
            'description'       => 'You can use html tags here.',
            'rows'              => 4,
            'required'  => false,
            'filters'   => array(
                'stringTrim',
            ),
        ));

        $this->addElement('checkbox', 'pastaEater', array(
            'label'             => 'Do you like pasta?',
            'description'       => 'Pure pizza eaters do not qualify.',
            'required'  => false,
        ));

        $this->addElement('radio', 'yourLevel', array(
            'label'             => 'Your level',
            'description'       => 'Enter your skill level',
            'required'          => true,
            'multiOptions'      => array(
                'beg'   => 'Beginner',
                'int'   => 'Intermediate',
                'adv'   => 'Advanced',
                'gur'   => 'Guru',
            ),

        ));

        $this->addElement('radio', 'rateUs1', array(
            'label'             => 'Rate us',
            'description'       => 'Rate our performance: A - best, F - worst.',
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
            'description'       => 'Please specify the application settings',
            'multiOptions'      => array(
                'runBkg'   => 'Run on background',
                'col'      => 'Use web colour palette',
                'slow'     => 'Compensate for slow connection',
                'stat'     => 'Collect statistics',
            ),

        ));

        $this->addElement('multicheckbox', 'seenMovies', array(
            'label'             => 'What have you seen?',
            'description'       => 'Check only those movies you have seen from the beginning to the end.',
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
            'description'   => "If your car make is not listed, select 'other'",
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
            'description'   => "Select only those you intentionally feed. I.e. do not select 'rat' if rodents occupy your cellar.",
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
            'description'       => 'All submitted files will be checked against viruses.',
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