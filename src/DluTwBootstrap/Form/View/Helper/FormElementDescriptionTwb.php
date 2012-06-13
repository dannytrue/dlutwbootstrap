<?php
namespace DluTwBootstrap\Form\View\Helper;
use \Zend\Form\ElementInterface;

/**
 * Form Element Description
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormElementDescriptionTwb extends \Zend\Form\View\Helper\AbstractHelper
{
    /**
     * Which element types support the description?
     * @var array
     */
    protected $supportedTypes   = array(
        'text',
        'password',
        'textarea',
        'checkbox',
        'radio',
        'select',
        'file',
    );

    /* **************************** METHODS ****************************** */

    /**
     * Render a description from the provided $element
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element) {
        $type           = $element->getAttribute('type');
        if(!in_array($type, $this->supportedTypes)) {
            return '';
        }
        $escapeHelper   = $this->getEscapeHelper();
        $html           = '';
        //Description
        if($element->getAttribute('description')) {
            $html   = '<p class="help-block">' . $escapeHelper($element->getAttribute('description')) . '</p>';
        }
        return $html;
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface $element
     * @return string
     */
    public function __invoke(ElementInterface $element) {
        return $this->render($element);
    }
}