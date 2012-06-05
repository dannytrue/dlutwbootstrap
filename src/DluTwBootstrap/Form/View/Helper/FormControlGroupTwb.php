<?php
namespace DluTwBootstrap\Form\View\Helper;
use \Zend\Form\ElementInterface;

class FormControlGroupTwb extends \Zend\Form\View\Helper\AbstractHelper
{
    /* **************************** METHODS ****************************** */

    /**
     * Render an inline help from the provided $element
     * @param  ElementInterface $element
     * @param string $content
     * @return string
     */
    public function render(ElementInterface $element, $content) {
        $html   = $this->openTag($element);
        $html   .= "\n" . $content;
        $html   .= "\n" . $this->closeTag();
        return $html;
    }

    /**
     * Returns the control group open tag
     * @param ElementInterface $element
     * @return string
     */
    public function openTag(ElementInterface $element) {
        $class  = 'control-group';
        if($element->getMessages()) {
            $class  .= ' error';
        }
        $html   = '<div class="' . $class . '">';
        return $html;
    }

    /**
     * Returns the control group closing tag
     * @return string
     */
    public function closeTag() {
        return '</div>';
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface $element
     * @param string $content
     * @return string
     */
    public function __invoke(ElementInterface $element = null, $content = null) {
        if(is_null($element)) {
            return $this;
        } else {
            return $this->render($element, $content);
        }
    }
}