<?php
namespace DluTwBootstrap\Form;
use \Zend\Form\Form;

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