<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\Form;
use Zend\Form\ElementInterface;

class FormTwb extends \Zend\Form\View\Helper\Form
{
    /**
     * ElementFull helper
     * @var FormElementFullTwb
     */
    protected $helper;

    /* **************************** METHODS ****************************** */

    /**
     * Invoke as function
     * @param Form $form
     * @param string $formType
     * @return FormTwb|string
     */
    public function __invoke(Form $form = null, $formType = null) {
        if(is_null($form)) {
            return $this;
        }
        //TODO - implement quick form
        throw new \Exception('Implement quick form');
    }

    /**
     * Returns the form actions (ie form buttons section)
     * @param Form $form
     * @param string $formType
     * @return string
     */
    public function formActions(Form $form, $formType) {
        $formIterator   = $form->getIterator();
        $html           = '<div class="form-actions">';
        $helper         = $this->getElementFullHelper();
        foreach($formIterator as $element) {
            if(($element instanceof ElementInterface) && ($element->getAttribute('actionElement') == true)) {
                $html   .= "\n" . $helper($element, $formType);
            }
        }
        $html           .= "\n" . '</div>';
        return $html;
    }

    /**
     * Generates quick markup for all form elements
     * @param Form $form
     * @param string $formType
     * @return string
     */
    public function formElements(Form $form, $formType) {
        $formIterator   = $form->getIterator();
        $html           = '';
        $helper         = $this->getElementFullHelper();
        $inputFilter    = $form->getInputFilter();
        foreach($formIterator as $element) {
            if(($element instanceof ElementInterface) && ($element->getAttribute('actionElement') != true)) {
                /* @var $element ElementInterface */
                if($inputFilter && $inputFilter->has($element->getName())) {
                    $input  = $inputFilter->get($element->getName());
                } else {
                    $input  = null;
                }
                $html   .= "\n" . $helper($element, $formType, $input);
            }
        }
        return $html;
    }

    /**
     * Retrieves and caches the FormElementFullTwb view helper
     * @return FormElementFullTwb
     */
    protected function getElementFullHelper() {
        if(is_null($this->helper)) {
            $renderer       = $this->getView();
            $this->helper   = $renderer->plugin('form_element_full_twb');
        }
        return $this->helper;
    }
}