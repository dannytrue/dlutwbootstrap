<?php
namespace DluTwBootstrap\Form\View\Helper;
use Zend\Form\ElementInterface;
use DluTwBootstrap\Util\Util as GenUtil;
use DluTwBootstrap\Form\Util;

class FormLabelTwb extends \Zend\Form\View\Helper\FormLabel
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
                             $formType = Util::FORM_TYPE_VERTICAL) {
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
    }
}