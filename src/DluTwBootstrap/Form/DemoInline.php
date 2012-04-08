<?php
namespace DluTwBootstrap\Form;

class DemoInline extends Inline
{
    public function init() {
        $this->setName('inlineForm');
        $this->setLegend('Inline Form Demo');

        $this->addElement('hidden', 'hiddenCode', array(
            'filters'   => array(
                'int',
            )
        ));

        $this->addElement('text', 'userName', array(
            'placeholderText'   => 'Username',
            'required'          => true,
            'class'             => 'span2',
            'filters'           => array(
                'stripTags', 'stringTrim'
            ),
        ));

        $this->addElement('password', 'pwd', array(
            'placeholderText'   => 'Password',
            'required'          => true,
            'class'             => 'span2',
            'filters'           => array(
                'stripTags', 'stringTrim'
            ),
        ));

        $this->addElement('select', 'language', array(
            'multiOptions'      => array(
                'en'    => 'English',
                'de'    => 'Deutsch',
                'it'    => 'Italiano',
            ),
            'class'     => 'span2',
        ));

        $this->addElement('checkbox', 'rememberMe', array(
            'label'             => 'Remember me',
            'required'          => false,
        ));

        $this->addElement('submit', 'submitBtn', array(
            'label'             => 'Login',
            'title'             => 'Submit button',
        ));

   }
}