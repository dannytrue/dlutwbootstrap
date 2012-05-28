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
     * @return string
     */
    public function render(ElementInterface $element)
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
            return $helper($element);
        }

        if (is_array($options) && $type == 'checkbox') {
            $helper = $renderer->plugin('form_multi_checkbox_twb');
            return $helper($element);
        }

        if (is_array($options) && $type == 'select') {
            $helper = $renderer->plugin('form_select_twb');
            return $helper($element);
        }

        if ($type == 'textarea') {
            $helper = $renderer->plugin('form_textarea_twb');
            return $helper($element);
        }


        $helper = $renderer->plugin('form_input_twb');
        return $helper($element);
    }

    /**
     * Invoke helper as function
     *
     * Proxies to {@link render()}.
     *
     * @param  ElementInterface $element
     * @return string
     */
    public function __invoke(ElementInterface $element)
    {
        return $this->render($element);
    }
}