<?php
namespace DluTwBootstrap\Form\View\Helper;
use \Zend\Form\ElementInterface;

class FormInlineHelpTwb extends \Zend\Form\View\Helper\AbstractHelper
{
    /**
     * Which element types support the inline help?
     * @var array
     */
    protected $supportedTypes   = array(
        'text',
        'password',
        'textarea',
        'select',
        'file',
    );

    /* **************************** METHODS ****************************** */

    /**
     * Render a inline help from the provided $element
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
        //Inline help
        if($element->getAttribute('inlineHelp')) {
            $html   = '<span class="help-inline">' . $escapeHelper($element->getAttribute('inlineHelp')) . '</span>';
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