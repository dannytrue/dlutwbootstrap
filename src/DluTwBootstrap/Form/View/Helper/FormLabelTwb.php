<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormLabel;
use Zend\Form\ElementInterface;
use Zend\Form\Exception\DomainException;

/**
 * FormLabelTwb
 */
class FormLabelTwb extends FormLabel
{
    /**
     * Generate a form label from an element
     * @param  ElementInterface $element
     * @throws \Zend\Form\Exception\DomainException
     * @return string|FormLabelTwb
     */
    public function __invoke(ElementInterface $element = null)
    {
        if (!$element) {
            return $this;
        }
        $labelContent   = $element->getLabel();
        if (empty($labelContent)) {
            throw new DomainException(sprintf('%s: No label set in the element.', __METHOD__));
        }
        //Translate
        if (null !== ($translator = $this->getTranslator())) {
            $labelContent = $translator->translate($labelContent, $this->getTranslatorTextDomain());
        }
        //Escape
        $escaperHtml    = $this->getEscapeHtmlHelper();
        $labelContent   = $escaperHtml($labelContent);
        return parent::__invoke($element, $labelContent);
    }
}