<?php
namespace DluTwBootstrap\Form\View\Helper;

use \Zend\Form\ElementInterface;
use \DluTwBootstrap\GenUtil;

/**
 * Form Element Errors
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormElementErrorsTwb extends \Zend\Form\View\Helper\FormElementErrors
{
    /**
     * General utils
     * @var GenUtil
     */
    protected $genUtil;

    /* **************************** METHODS ****************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\GenUtil $genUtil
     */
    public function __construct(GenUtil $genUtil) {
        $this->genUtil  = $genUtil;
    }

    /**
     * Render validation errors for the provided $element
     * @param  ElementInterface $element
     * @param array $attributes
     * @return string
     */
    public function render(ElementInterface $element, array $attributes = array()) {
        $attributes = $this->genUtil->addWordToArrayItem('errors', $attributes, 'class');
        return parent::render($element, $attributes);
    }

}