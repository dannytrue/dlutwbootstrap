<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormTextareaTwb extends \Zend\Form\View\Helper\FormTextarea
{
    /**
     * Render a form <textarea> element from the provided $element
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element) {
        $html               = parent::render($element);
        $renderer           = $this->getView();
        //Inline help
        $inlineHelpHelper   = $renderer->plugin('form_inline_help_twb');
        $html               .= $inlineHelpHelper($element);
        //Description
        $descriptionHelper  = $renderer->plugin('form_element_description_twb');
        $html               .= $descriptionHelper($element);
        return $html;
    }

}