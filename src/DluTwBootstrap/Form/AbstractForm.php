<?php
namespace DluTwBootstrap\Form;
use \Zend\Form\Form;
use DluTwBootstrap\Form\Exception\OptionsTypeInvalidException;
use DluTwBootstrap\Form\Exception\PrefixPathTypeInvalidException;

/**
 * DluTwBootstrap Abstract Form
 * Responsibility: Base abstract class for all Twitter Bootstrap forms
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
abstract class AbstractForm extends Form
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
        $this->addToPrefixPathOption(Form::DECORATOR,
                                     '\DluTwBootstrap\Form\Decorator',
                                     __DIR__ . '/Decorator',
                                     $options);
        parent::__construct($options);
    }

    /**
     * Adds a prefix path configuration to the 'prefixPath' option
     * @param string $type
     * @param string $prefix
     * @param string $path
     * @param mixed $options
     * @throws Exception\OptionsTypeInvalidException|Exception\PrefixPathTypeInvalidException
     */
    protected function addToPrefixPathOption($type, $prefix, $path, &$options) {
        if(is_null($options)) {
            $options    = array();
        }
        if(!is_array($options)) {
            throw new OptionsTypeInvalidException('Invalid type of form options argument. Only arrays are supported.');
        }
        if(array_key_exists('prefixPath', $options)) {
            $prefixPath = $options['prefixPath'];
        } else {
            $prefixPath = array();
        }
        if(!is_array($prefixPath)) {
            throw new PrefixPathTypeInvalidException("Invalid type of 'prefixPath' options element. Only arrays are supported.");
        }
        $prefixPathConfigToAdd   = array(
            'type'      => $type,
            'prefix'    => $prefix,
            'path'      => $path,
        );
        array_unshift($prefixPath, $prefixPathConfigToAdd);
        $options['prefixPath']  = $prefixPath;
    }
}