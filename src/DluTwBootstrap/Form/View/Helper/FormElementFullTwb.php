<?php
namespace DluTwBootstrap\Form\View\Helper;

use \DluTwBootstrap\Form\Exception\UnsupportedElementTypeException;
use Zend\Form\ElementInterface;
use Zend\InputFilter\InputInterface;
use Zend\Form\Element;

/**
 * Form Element Full
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormElementFullTwb extends \Zend\Form\View\Helper\AbstractHelper
{
    /**
     * Helpers instantiated so far
     * @var array
     */
    protected $helperInstances  = array();

    /* **************************** METHODS ****************************** */

    /**
     * Renders the full form element with descriptions, errors, etc.
     * @param ElementInterface $element
     * @param string $formType
     * @param InputInterface $input
     * @param array $displayOptions
     * @return string
     * @throws \DluTwBootstrap\Form\Exception\UnsupportedElementTypeException
     */
    public function render(ElementInterface $element,
                           $formType,
                           InputInterface $input = null,
                           array $displayOptions = array()) {
        //CSRF
        if ($element instanceof Element\Csrf) {
            $html   = $this->getBareElementWithErrorsMarkup($element, $displayOptions);
            return $html;
        }

        //TODO - captcha element
        $captcha    = $element->getAttribute('captcha');
        if (($element instanceof Element\Captcha) || (!empty($captcha))) {
            //$helper = $renderer->plugin('form_captcha');
            //return $helper($element);
            return '';
        }

        $type    = $element->getAttribute('type');

        switch ($type) {
            case 'hidden':
            case 'submit':
            case 'reset':
            case 'button':
                $html   = $this->getBareElementMarkup($element, $displayOptions);
                break;
            case 'text':
            case 'password':
            case 'textarea':
            case 'checkbox':
            case 'radio':
            case 'select':
            case 'file':
                if($formType == \DluTwBootstrap\Form\FormUtil::FORM_TYPE_HORIZONTAL
                   || $formType == \DluTwBootstrap\Form\FormUtil::FORM_TYPE_VERTICAL) {
                    $html   = $this->getFullElementMarkupForBlockForms($element, $formType, $input, $displayOptions);
                } else {
                    $html   = $this->getFullElementMarkupForInlineForms($element, $formType, $input, $displayOptions);
                }
                break;
            default:
                throw new UnsupportedElementTypeException("Element type '$type' not supported.");
                break;
        }
        return $html;
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface $element
     * @param string $formType
     * @param InputInterface $input
     * @param array $displayOptions
     * @return string
     */
    public function __invoke(ElementInterface $element,
                             $formType,
                             InputInterface $input = null,
                             array $displayOptions = array()) {
        return $this->render($element, $formType, $input, $displayOptions);
    }

    /**
     * Returns full html markup with label, descriptions and errors for block forms (vertical and horizontal)
     * @param ElementInterface $element
     * @param string $formType
     * @param null|InputInterface $input
     * @param array $displayOptions
     * @return string
     */
    protected function getFullElementMarkupForBlockForms(ElementInterface $element,
                                              $formType,
                                              InputInterface $input = null,
                                              array $displayOptions = array()) {
        //Control Group - open
        $helper     = $this->getHelper('form_control_group_twb');
        $html       = $helper->openTag($element);
        //Label
        if($element->getAttribute('label')) {
            $helper     = $this->getHelper('form_label_main_twb');
            $html       .= "\n" . $helper($element, null, null, $formType, $input);
        }
        //Controls - open
        $html       .= "\n" . '<div class="controls">';
        //Element
        $helper     = $this->getHelper('form_element_twb');
        $html       .= "\n" . $helper($element, $displayOptions, $formType);
        //Inline Help
        if($element->getAttribute('inlineHelp')) {
            $helper = $this->getHelper('form_inline_help_twb');
            $html   .= "\n" . $helper($element);
        }
        //Description
        if($element->getAttribute('description')) {
            $helper = $this->getHelper('form_element_description_twb');
            $html   .= "\n" . $helper($element);
        }
        //Errors
        if(count($element->getMessages()) > 0) {
            $helper     = $this->getHelper('form_element_errors_twb');
            $html       .= "\n" . $helper($element);
        }
        //Controls - close
        $html       .= '</div>';
        //Control Group - close
        $helper     = $this->getHelper('form_control_group_twb');
        $html       .= $helper->closeTag();
        return $html;
    }

    /**
     * Returns full html markup for inline forms (inline and search)
     * @param ElementInterface $element
     * @param string $formType
     * @param null|InputInterface $input
     * @param array $displayOptions
     * @return string
     */
    protected function getFullElementMarkupForInlineForms(ElementInterface $element,
                                              $formType,
                                              InputInterface $input = null,
                                              array $displayOptions = array()) {
        $html           = '';
        if($element->getAttribute('label')) {
            $helper     = $this->getHelper('form_label_main_twb');
            $html       .= $helper($element, null, null, $formType, $input);
        }
        $helper     = $this->getHelper('form_element_twb');
        $html       .= "\n" . $helper($element, $displayOptions, $formType);
        return $html;
    }

    /**
     * Returns the html markup for the sole element, ie no description, label or errors
     * @param ElementInterface $element
     * @param array $displayOptions
     * @return mixed
     */
    protected function getBareElementMarkup(ElementInterface $element, array $displayOptions = array()) {
        $helper     = $this->getHelper('form_element_twb');
        $html       = $helper($element, $displayOptions);
        return $html;
    }

    /**
     * Returns the html markup for the sole element including errors, but w/o description, label etc
     * @param ElementInterface $element
     * @param array $displayOptions
     * @return mixed
     */
    protected function getBareElementWithErrorsMarkup(ElementInterface $element, array $displayOptions = array()) {
        $helper     = $this->getHelper('form_element_twb');
        $html       = $helper($element, $displayOptions);
        $helper     = $this->getHelper('form_element_errors_twb');
        $html       .= "\n" . $helper($element);
        return $html;
    }

    /**
     * Retrieves and caches a view helper
     * @param $helperName
     * @return \callable
     */
    protected function getHelper($helperName) {
        if(!array_key_exists($helperName, $this->helperInstances)) {
            $renderer   = $this->getView();
            $helper     = $renderer->plugin($helperName);
            $this->helperInstances[$helperName] = $helper;
        }
        return $this->helperInstances[$helperName];
    }
}