<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper as AbstractViewHelper;

/**
 * Form Actions Twb
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormActionsTwb extends AbstractViewHelper
{
    /* **************************** METHODS ****************************** */

    /**
     * Renders the form-actions div tag
     * @param string|array $content Either a string or an array of elements
     * @param null|string $formType
     * @param array $displayConfig
     * @return string
     */
    public function render($content, $formType = null, array $displayConfig = array())
    {
        if (is_array($content)) {
            $renderer = $this->getView();
            if (!method_exists($renderer, 'plugin')) {
                // Bail early if renderer is not pluggable
                return '';
            }
            $elementViewHelper  = $renderer->plugin('form_element_twb');
            /* @var $elementViewHelper FormElementTwb */
            $renderedElements   = array();
            foreach ($content as $element) {
                if (!($element instanceof ElementInterface)) {
                    //Only objects of type ElementInterface are accepted as content
                    return '';
                }
                if (array_key_exists($element->getName(), $displayConfig)) {
                    $elemDisplayConfig  = $displayConfig[$element->getName()];
                } else {
                    $elemDisplayConfig  = array();
                }
                $renderedElements[] = $elementViewHelper->render($element, $formType, $elemDisplayConfig);
            }
            $content    = implode("\n", $renderedElements);
        }
        if (!is_string($content)) {
            //Unsupported content type
            return '';
        }
        $html   = $this->openTag();
        $html   .= "\n" . $content;
        $html   .= "\n" . $this->closeTag();
        return $html;
    }

    /**
     * Returns the form-actions open tag
     * @param null|string $formType
     * @param array $displayConfig
     * @return string
     */
    public function openTag($formType = null, array $displayConfig = array())
    {
        $class  = 'form-actions';
        $html   = '<div class="' . $class . '">';
        return $html;
    }

    /**
     * Returns the control group closing tag
     * @return string
     */
    public function closeTag()
    {
        return '</div>';
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param string|array|null $content
     * @param null|string $formType
     * @param array $displayConfig
     * @return string|FormActionsTwb
     */
    public function __invoke($content = null, $formType = null, array $displayConfig = array())
    {
        if (is_null($content)) {
            return $this;
        }
        return $this->render($content, $formType, $displayConfig);
    }
}