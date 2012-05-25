<?php
namespace DluTwBootstrap\Form\View\Helper;
use Zend\Form\ElementInterface;
use DluTwBootstrap\Util\Util as GenUtil;
use DluTwBootstrap\Form\Util;

abstract class AbstractFormLabel extends \Zend\Form\View\Helper\FormLabel
{
    /**
     * Attributes valid for the label tag
     *
     * @var array
     */
    protected $validTagAttributes = array(
        'for'   => true,
        'form'  => true,
        'class' => true,
    );

    /**
     * @var Util
     */
    protected $util;

    /**
     * @var GenUtil
     */
    protected $genUtil;

    /**
     * @var string
     */
    protected $formType     = Util::FORM_TYPE_VERTICAL;

    /* ************************ METHODS ***************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\Form\Util $util
     * @param \DluTwBootstrap\Util\Util $genUtil
     */
    public function __construct(Util $util, GenUtil $genUtil) {
        $this->util     = $util;
        $this->genUtil  = $genUtil;
    }

    /**
     * Generate an opening label tag
     *
     * @param  null|array|ElementInterface $attributesOrElement
     * @return string
     * @throws \Zend\Form\Exception\DomainException
     * @throws \Zend\Form\Exception\InvalidArgumentException
     */
    public function openTag($attributesOrElement = null)
    {
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

        $attributesAy   = $this->garnishAttributes(array('for' => $id));
        $attributes     = $this->createAttributesString($attributesAy);
        return sprintf('<label %s>', $attributes);
    }

    /**
     * Sets the current form type
     * @param $formType
     */
    protected function setFormType($formType = null) {
        if(is_null($formType)) {
            $this->formType = Util::FORM_TYPE_VERTICAL;
        } else {
            $this->formType = $formType;
        }
    }

    /**
     * Adds attributes specific for this helper
     * @param array $attributes
     * @return array
     */
    abstract protected function garnishAttributes(array $attributes);
}