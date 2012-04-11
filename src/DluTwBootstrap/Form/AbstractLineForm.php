<?php
namespace DluTwBootstrap\Form;
use \Zend\Form\Form;

/**
 * Abstract Line Form
 * Responsibility: Base abstract class for all Twitter Bootstrap line forms (ie inline and search)
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
abstract class AbstractLineForm extends AbstractForm
{
    /* *********************** METHODS ************************ */

    /**
     * Constructor
     * @param mixed $options
     */
    public function __construct($options = null) {
        $this->addToPrefixPathOption(Form::ELEMENT,
                                     '\DluTwBootstrap\Form\Element',
                                     __DIR__ . '/Element',
                                     $options);
        $this->addToPrefixPathOption(Form::ELEMENT,
                                     '\DluTwBootstrap\Form\Element\Line',
                                     __DIR__ . '/Element/Line',
                                     $options);
        $this->addToPrefixPathOption(Form::DECORATOR,
                                     '\DluTwBootstrap\Form\Decorator',
                                     __DIR__ . '/Decorator',
                                     $options);
        parent::__construct($options);
    }
}