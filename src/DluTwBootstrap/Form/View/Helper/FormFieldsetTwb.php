<?php
namespace DluTwBootstrap\Form\View\Helper;

use DluTwBootstrap\Form\Exception\UnsupportedElementTypeException;
use DluTwBootstrap\Form\FormUtil;

use Zend\Form\View\Helper\AbstractHelper as AbstractFormViewHelper;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\I18n\Translator\Translator;
use Zend\Form\FieldsetInterface;
use Zend\Form\ElementInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Form Fieldset
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormFieldsetTwb extends AbstractFormViewHelper implements TranslatorAwareInterface
{
    /**
     * @var FormUtil
     */
    protected $formUtil;

    /* **************************** METHODS ****************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\Form\FormUtil $formUtil
     */
    public function __construct(FormUtil $formUtil)
    {
        $this->formUtil = $formUtil;
    }

    /**
     * Returns the fieldset opening tag and legend tag, if legend is defined
     * @param FieldsetInterface $fieldset
     * @param string|null $formType
     * @param array $displayOptions
     * @return string
     */
    public function openTag(FieldsetInterface $fieldset, $formType = null, array $displayOptions = array()) {
        if(is_null($formType)) {
            $formType           = $this->formUtil->getDefaultFormType();
        }
        if (array_key_exists('class', $displayOptions)) {
            $class  = ' class="' . $displayOptions['class'] . '"';
        } else {
            $class  = '';
        }
        $html   = sprintf('<fieldset%s>', $class);
        $legend = $fieldset->getAttribute('legend');
        if($legend && ($formType == FormUtil::FORM_TYPE_HORIZONTAL
                || $formType == FormUtil::FORM_TYPE_VERTICAL)) {
            //Translate
            if (null !== ($translator = $this->getTranslator())) {
                $legend = $translator->translate($legend, $this->getTranslatorTextDomain());
            }
            //Escape
            $escapeHelper   = $this->getEscapeHtmlHelper();
            $legend         = $escapeHelper($legend);
            $html           .= "<legend>$legend</legend>";
        }
        return $html;
    }

    /**
     * Returns the fieldset closing tag
     * @return string
     */
    public function closeTag() {
        return '</fieldset>';
    }

    /**
     * @param FieldsetInterface $fieldset
     * @param string|null $formType
     * @param array $displayOptions
     * @param InputFilterInterface|null $inputFilter
     * @param bool $displayButtons
     * @return string
     * @throws UnsupportedElementTypeException
     */
    public function content(FieldsetInterface $fieldset,
                            $formType = null,
                            array $displayOptions = array(),
                            InputFilterInterface $inputFilter = null,
                            $displayButtons = true
    ) {
        $renderer = $this->getView();
        if (!method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }
        if(is_null($formType)) {
            $formType           = $this->formUtil->getDefaultFormType();
        }
        $rowHelper  = $renderer->plugin('form_row_twb');
        $iterator   = $fieldset->getIterator();
        $html       = '';
        //Iterate over all fieldset elements and render them
        foreach($iterator as $elementOrFieldset) {
            if ($elementOrFieldset instanceof FieldsetInterface) {
                //Fieldset
                /* @var $elementOrFieldset FieldsetInterface */
                $html   .= "\n" . $this->render($elementOrFieldset, $formType, $displayOptions, $inputFilter, true);
            } elseif ($elementOrFieldset instanceof ElementInterface) {
                //Element
                /* @var $element ElementInterface */
                if(!$displayButtons && in_array($elementOrFieldset->getAttribute('type'), array('submit', 'reset', 'button'))) {
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
                //TODO - include input
                $html   .= "\n" . $rowHelper($elementOrFieldset, $formType, $elemDisplayOptions);
            } else {
                //Unsupported item type
                throw new UnsupportedElementTypeException('Fieldsets may contain only fieldsets or elements.');
            }
        }
        return $html;
    }

    /**
     * @param FieldsetInterface $fieldset
     * @param string|null $formType
     * @param array $displayOptions
     * @param null|InputFilterInterface $inputFilter
     * @param bool $displayButtons
     * @return string
     */
    public function render(FieldsetInterface $fieldset,
                           $formType = null,
                           array $displayOptions = array(),
                           InputFilterInterface $inputFilter = null,
                           $displayButtons = true
    ) {
        if(is_null($formType)) {
            $formType           = $this->formUtil->getDefaultFormType();
        }
        $html   = $this->openTag($fieldset, $formType, $displayOptions);
        $html   .= "\n" . $this->content($fieldset, $formType, $displayOptions, $inputFilter, $displayButtons);
        $html   .= "\n" . $this->closeTag();
        return $html;
    }

    /**
     * @param FieldsetInterface|null $fieldset
     * @param string|null $formType
     * @param array $displayOptions
     * @param null|InputFilterInterface $inputFilter
     * @param bool $displayButtons
     * @return string
     */
    public function __invoke(FieldsetInterface $fieldset = null,
                             $formType = null,
                             array $displayOptions = array(),
                             InputFilterInterface $inputFilter = null,
                             $displayButtons = true
    ) {
        if(is_null($fieldset)) {
            return $this;
        }
        return $this->render($fieldset, $formType, $displayOptions, $inputFilter, $displayButtons);
    }
}