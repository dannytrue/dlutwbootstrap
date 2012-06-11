<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\Element;
use Zend\Form\ElementInterface;
use Zend\Loader\Pluggable;

class FormElementTwb extends \Zend\Form\View\Helper\FormElement
{
    /**
     * Render an element
     *
     * Introspects the element type and attributes to determine which
     * helper to utilize when rendering.
     *
     * @param  ElementInterface $element
     * @param array $displayOptions
     * @param string|null $formType
     * @return string
     */
    public function render(ElementInterface $element, array $displayOptions = array(), $formType = null)
    {
        $renderer = $this->getView();
        if (!$renderer instanceof Pluggable) {
            // Bail early if renderer is not pluggable
            return '';
        }

        if ($element instanceof Element\Captcha) {
            $helper = $renderer->plugin('form_captcha');
            return $helper($element);
        }

        if ($element instanceof Element\Csrf) {
            $helper = $renderer->plugin('form_input_twb');
            return $helper($element);
        }

        $type    = $element->getAttribute('type');
        $options = $element->getAttribute('options');
        $captcha = $element->getAttribute('captcha');

        if (!empty($captcha)) {
            $helper = $renderer->plugin('form_captcha');
            return $helper($element);
        }

        if (is_array($options) && $type == 'radio') {
            $helper = $renderer->plugin('form_radio_twb');
            return $helper($element, $this->getDisplayOption($displayOptions, 'inline'));
        }

        if (is_array($options) && $type == 'checkbox') {
            $helper = $renderer->plugin('form_multi_checkbox_twb');
            return $helper($element, $this->getDisplayOption($displayOptions, 'inline'));
        }

        if (is_array($options) && $type == 'select') {
            $helper = $renderer->plugin('form_select_twb');
            return $helper($element, $this->getDisplayOption($displayOptions, 'sizeClass'));
        }

        if ($type == 'textarea') {
            $helper = $renderer->plugin('form_textarea_twb');
            return $helper($element,
                           $this->getDisplayOption($displayOptions, 'sizeClass'),
                           $this->getDisplayOption($displayOptions, 'rows'));
        }

        $helper = $renderer->plugin('form_input_twb');
        return $helper($element, $this->getDisplayOption($displayOptions, 'sizeClass'), $formType);
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface $element
     * @param array $displayOptions
     * @param string|null $formType
     * @return string
     */
    public function __invoke(ElementInterface $element, array $displayOptions = array(), $formType = null) {
        return $this->render($element, $displayOptions, $formType);
    }

    /**
     * Returns an option from the options array, if undefined, returns the default value
     * @param array $displayOptions
     * @param $optionName
     * @param null $default
     * @return string
     */
    protected function getDisplayOption(array $displayOptions, $optionName, $default = null) {
        if(array_key_exists($optionName, $displayOptions)) {
            $option = $displayOptions[$optionName];
        } else {
            $option = $default;
        }
        return $option;
    }
}