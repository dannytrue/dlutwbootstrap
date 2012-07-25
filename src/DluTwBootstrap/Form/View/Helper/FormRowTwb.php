<?php
namespace DluTwBootstrap\Form\View\Helper;

use DluTwBootstrap\Form\View\Helper\FormHintTwb;
use DluTwBootstrap\Form\View\Helper\FormDescriptionTwb;
use DluTwBootstrap\Form\View\Helper\FormControlGroupTwb;
use DluTwBootstrap\Form\View\Helper\FormControlsTwb;
use DluTwBootstrap\Form\Exception\UnsupportedHelperTypeException;
use DluTwBootstrap\Form\Util;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use Zend\Form\View\Helper\AbstractHelper;

//TODO - refactor

class FormRowTwb extends AbstractHelper
{
    const LABEL_APPEND  = 'append';
    const LABEL_PREPEND = 'prepend';

    /**
     * @var string
     */
    protected $labelPosition = self::LABEL_PREPEND;

    /**
     * @var array
     */
    protected $labelAttributes;

    /**
     * @var FormLabel
     */
    protected $labelHelper;

    /**
     * @var FormElement
     */
    protected $elementHelper;

    /**
     * @var FormElementErrors
     */
    protected $elementErrorsHelper;

    /**
     * @var FormHintTwb
     */
    protected $hintHelper;

    /**
     * @var FormDescriptionTwb
     */
    protected $descriptionHelper;

    /**
     * @var FormControlGroupTwb
     */
    protected $controlGroupHelper;

    /**
     * @var FormControlsTwb
     */
    protected $controlsHelper;

    /**
     * Utility form helper that renders a label (if it exists), an element and errors
     *
     * @param ElementInterface $element
     * @param string $formType
     * @return string
     */
    public function render(ElementInterface $element, $formType)
    {
        $escapeHtmlHelper    = $this->getEscapeHtmlHelper();
        $labelHelper         = $this->getLabelHelper();
        $elementHelper       = $this->getElementHelper();
        $elementErrorsHelper = $this->getElementErrorsHelper();
        $hintHelper          = $this->getHintHelper();
        $descriptionHelper   = $this->getDescriptionHelper();

        $label               = $element->getLabel();
        $elementString       = $elementHelper->render($element);
        $hint                = $hintHelper->render($element);
        $description         = $descriptionHelper->render($element);
        $elementErrors       = $elementErrorsHelper->render($element);

        if ($formType == Util::FORM_TYPE_HORIZONTAL || $formType == Util::FORM_TYPE_VERTICAL) {
            $controlGroupHelper     = $this->getControlGroupHelper();
            $controlsHelper         = $this->getControlsHelper();
            $controlGroupOpen       = $controlGroupHelper->openTag($element);
            $controlGroupClose      = $controlGroupHelper->closeTag();
            $controlsOpen           = $controlsHelper->openTag($element);
            $controlsClose          = $controlsHelper->closeTag();
        } else {
            $controlGroupOpen       = '';
            $controlGroupClose      = '';
            $controlsOpen           = '';
            $controlsClose          = '';
        }

        if (!empty($label)) {
            $label = $escapeHtmlHelper($label);
            $labelAttributes = $element->getLabelAttributes();

            if (empty($labelAttributes)) {
                $labelAttributes = $this->labelAttributes;
            }

            // Multicheckbox elements have to be handled differently as the HTML standard does not allow nested
            // labels. The semantic way is to group them inside a fieldset
            $type = $element->getAttribute('type');
            if ($type === 'multi_checkbox' || $type === 'multicheckbox' || $type === 'radio') {
                $markup = sprintf(
                    '<fieldset><legend>%s</legend>%s</fieldset>',
                    $label,
                    $elementString);
            } else {
                if ($element->hasAttribute('id')) {
                    $labelOpen = $labelHelper($element);
                    $labelClose = '';
                    $label = '';
                } else {
                    $labelOpen  = $labelHelper->openTag($labelAttributes);
                    $labelClose = $labelHelper->closeTag();
                }

                switch ($this->labelPosition) {
                    case self::LABEL_PREPEND:
                        $markup = $labelOpen . $label . $elementString . $labelClose . $elementErrors;
                        break;
                    case self::LABEL_APPEND:
                    default:
                        $markup = $labelOpen . $elementString . $label . $labelClose . $elementErrors;
                        break;
                }
            }
        } else {
            $markup = $controlGroupOpen
                    . $elementString
                    . $controlsOpen
                    . $hint
                    . $description
                    . $elementErrors
                    . $controlsClose
                    . $controlGroupClose;
        }

        return $markup;
    }

    /**
     * Invoke helper as a function
     * Proxies to {@link render()}.
     * @param null|ElementInterface $element
     * @param string $formType
     * @return string|FormRow
     */
    public function __invoke(ElementInterface $element = null, $formType) {
        if (!$element) {
            return $this;
        }
        return $this->render($element, );
    }

    /**
     * Set the label position
     *
     * @param $labelPosition
     * @return FormRow
     * @throws \Zend\Form\Exception\InvalidArgumentException
     */
    public function setLabelPosition($labelPosition)
    {
        $labelPosition = strtolower($labelPosition);
        if (!in_array($labelPosition, array(self::LABEL_APPEND, self::LABEL_PREPEND))) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects either %s::LABEL_APPEND or %s::LABEL_PREPEND; received "%s"',
                __METHOD__,
                __CLASS__,
                __CLASS__,
                (string) $labelPosition
            ));
        }
        $this->labelPosition = $labelPosition;

        return $this;
    }

    /**
     * Get the label position
     *
     * @return string
     */
    public function getLabelPosition()
    {
        return $this->labelPosition;
    }

    /**
     * Set the attributes for the row label
     *
     * @param  array $labelAttributes
     * @return FormRow
     */
    public function setLabelAttributes($labelAttributes)
    {
        $this->labelAttributes = $labelAttributes;
        return $this;
    }

    /**
     * Get the attributes for the row label
     *
     * @return array
     */
    public function getLabelAttributes()
    {
        return $this->labelAttributes;
    }

    /**
     * Retrieve the FormLabel helper
     *
     * @return FormLabel
     */
    protected function getLabelHelper()
    {
        if ($this->labelHelper) {
            return $this->labelHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->labelHelper = $this->view->plugin('form_label');
        }

        if (!$this->labelHelper instanceof FormLabel) {
            $this->labelHelper = new FormLabel();
        }

        return $this->labelHelper;
    }

    /**
     * Retrieve the FormElement helper
     *
     * @return FormElement
     */
    protected function getElementHelper()
    {
        if ($this->elementHelper) {
            return $this->elementHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementHelper = $this->view->plugin('form_element');
        }

        if (!$this->elementHelper instanceof FormElement) {
            $this->elementHelper = new FormElement();
        }

        return $this->elementHelper;
    }

    /**
     * Retrieve the FormElementErrors helper
     *
     * @return FormElementErrors
     */
    protected function getElementErrorsHelper()
    {
        if ($this->elementErrorsHelper) {
            return $this->elementErrorsHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementErrorsHelper = $this->view->plugin('form_element_errors');
        }

        if (!$this->elementErrorsHelper instanceof FormElementErrors) {
            $this->elementErrorsHelper = new FormElementErrors();
        }

        return $this->elementErrorsHelper;
    }

    /**
     * Retrieve the FormHintTwb helper
     * @return FormHintTwb
     * @throws \DluTwBootstrap\Form\Exception\UnsupportedHelperTypeException
     */
    protected function getHintHelper()
    {
        if (!$this->hintHelper) {
            if (method_exists($this->view, 'plugin')) {
                $this->hintHelper = $this->view->plugin('form_hint_twb');
            }
            if (!$this->hintHelper instanceof FormHintTwb) {
                throw new UnsupportedHelperTypeException('Hint helper (FormHintTwb) unavailable or unsupported type.');
            }
        }
        return $this->hintHelper;
    }

    /**
     * Retrieve the FormDescriptionTwb helper
     * @return FormDescriptionTwb
     * @throws \DluTwBootstrap\Form\Exception\UnsupportedHelperTypeException
     */
    protected function getDescriptionHelper()
    {
        if (!$this->descriptionHelper) {
            if (method_exists($this->view, 'plugin')) {
                $this->descriptionHelper = $this->view->plugin('form_description_twb');
            }
            if (!$this->descriptionHelper instanceof FormDescriptionTwb) {
                throw new UnsupportedHelperTypeException('Description helper (FormDescriptionTwb) unavailable or unsupported type.');
            }
        }
        return $this->descriptionHelper;
    }

    /**
     * Retrieve the FormControlGroupTwb helper
     * @return FormControlGroupTwb
     * @throws \DluTwBootstrap\Form\Exception\UnsupportedHelperTypeException
     */
    protected function getControlGroupHelper()
    {
        if (!$this->controlGroupHelper) {
            if (method_exists($this->view, 'plugin')) {
                $this->controlGroupHelper = $this->view->plugin('form_control_group_twb');
            }
            if (!$this->controlGroupHelper instanceof FormControlGroupTwb) {
                throw new UnsupportedHelperTypeException('Control group helper (FormControlGroupTwb) unavailable or unsupported type.');
            }
        }
        return $this->controlGroupHelper;
    }

    /**
     * Retrieve the FormControlsTwb helper
     * @return FormControlsTwb
     * @throws \DluTwBootstrap\Form\Exception\UnsupportedHelperTypeException
     */
    protected function getControlsHelper()
    {
        if (!$this->controlsHelper) {
            if (method_exists($this->view, 'plugin')) {
                $this->controlsHelper = $this->view->plugin('form_controls_twb');
            }
            if (!$this->controlsHelper instanceof FormControlsTwb) {
                throw new UnsupportedHelperTypeException('Controls helper (FormControlsTwb) unavailable or unsupported type.');
            }
        }
        return $this->controlsHelper;
    }

    /* ************************************** METHODS TO REFACTOR ************************************** */

    /**
     * Renders the full form element with descriptions, errors, etc.
     * @param ElementInterface $element
     * @param string $formType
     * @param InputInterface $input
     * @param array $displayOptions
     * @return string
     * @throws \DluTwBootstrap\Form\Exception\UnsupportedElementTypeException
     */
    public function render(ElementInterface $element,
                           $formType,
                           InputInterface $input = null,
                           array $displayOptions = array()) {
        //CSRF
        if ($element instanceof Element\Csrf) {
            $html   = $this->getBareElementWithErrorsMarkup($element, $displayOptions);
            return $html;
        }

        //TODO - captcha element
        $captcha    = $element->getAttribute('captcha');
        if (($element instanceof Element\Captcha) || (!empty($captcha))) {
            //$helper = $renderer->plugin('form_captcha');
            //return $helper($element);
            return '';
        }

        $type    = $element->getAttribute('type');

        switch ($type) {
            case 'hidden':
            case 'submit':
            case 'reset':
            case 'button':
                $html   = $this->getBareElementMarkup($element, $displayOptions);
                break;
            case 'text':
            case 'password':
            case 'textarea':
            case 'checkbox':
            case 'radio':
            case 'select':
            case 'file':
                if($formType == \DluTwBootstrap\Form\Util::FORM_TYPE_HORIZONTAL
                    || $formType == \DluTwBootstrap\Form\Util::FORM_TYPE_VERTICAL) {
                    $html   = $this->getFullElementMarkupForBlockForms($element, $formType, $input, $displayOptions);
                } else {
                    $html   = $this->getFullElementMarkupForInlineForms($element, $formType, $input, $displayOptions);
                }
                break;
            default:
                throw new UnsupportedElementTypeException("Element type '$type' not supported.");
                break;
        }
        return $html;
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface $element
     * @param string $formType
     * @param InputInterface $input
     * @param array $displayOptions
     * @return string
     */
    public function __invoke(ElementInterface $element,
                             $formType,
                             InputInterface $input = null,
                             array $displayOptions = array()) {
        return $this->render($element, $formType, $input, $displayOptions);
    }

    /**
     * Returns full html markup with label, descriptions and errors for block forms (vertical and horizontal)
     * @param ElementInterface $element
     * @param string $formType
     * @param null|InputInterface $input
     * @param array $displayOptions
     * @return string
     */
    protected function getFullElementMarkupForBlockForms(ElementInterface $element,
                                                         $formType,
                                                         InputInterface $input = null,
                                                         array $displayOptions = array()) {
        //Control Group - open
        $helper     = $this->getHelper('form_control_group_twb');
        $html       = $helper->openTag($element);
        //Label
        if($element->getAttribute('label')) {
            $helper     = $this->getHelper('form_label_main_twb');
            $html       .= "\n" . $helper($element, null, null, $formType, $input);
        }
        //Controls - open
        $html       .= "\n" . '<div class="controls">';
        //Element
        $helper     = $this->getHelper('form_element_twb');
        $html       .= "\n" . $helper($element, $displayOptions, $formType);
        //Inline Help
        if($element->getAttribute('inlineHelp')) {
            $helper = $this->getHelper('form_inline_help_twb');
            $html   .= "\n" . $helper($element);
        }
        //Description
        if($element->getAttribute('description')) {
            $helper = $this->getHelper('form_element_description_twb');
            $html   .= "\n" . $helper($element);
        }
        //Errors
        if(count($element->getMessages()) > 0) {
            $helper     = $this->getHelper('form_element_errors_twb');
            $html       .= "\n" . $helper($element);
        }
        //Controls - close
        $html       .= '</div>';
        //Control Group - close
        $helper     = $this->getHelper('form_control_group_twb');
        $html       .= $helper->closeTag();
        return $html;
    }

    /**
     * Returns full html markup for inline forms (inline and search)
     * @param ElementInterface $element
     * @param string $formType
     * @param null|InputInterface $input
     * @param array $displayOptions
     * @return string
     */
    protected function getFullElementMarkupForInlineForms(ElementInterface $element,
                                                          $formType,
                                                          InputInterface $input = null,
                                                          array $displayOptions = array()) {
        $html           = '';
        if($element->getAttribute('label')) {
            $helper     = $this->getHelper('form_label_main_twb');
            $html       .= $helper($element, null, null, $formType, $input);
        }
        $helper     = $this->getHelper('form_element_twb');
        $html       .= "\n" . $helper($element, $displayOptions, $formType);
        return $html;
    }

    /**
     * Returns the html markup for the sole element, ie no description, label or errors
     * @param ElementInterface $element
     * @param array $displayOptions
     * @return mixed
     */
    protected function getBareElementMarkup(ElementInterface $element, array $displayOptions = array()) {
        $helper     = $this->getHelper('form_element_twb');
        $html       = $helper($element, $displayOptions);
        return $html;
    }

    /**
     * Returns the html markup for the sole element including errors, but w/o description, label etc
     * @param ElementInterface $element
     * @param array $displayOptions
     * @return mixed
     */
    protected function getBareElementWithErrorsMarkup(ElementInterface $element, array $displayOptions = array()) {
        $helper     = $this->getHelper('form_element_twb');
        $html       = $helper($element, $displayOptions);
        $helper     = $this->getHelper('form_element_errors_twb');
        $html       .= "\n" . $helper($element);
        return $html;
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
