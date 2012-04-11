<?php
namespace DluTwBootstrap\Form;
use \Zend\Form\Form;

/**
 * Abstract Block Form
 * Responsibility: Base abstract class for all Twitter Bootstrap block forms (ie horizontal and vertical)
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
abstract class AbstractBlockForm extends AbstractForm
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
                                     '\DluTwBootstrap\Form\Element\Block',
                                     __DIR__ . '/Element/Block',
                                     $options);
        $this->addToPrefixPathOption(Form::DECORATOR,
                                     '\DluTwBootstrap\Form\Decorator',
                                     __DIR__ . '/Decorator',
                                     $options);
        parent::__construct($options);
    }
}