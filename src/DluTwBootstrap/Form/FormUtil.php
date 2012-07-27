<?php
namespace DluTwBootstrap\Form;

use Zend\Form\ElementInterface;

/**
 * Form Utilities
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormUtil
{
    /**
     * Form type Horizontal
     * @var string
     */
    const FORM_TYPE_HORIZONTAL  = 'horizontal';

    /**
     * Form type Vertical
     * @var string
     */
    const FORM_TYPE_VERTICAL    = 'vertical';

    /**
     * Form type Inline
     * @var string
     */
    const FORM_TYPE_INLINE      = 'inline';

    /**
     * Form type Search
     * @var string
     */
    const FORM_TYPE_SEARCH      = 'search';

    /**
     * Supported form types
     * @var array
     */
    protected $supportedFormTypes   = array(
        self::FORM_TYPE_HORIZONTAL,
        self::FORM_TYPE_VERTICAL,
        self::FORM_TYPE_INLINE,
        self::FORM_TYPE_SEARCH,
    );

    /**
     * Default form type
     * @var string
     */
    protected $defaultFormType;

    /* ********************************** METHODS ***************************** */

    /**
     * Constructor
     * @param string|null $defaultFormType
     */
    public function __construct($defaultFormType = null)
    {
        $this->setDefaultFormType($defaultFormType);
    }

    /**
     * If the 'id' attribute of the element is not defined, it is set to equal the element's name value
     * @param ElementInterface $element
     */
    public function addIdAttributeIfMissing(ElementInterface $element)
    {
        if(!$element->getAttribute('id')) {
            $element->setAttribute('id', $element->getName());
        }
    }

    /**
     * Sets the default form type
     * @param string $defaultFormType
     */
    public function setDefaultFormType($defaultFormType)
    {
        if(!$this->isFormTypeSupported($defaultFormType)) {
            $defaultFormType    = self::FORM_TYPE_HORIZONTAL;
        }
        $this->defaultFormType = $defaultFormType;
    }

    /**
     * Returns the default form type
     * @return string
     */
    public function getDefaultFormType()
    {
        return $this->defaultFormType;
    }

    /**
     * Is the specified form type supported?
     * @param string $formType
     * @return bool
     */
    public function isFormTypeSupported($formType)
    {
        return in_array($formType, $this->supportedFormTypes);
    }
}