<?php
namespace DluTwBootstrap\Form;
use \Zend\Form\Form;

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