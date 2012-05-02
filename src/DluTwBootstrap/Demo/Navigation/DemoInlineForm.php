<?php
namespace DluTwBootstrap\Demo\Navigation;

use DluTwBootstrap\Form\Inline;
/**
 * DemoSearch Form for Navbar
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class DemoInlineForm extends Inline
{
    /**
     * Init form
     */
    public function init() {
        $this->setName('inlineForm');
        $this->addElement('text', 'username', array(
            'placeholderText'   => 'Username',
            'required'          => true,
            'filters'           => array(
                'stringTrim'
            ),
        ));

        $this->addElement('text', 'password', array(
            'placeholderText'   => 'Password',
            'required'          => true,
            'filters'           => array(
                'stringTrim'
            ),
        ));

        $this->addElement('submit', 'submitBtn', array(
            'label'             => 'Go!',
            'title'             => 'Submit button',
        ));
   }
}