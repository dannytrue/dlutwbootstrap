<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use DluTwBootstrap\Util as GenUtil;
use DluTwBootstrap\Form\Util as FormUtil;

/**
 * Abstract Form Helper
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
abstract class AbstractFormLabel extends \Zend\Form\View\Helper\FormLabel
{
    /**
     * Attributes valid for the label tag
     * @var array
     */
    protected $validTagAttributes = array(
        'for'   => true,
        'form'  => true,
        'class' => true,
    );

    /**
     * Form utilities
     * @var FormUtil
     */
    protected $util;

    /**
     * General utilities
     * @var GenUtil
     */
    protected $genUtil;

    /**
     * Form type
     * @var string
     */
    protected $formType     = FormUtil::FORM_TYPE_HORIZONTAL;

    /* ************************ METHODS ***************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\Form\Util $util
     * @param \DluTwBootstrap\Util $genUtil
     */
    public function __construct(FormUtil $util, GenUtil $genUtil) {
        $this->util     = $util;
        $this->genUtil  = $genUtil;
    }

    /**
     * Generate an opening label tag
     * @param  null|array|ElementInterface $attributesOrElement
     * @return string
     * @throws \Zend\Form\Exception\DomainException
     * @throws \Zend\Form\Exception\InvalidArgumentException
     */
    public function openTag($attributesOrElement = null) {
        if (null === $attributesOrElement) {
            $attributesOrElement    = array();
        }
        if (is_array($attributesOrElement)) {
            $attributesAy   = $this->garnishAttributes($attributesOrElement);
            $attributes     = $this->createAttributesString($attributesAy);
            return sprintf('<label %s>', $attributes);
        }

        if (!$attributesOrElement instanceof ElementInterface) {
            throw new \Zend\Form\Exception\InvalidArgumentException(sprintf(
                                                             '%s expects an array or Zend\Form\ElementInterface instance; received "%s"',
                                                             __METHOD__,
                                                             (is_object($attributesOrElement) ? get_class($attributesOrElement) : gettype($attributesOrElement))
                                                         ));
        }

        $id = $this->getId($attributesOrElement);
        if (null === $id) {
            throw new \Zend\Form\Exception\DomainException(sprintf(
                                                    '%s expects the Element provided to have either a name or an id present; neither found',
                                                    __METHOD__
                                                ));
        }

        $attributesAy   = array('for' => $id);
        if($attributesOrElement->getAttribute('class')) {
            $attributesAy['class']  = $attributesOrElement->getAttribute('class');
        }
        $attributesAy   = $this->garnishAttributes($attributesAy);
        $attributes     = $this->createAttributesString($attributesAy);
        return sprintf('<label %s>', $attributes);
    }

    //TODO - remove this method when the labels are escaped by ZF2 FormLabel view helper
    /**
     * Generate a form label, optionally with content
     *
     * Always generates a "for" statement, as we cannot assume the form input
     * will be provided in the $labelContent.
     *
     * @param  ElementInterface $element
     * @param  null|string $labelContent
     * @param  string $position
     * @return string
     * @throws \Zend\Form\Exception\DomainException
     */
    public function __invoke(ElementInterface $element, $labelContent = null, $position = null)
    {
        $openTag = $this->openTag($element);
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

        $escapeHelper   = $this->getEscapeHelper();
        $labelContent   = $escapeHelper($labelContent);

        return $openTag . $labelContent . $this->closeTag();
    }

    /**
     * Sets the current form type
     * @param $formType
     */
    protected function setFormType($formType) {
        $this->formType = $formType;
    }

    /**
     * Adds attributes specific for this helper
     * @param array $attributes
     * @return array
     */
    abstract protected function garnishAttributes(array $attributes);
}