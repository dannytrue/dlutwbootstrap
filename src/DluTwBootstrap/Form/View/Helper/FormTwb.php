<?php
namespace DluTwBootstrap\Form\View\Helper;

use DluTwBootstrap\Form\Exception\UnsupportedElementDisplayOptionsTypeException;
use DluTwBootstrap\Form\Exception\UnsupportedDispSpecException;
use DluTwBootstrap\Form\Exception\UnsupportedFormTypeException;
use DluTwBootstrap\Form\Exception\UndefinedFormElementException;
use DluTwBootstrap\Util\Util as GenUtil;
use Zend\Form\Form;
use Zend\Form\ElementInterface;
use Zend\Form\FormInterface;

class FormTwb extends \Zend\Form\View\Helper\Form
{
    /**
     * Default form type if not explicitly given
     * @var string
     */
    const DEFAULT_FORM_TYPE     = \DluTwBootstrap\Form\Util::FORM_TYPE_HORIZONTAL;

    /**
     * Mapping of form types to form css classes
     * @var array
     */
    protected $formTypeMap      = array(
        \DluTwBootstrap\Form\Util::FORM_TYPE_HORIZONTAL => 'form-horizontal',
        \DluTwBootstrap\Form\Util::FORM_TYPE_VERTICAL   => 'form-vertical',
        \DluTwBootstrap\Form\Util::FORM_TYPE_INLINE     => 'form-inline',
        \DluTwBootstrap\Form\Util::FORM_TYPE_SEARCH     => 'form-search',
    );

    /**
     * Helpers instantiated so far
     * @var array
     */
    protected $helperInstances  = array();

    /**
     * @var GenUtil
     */
    protected $genUtil;

    /* **************************** METHODS ****************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\Util\Util $genUtil
     */
    public function __construct(GenUtil $genUtil) {
        $this->genUtil  = $genUtil;
    }

    /**
     * Invoke as function
     * @param Form|null $form
     * @param string|array|null $dispSpec
     * @return FormTwb|string
     */
    public function __invoke(Form $form = null, $dispSpec = null) {
        if(is_null($form)) {
            return $this;
        }
        return $this->render($form, $dispSpec);
    }

    /**
     * Renders a quick form
     * @param Form $form
     * @param string|array|null $dispSpec
     * @return string
     */
    public function render(Form $form, $dispSpec = null) {
        if(is_array($dispSpec)) {
            //Display configuration given
            $formDisplayConfig  = $dispSpec;
            if(array_key_exists('formType', $formDisplayConfig)) {
                $formType           = $formDisplayConfig['formType'];
            } else {
                $formType           = self::DEFAULT_FORM_TYPE;
            }
        } elseif(is_string($dispSpec)) {
            //Form type is given
            $formDisplayConfig  = null;
            $formType           = $dispSpec;
        } elseif(is_null($dispSpec)) {
            //No dispSpec given, use default form type
            $formDisplayConfig  = null;
            $formType           = self::DEFAULT_FORM_TYPE;
        } else {
            //Unsupported $dispSpec
            throw new UnsupportedDispSpecException('Unsupported form display specification (dispSpec).');
        }
        $html   = $this->openTag($form, $formType);
        if(is_null($formDisplayConfig)) {
            //No display configuration specified, do a quick form
            $html   .= $this->fieldset($form, $formType);
            $html   .= $this->actions($form, $formType);
        } else {
            //Display configuration is specified
        }
        $html   .= $this->closeTag();
        return $html;
    }

    /**
     * Returns the form actions (ie form buttons section)
     * @param Form $form
     * @param string $formType
     * @param array|null $elements
     * @return string
     */
    public function actions(Form $form, $formType, array $elements = null) {
        $formIterator   = $form->getIterator();
        $html           = '<div class="form-actions">';
        $helper         = $this->getHelper('form_element_full_twb');
        if(is_null($elements)) {
            //Iterate over all form elements and render only buttons
            foreach($formIterator as $element) {
                /* @var $element ElementInterface */
                $elementName    = $element->getName();
                $elementType    = $element->getAttribute('type');
                if(in_array($elementType, array('submit', 'reset', 'button',))) {
                    //Either no elements specified (ie take all 'button type' elements) or the element is present in the $elements array
                    $html   .= "\n" . $helper($element, $formType);
                }
            }
        } else {
            //The elements are specified, use only the specified elements in this order
            foreach($elements as $elementName => $displayOptions) {
                if(!is_array($displayOptions)) {
                    $elementName    = $displayOptions;
                    $displayOptions = array();
                }
                $element        = $form->get($elementName);
                if(!$element) {
                    throw new UndefinedFormElementException("Undefined form element '$elementName'.");
                }
                $html   .= "\n" . $helper($element, $formType, null, $displayOptions);
            }
        }
        $html           .= "\n" . '</div>';
        return $html;
    }

    /**
     * Renders a fieldset
     * @param Form $form
     * @param string $formType
     * @param array|null $elements
     * @param string|null $fieldsetLegend
     * @return string
     * @throws \DluTwBootstrap\Form\Exception\UnsupportedElementDisplayOptionsTypeException
     */
    public function fieldset(Form $form, $formType, array $elements = null, $fieldsetLegend = null) {
        $html           = '<fieldset>';
        if($fieldsetLegend) {
            $html   .= "\n" . $this->fieldsetLegend($fieldsetLegend);
        }
        $helper         = $this->getHelper('form_element_full_twb');
        $inputFilter    = $form->getInputFilter();
        if(is_null($elements)) {
            //Iterate over all form elements and render them all except buttons
            $formIterator   = $form->getIterator();
            foreach($formIterator as $element) {
                if(($element instanceof ElementInterface)) {
                    /* @var $element ElementInterface */
                    $elementName    = $element->getName();
                    $elementType    = $element->getAttribute('type');
                    if(!in_array($elementType, array('submit', 'reset', 'button',))) {
                        //The element is not a button
                        //Get input
                        if($inputFilter && $inputFilter->has($elementName)) {
                            $input  = $inputFilter->get($elementName);
                        } else {
                            $input  = null;
                        }
                        $html   .= "\n" . $helper($element, $formType, $input);
                    }
                }
            }
        } else {
            //The elements are specified, use only the specified elements in this order
            foreach($elements as $elementName => $displayOptions) {
                if(!is_array($displayOptions)) {
                    $elementName    = $displayOptions;
                    $displayOptions = array();
                }
                $element        = $form->get($elementName);
                if(!$element) {
                    throw new UndefinedFormElementException("Undefined form element '$elementName'.");
                }
                //Get input
                if($inputFilter && $inputFilter->has($elementName)) {
                    $input  = $inputFilter->get($elementName);
                } else {
                    $input  = null;
                }
                //Get display options
                $html   .= "\n" . $helper($element, $formType, $input, $displayOptions);
            }
        }
        $html           .= '</fieldset>';
        return $html;
    }

    /**
     * Renders the form legend (escapes the output)
     * @param string $formLegend
     * @return string
     */
    public function fieldsetLegend($formLegend) {
        $escapeHelper   = $this->getEscapeHelper();
        $formLegend     = $escapeHelper($formLegend);
        $html   = "<legend>$formLegend</legend>";
        return $html;
    }

    /**
     * Generate an opening form tag
     * @param  null|FormInterface $form
     * @param null|string $formType
     * @return string
     */
    public function openTag(FormInterface $form = null, $formType = null) {
        if(is_null($formType)) {
            $formType   = self::DEFAULT_FORM_TYPE;
        }
        if(!array_key_exists($formType, $this->formTypeMap)) {
            throw new UnsupportedFormTypeException("Unsupported form type '$formType'.");
        }
        if($form) {
            $class  = $this->genUtil->addWord($this->formTypeMap[$formType], $form->getAttribute('class'));
            $form->setAttribute('class', $class);
        }
        return parent::openTag($form);
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