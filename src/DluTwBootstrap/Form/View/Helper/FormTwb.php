<?php
namespace DluTwBootstrap\Form\View\Helper;

use DluTwBootstrap\Form\Exception\UnsupportedFormTypeException;
use DluTwBootstrap\Form\Exception\UndefinedFormElementException;
use DluTwBootstrap\Util as GenUtil;
use Zend\Form\Form;
use Zend\Form\ElementInterface;
use Zend\Form\FormInterface;

/**
 * Form
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
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
     * General utils
     * @var GenUtil
     */
    protected $genUtil;

    /* **************************** METHODS ****************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\Util $genUtil
     */
    public function __construct(GenUtil $genUtil) {
        $this->genUtil  = $genUtil;
    }

    /**
     * @param null|Form $form
     * @param null|string $formType
     * @param array $dispSpec
     * @return FormTwb|string|\Zend\Form\View\Helper\Form
     */
    public function __invoke(Form $form = null, $formType = null, array $dispSpec = array()) {
        if(is_null($form)) {
            return $this;
        }
        return $this->render($form, $formType, $dispSpec);
    }

    /**
     * Renders a quick form
     * @param Form $form
     * @param string|null $formType
     * @param array $dispSpec
     * @return string
     */
    public function render(Form $form, $formType = null, array $dispSpec = array()) {
        if(is_null($formType)) {
            $formType           = self::DEFAULT_FORM_TYPE;
        }
        //Open Tag
        $html   = $this->openTag($form, $formType);
        //Form content
        $fieldsetHelper = $this->getHelper('form_fieldset_twb');
        /* @var $fieldsetHelper \DluTwBootstrap\Form\View\Helper\FormFieldsetTwb */
        $inputFilter    = $form->getInputFilter();
        $html   .= $fieldsetHelper->content($form, $formType, $inputFilter, $dispSpec, true);
        //Form actions
        $html   .= $this->actions($form, $formType);
        //Close Tag
        $html   .= $this->closeTag();
        return $html;
    }

    /**
     * Returns the form actions (ie form buttons section)
     * @param Form $form
     * @param string $formType
     * @param array|null $elements
     * @return string
     * @throws \DluTwBootstrap\Form\Exception\UndefinedFormElementException
     */
    public function actions(Form $form, $formType, array $elements = null) {
        $formIterator   = $form->getIterator();
        switch($formType) {
            case \DluTwBootstrap\Form\Util::FORM_TYPE_HORIZONTAL:
                $html   = '<div class="form-actions">';
                break;
            case \DluTwBootstrap\Form\Util::FORM_TYPE_VERTICAL:
                $html   = '<div>';
                break;
            case \DluTwBootstrap\Form\Util::FORM_TYPE_INLINE:
            case \DluTwBootstrap\Form\Util::FORM_TYPE_SEARCH:
            default:
                $html   = '';
                break;
        }
        $helper         = $this->getHelper('form_element_full_twb');
        if(is_null($elements)) {
            //Iterate over all form elements (outside any fieldsets) and render only buttons
            foreach($formIterator as $element) {
                /* @var $element ElementInterface */
                if($element instanceof \Zend\Form\FieldsetInterface
                   || $element instanceof \Zend\Form\FormInterface) {
                    //Do not inspect fieldsets
                    continue;
                }
                $elementType    = $element->getAttribute('type');
                if(in_array($elementType, array('submit', 'reset', 'button',))) {
                    //It is one of the 'button' elements
                    $html   .= "\n" . $helper($element, $formType);
                }
            }
        } else {
            //The elements are specified, use only the specified elements in this order
            foreach($elements as $element) {
                if(is_string($element)) {
                    $elementObj = $form->get($element);
                    if(!$elementObj) {
                        throw new UndefinedFormElementException("Form element '$element' is not defined.");
                    }
                    $element    = $elementObj;
                }
                $html   .= "\n" . $helper($element, $formType);
            }
        }
        switch($formType) {
            case \DluTwBootstrap\Form\Util::FORM_TYPE_HORIZONTAL:
            case \DluTwBootstrap\Form\Util::FORM_TYPE_VERTICAL:
                $html   .= "\n" . '</div>';
                break;
            case \DluTwBootstrap\Form\Util::FORM_TYPE_INLINE:
            case \DluTwBootstrap\Form\Util::FORM_TYPE_SEARCH:
            default:
                //No action, do not alter the markup
                break;
        }
        return $html;
    }

    /**
     * Generate an opening form tag
     * @param  null|FormInterface $form
     * @param null|string $formType
     * @return string
     * @throws \DluTwBootstrap\Form\Exception\UnsupportedFormTypeException
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