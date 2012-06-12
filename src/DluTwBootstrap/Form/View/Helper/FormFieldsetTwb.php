<?php
namespace DluTwBootstrap\Form\View\Helper;

use DluTwBootstrap\Form\Exception\UnsupportedElementTypeException;
use Zend\Form\FieldsetInterface;
use Zend\Form\ElementInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Loader\Pluggable;

class FormFieldsetTwb extends \Zend\Form\View\Helper\AbstractHelper
{
    /**
     * Helpers instantiated so far
     * @var array
     */
    protected $helperInstances  = array();

    /* **************************** METHODS ****************************** */

    public function openTag(FieldsetInterface $fieldset, $formType) {
        $html   = '<fieldset>';
        $legend = $fieldset->getAttribute('legend');
        if($legend && ($formType == \DluTwBootstrap\Form\Util::FORM_TYPE_HORIZONTAL
                || $formType == \DluTwBootstrap\Form\Util::FORM_TYPE_VERTICAL)) {
            $escapeHelper   = $this->getEscapeHelper();
            $legend         = $escapeHelper($legend);
            $html           .= "<legend>$legend</legend>";
        }
        return $html;
    }

    public function closeTag() {
        return '</fieldset>';
    }

    /**
     * @param FieldsetInterface $fieldset
     * @param string $formType
     * @param null|InputFilterInterface $inputFilter
     * @param array $displayOptions
     * @param boolean $ignoreButtons
     * @return string
     * @throws \DluTwBootstrap\Form\Exception\UnsupportedElementTypeException
     */
    public function content(FieldsetInterface $fieldset,
                            $formType,
                            InputFilterInterface $inputFilter = null,
                            array $displayOptions = array(),
                            $ignoreButtons = false) {
        $iterator       = $fieldset->getIterator();
        $helperElemFull = $this->getHelper('form_element_full_twb');
        $html           = '';
        foreach($iterator as $elementOrFieldset) {
            if($elementOrFieldset instanceof FieldsetInterface) {
                //Fieldset
                /* @var $elementOrFieldset FieldsetInterface */
                $html   .= "\n" . $this->render($elementOrFieldset, $formType, $inputFilter, $displayOptions);
            } elseif ($elementOrFieldset instanceof ElementInterface) {
                //Element
                /* @var $elementOrFieldset ElementInterface */
                if($ignoreButtons && in_array($elementOrFieldset->getAttribute('type'), array('submit', 'reset', 'button'))) {
                    //We should ignore 'button' elements and this is a 'button' element, so skip the rest of the iteration
                    continue;
                }
                $elementName    = $elementOrFieldset->getName();
                //Get input
                if($inputFilter && $inputFilter->has($elementName)) {
                    $input  = $inputFilter->get($elementName);
                } else {
                    $input  = null;
                }
                //Get display options
                if(array_key_exists($elementName, $displayOptions)) {
                    $elemDisplayOptions = $displayOptions[$elementName];
                } else {
                    $elemDisplayOptions = array();
                }
                $html   .= "\n" . $helperElemFull($elementOrFieldset, $formType, $input, $elemDisplayOptions);
            } else {
                throw new UnsupportedElementTypeException('Fieldsets may contain only fieldsets or elements.');
            }
        }
        return $html;
    }

    /**
     * @param FieldsetInterface $fieldset
     * @param string $formType
     * @param null|InputFilterInterface $inputFilter
     * @param array $displayOptions
     * @return string
     */
    public function render(FieldsetInterface $fieldset,
                           $formType,
                           InputFilterInterface $inputFilter = null,
                           array $displayOptions = array()) {
        $html   = $this->openTag($fieldset, $formType);
        $html   .= "\n" . $this->content($fieldset, $formType, $inputFilter, $displayOptions);
        $html   .= "\n" . $this->closeTag();
        return $html;
    }

    /**
     * @param FieldsetInterface $fieldset
     * @param string $formType
     * @param null|InputFilterInterface $inputFilter
     * @param array $displayOptions
     * @return string
     */
    public function __invoke(FieldsetInterface $fieldset = null,
                             $formType = null,
                             InputFilterInterface $inputFilter = null,
                             array $displayOptions = array()) {
        if(is_null($fieldset)) {
            return $this;
        }
        return $this->render($fieldset, $formType, $inputFilter, $displayOptions);
    }

   /**
     * Retrieves and caches a view helper
     * @param $helperName
     * @return \callable
     */
    protected function getHelper($helperName) {
        if(!array_key_exists($helperName, $this->helperInstances)) {
            $renderer   = $this->getView();
            $helper     = $renderer->plugin($helperName);
            $this->helperInstances[$helperName] = $helper;
        }
        return $this->helperInstances[$helperName];
    }
}