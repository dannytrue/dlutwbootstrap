<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormLabel;
use Zend\Form\ElementInterface;

/**
 * FormLabelTwb
 */
class FormLabelMultiOptionTwb extends FormLabel
{
    /**
     * Generate a form label, optionally with content
     * Always generates a "for" statement, as we cannot assume the form input
     * will be provided in the $labelContent.
     * @param  ElementInterface $element
     * @param  null|string $labelContent
     * @return string|FormLabel
     */
    public function __invoke(ElementInterface $element = null, $labelContent = null) {
        return parent::__invoke($element, $labelContent, self::APPEND);
    }
}