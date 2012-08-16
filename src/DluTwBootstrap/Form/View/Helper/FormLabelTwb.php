<?php
namespace DluTwBootstrap\Form\View\Helper;

use DluTwBootstrap\GenUtil;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\View\Helper\FormLabel;
use Zend\Form\ElementInterface;
use Zend\Form\Exception\DomainException;

/**
 * FormLabelTwb
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormLabelTwb extends AbstractHelper
{
    /**
     * @var GenUtil
     */
    protected $genUtil;

    /**
     * Constructor
     * @param \DluTwBootstrap\GenUtil $genUtil
     */
    public function __construct(GenUtil $genUtil)
    {
        $this->genUtil  = $genUtil;
    }


    public function __invoke(ElementInterface $element = null, $labelContent = null, $position = null

    ) {
        if (!$element) {
            return $this;
        }
        $labelContent   = $element->getLabel();
        if (empty($labelContent)) {
            throw new DomainException(sprintf('%s: No label set in the element.', __METHOD__));
        }
        //Translate
        if (null !== ($translator = $this->getTranslator())) {
            $labelContent = $translator->translate($labelContent, $this->getTranslatorTextDomain());
        }
        //Escape
        $escaperHtml    = $this->getEscapeHtmlHelper();
        $labelContent   = $escaperHtml($labelContent);
        //Label attributes
        $labelAttributes = $element->getLabelAttributes();
        if (empty($labelAttributes)) {
            $labelAttributes = array();
        }
        $labelAttributes    = $this->genUtil->addWordsToArrayItem('control-label', $labelAttributes, 'class');
        if (array_key_exists('required', $displayOptions) && $displayOptions['required']) {
            $labelAttributes    = $this->genUtil->addWordsToArrayItem('required', $labelAttributes, 'class');
        }
        $element->setLabelAttributes($labelAttributes);
        return parent::__invoke($element, $labelContent);
    }
}