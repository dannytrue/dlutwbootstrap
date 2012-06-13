<?php
namespace DluTwBootstrap\Form\View\Helper;

use \DluTwBootstrap\Util as GenUtil;
use \DluTwBootstrap\Form\Util as FormUtil;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

/**
 * Form Select
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormSelectTwb extends \Zend\Form\View\Helper\FormSelect
{
    /**
     * General utils
     * @var GenUtil
     */
    protected $genUtil;

    /**
     * Form utils
     * @var \DluTwBootstrap\Form\Util
     */
    protected $formUtil;

    /**
     * Allowed select attributes
     * @var array
     */
    protected $validSelectAttributes = array(
        'name'     => true,
        'multiple' => true,
        'size'     => true,
    );

    /* **************************** METHODS ****************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\Util $genUtil
     * @param \DluTwBootstrap\Form\Util $formUtil
     */
    public function __construct(GenUtil $genUtil, FormUtil $formUtil) {
        $this->genUtil  = $genUtil;
        $this->formUtil = $formUtil;
    }

    /**
     * Render an array of options
     * Individual options should be of the form:
     * <code>
     * array(
     *     'value'    => 'value',
     *     'label'    => 'label',
     *     'disabled' => $booleanFlag,
     *     'selected' => $booleanFlag,
     * )
     * </code>
     * @param  array $options
     * @param  array $selectedOptions Option values that should be marked as selected
     * @return string
     */
    public function renderOptions(array $options, array $selectedOptions = array())
    {
        $template      = '<option %s>%s</option>';
        $optionStrings = array();
        $escape        = $this->getEscapeHelper();

        foreach ($options as $key => $optionSpec) {
            $label    = '';
            $selected = false;
            $disabled = false;

            if (is_string($optionSpec)) {
                $optionSpec = array(
                    'value' => $key,
                    'label' => $optionSpec,
                );
            }

            if (isset($optionSpec['options']) && is_array($optionSpec['options'])) {
                $optionStrings[] = $this->renderOptgroup($optionSpec, $selectedOptions);
                continue;
            }

            if (isset($optionSpec['value'])) {
                $value = $optionSpec['value'];
            } else {
                $value = $key;
            }
            if (isset($optionSpec['label'])) {
                $label = $optionSpec['label'];
            }
            if (isset($optionSpec['selected'])) {
                $selected = $optionSpec['selected'];
            }
            if (isset($optionSpec['disabled'])) {
                $disabled = $optionSpec['disabled'];
            }

            if (in_array($value, $selectedOptions, true)) {
                $selected = true;
            }

            $attributes = compact('value', 'selected', 'disabled');
            $this->validTagAttributes = $this->validOptionAttributes;
            $optionStrings[] = sprintf(
                $template,
                $this->createAttributesString($attributes),
                $escape($label)
            );
        }

        $html   = implode("\n", $optionStrings);
        return $html;
    }

    /**
     * Render a form <select> element from the provided $element
     * @param  ElementInterface $element
     * @param string|null $sizeClass
     * @param integer|null $size Number of lines/items in the dropdown
     * @return string
     */
    public function render(ElementInterface $element, $sizeClass = null, $size = null) {
        if($sizeClass) {
            $class  = $element->getAttribute('class');
            $class  = $this->genUtil->addWord($sizeClass, $class);
            $element->setAttribute('class', $class);
        }
        if($size) {
            $element->setAttribute('size', (int)$size);
        }
        $this->formUtil->addIdAttributeIfMissing($element);
        $html               = parent::render($element);
        return $html;
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface $element
     * @param string $sizeClass
     * @param integer|null $size Number of lines/items in the dropdown
     * @return string
     */
    public function __invoke(ElementInterface $element, $sizeClass = null, $size = null) {
        return $this->render($element, $sizeClass, $size);
    }
}