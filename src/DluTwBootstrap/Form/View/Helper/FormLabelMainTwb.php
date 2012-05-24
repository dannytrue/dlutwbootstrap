<?php
namespace DluTwBootstrap\Form\View\Helper;
use Zend\Form\ElementInterface;

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
     *
     * Always generates a "for" statement, as we cannot assume the form input
     * will be provided in the $labelContent.
     *
     * @param  ElementInterface $element
     * @param  null|string $labelContent
     * @param  string $position
     * @param string $formType
     * @return string
     * @throws \Zend\Form\Exception\DomainException
     */
    public function __invoke(ElementInterface $element,
                             $labelContent = null,
                             $position = null,
                             $formType = null) {
        $this->setFormType($formType);
        return parent::__invoke($element, $labelContent, $position);
        /*
        $attributes = $element->getAttributes();
        //Class
        if(array_key_exists('class', $attributes)) {
            $class      = $attributes['class'];
        } else {
            $class      = '';
        }
        if($formType == Util::FORM_TYPE_HORIZONTAL) {
            $this->genUtil->addWord('control-label', $class);
        }
        if($class != '') {
            $attributes['class']    = $class;
        }
        //For
        $id = $this->getId($element);
        if (null === $id) {
            throw new \Zend\Form\Exception\DomainException(sprintf(
                                                    '%s expects the Element provided to have either a name or an id present; neither found',
                                                    __METHOD__
                                                ));
        }
        $attributes['for']          = $id;
        $openTag = $this->openTag($attributes);

        $label   = false;
        if (null === $labelContent || null !== $position) {
            $label = $element->getAttribute('label');
            if (null === $label) {
                throw new \Zend\Form\Exception\DomainException(sprintf(
                                                        '%s expects either label content as the second argument, or that the element provided has a label attribute; neither found',
                                                        __METHOD__
                                                    ));
            }
        }
        if ($label && $labelContent) {
            switch ($position) {
                case self::APPEND:
                    $labelContent .= $label;
                    break;
                case self::PREPEND:
                default:
                    $labelContent = $label . $labelContent;
                    break;
            }
        }
        if ($label && null === $labelContent) {
            $labelContent = $label;
        }
        return $openTag . $labelContent . $this->closeTag();
        */
    }
}