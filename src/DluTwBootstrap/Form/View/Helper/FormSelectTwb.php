<?php
namespace DluTwBootstrap\Form\View\Helper;

use \DluTwBootstrap\Util\Util as GenUtil;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormSelectTwb extends \Zend\Form\View\Helper\FormSelect
{
    /**
     * @var GenUtil
     */
    protected $genUtil;

    /* **************************** METHODS ****************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\Util\Util $genUtil
     */
    public function __construct(GenUtil $genUtil) {
        $this->genUtil  = $genUtil;
    }

    /**
     * Render an array of options
     *
     * Individual options should be of the form:
     *
     * <code>
     * array(
     *     'value'    => 'value',
     *     'label'    => 'label',
     *     'disabled' => $booleanFlag,
     *     'selected' => $booleanFlag,
     * )
     * </code>
     *
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
            $value    = '';
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
     *
     * @param  ElementInterface $element
     * @param string $sizeClass
     * @return string
     */
    public function render(ElementInterface $element, $sizeClass = null) {
        if($sizeClass) {
            $class  = $element->getAttribute('class');
            $class  = $this->genUtil->addWord($sizeClass, $class);
            $element->setAttribute('class', $class);
        }
        $renderer           = $this->getView();
        $html               = parent::render($element);
        //Inline help
        $inlineHelpHelper   = $renderer->plugin('form_inline_help_twb');
        $html               .= $inlineHelpHelper($element);
        //Description
        $descriptionHelper  = $renderer->plugin('form_element_description_twb');
        $html               .= $descriptionHelper($element);
        return $html;
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface $element
     * @param string $sizeClass
     * @return string
     */
    public function __invoke(ElementInterface $element, $sizeClass = null) {
        return $this->render($element, $sizeClass);
    }
}