<?php
namespace DluTwBootstrap\Form;

/**
 * DemoInline Form
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class DemoInline extends Inline
{
    /**
     * Init form
     */
    public function init() {
        $this->setName('inlineForm');
        $this->setLegend('Inline Form Demo');
        $this->setAttrib('id', 'inline-form-demo');

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