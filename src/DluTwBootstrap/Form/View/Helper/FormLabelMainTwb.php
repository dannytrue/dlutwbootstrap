<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface,
    Zend\InputFilter\InputInterface;

class FormLabelMainTwb extends AbstractFormLabel
{

    /* ************************ METHODS ***************************** */

    /**
     * Adds attributes specific for this helper
     * @param array $attributes
     * @return array
     */
    protected function garnishAttributes(array $attributes) {
        if($this->formType == \DluTwBootstrap\Form\Util::FORM_TYPE_HORIZONTAL) {
            $attributes = $this->genUtil->addWordToArrayItem('control-label', $attributes, 'class');
        }
        return $attributes;
    }


    /**
     * Generate a form label, optionally with content
     * Always generates a "for" statement, as we cannot assume the form input
     * will be provided in the $labelContent.
     * @param  ElementInterface $element
     * @param  null|string $labelContent
     * @param  string $position
     * @param string $formType
     * @param $input
     * @return string
     * @throws \Zend\Form\Exception\DomainException
     */
    public function __invoke(ElementInterface $element,
                             $labelContent = null,
                             $position = null,
                             $formType = null,
                             $input = null) {
        $this->setFormType($formType);
        if($input instanceof InputInterface) {
            /* @var $input InputInterface */
            if($input->isRequired()) {
                $attributes = $element->getAttributes();
                $attributes = $this->genUtil->addWordToArrayItem('required', $attributes, 'class');
                $element->setAttributes($attributes);
            }
        }
        return parent::__invoke($element, $labelContent, $position);
   }
}