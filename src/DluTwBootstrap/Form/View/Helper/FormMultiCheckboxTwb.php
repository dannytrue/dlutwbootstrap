<?php
namespace DluTwBootstrap\Form\View\Helper;

use DluTwBootstrap\GenUtil;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormMultiCheckbox;
use Traversable;

/**
 * FormMulticheckboxTwb
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormMultiCheckboxTwb extends FormMultiCheckbox
{
    /**
     * @var array
     */
    protected $twbLabelAttributes  = array(
        'class'     => 'checkbox',
    );

    /**
     * @var string
     */
    protected $labelPosition = self::LABEL_APPEND;

    /**
     * @var GenUtil
     */
    protected $genUtil;

    /* ************************ METHODS ***************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\GenUtil $genUtil
     */
    public function __construct(GenUtil $genUtil)
    {
        $this->genUtil  = $genUtil;
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface|null $element
     * @param null|string $formType
     * @param array $displayOptions
     * @return string|FormMultiCheckboxTwb
     */
    public function __invoke(ElementInterface $element = null, $formType = null, array $displayOptions = array())
    {
        if (!$element) {
            return $this;
        }
        return $this->render($element, $formType, $displayOptions);
    }

    /**
     * Render a form <input> element from the provided $element
     * @param  ElementInterface $element
     * @param null|string $formType
     * @param array $displayOptions
     * @return string
     */
    public function render(ElementInterface $element, $formType = null, array $displayOptions = array())
    {
        $labelAttributes    = $this->twbLabelAttributes;
        if(array_key_exists('inline', $displayOptions) && $displayOptions['inline'] == true) {
            $labelAttributes = $this->genUtil->addWordsToArrayItem('inline', $labelAttributes, 'class');
        }
        $this->setLabelAttributes($labelAttributes);
        return parent::render($element);
    }
}