<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Traversable;

/**
 * Form Multicheckbox
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormMultiCheckboxTwb extends \Zend\Form\View\Helper\FormMultiCheckbox
{
    /**
     * Render as inline?
     * @var bool
     */
    protected $inline;

    /* ************************ METHODS ***************************** */

    /**
     * Invoke helper as function
     * @param \Zend\Form\ElementInterface $element
     * @param bool $inline
     * @return string
     */
    public function __invoke(ElementInterface $element, $inline = false) {
        $this->labelHelper  = null;
        $this->inline       = (bool)$inline;
        return parent::__invoke($element);
    }

    /**
     * Retrieve the FormLabel helper
     * @return \Zend\Form\View\Helper\FormLabel
     * @throws \Exception
     */
    protected function getLabelHelper() {
        if ($this->labelHelper) {
            return $this->labelHelper;
        }
        if($this->inline) {
            $this->labelHelper = $this->view->plugin('form_label_checkbox_option_inline_twb');
        } else {
            $this->labelHelper = $this->view->plugin('form_label_checkbox_option_twb');
        }
        if (!$this->labelHelper instanceof AbstractFormLabel) {
            throw new \Exception('Wrong type of label helper.');
        }
        return $this->labelHelper;
    }

    //TODO - remove the render() method once the bug with swapped multi-option keys/values has been fixed in ZF2
    /**
     * Render a form <input> element from the provided $element
     *
     * @param  ElementInterface $element
     * @return string
     * @throws \Zend\Form\Exception\DomainException
     */
    public function render(ElementInterface $element)
    {
        $name   = static::getName($element);
        if (empty($name)) {
            throw new \Zend\Form\Exception\DomainException(sprintf(
                                                    '%s requires that the element has an assigned name; none discovered',
                                                    __METHOD__
                                                ));
        }

        $attributes         = $element->getAttributes();

        if (!isset($attributes['options'])
            || (!is_array($attributes['options']) && !$attributes['options'] instanceof Traversable)
        ) {
            throw new \Zend\Form\Exception\DomainException(sprintf(
                                                    '%s requires that the element has an array or Traversable "options" attribute; none found',
                                                    __METHOD__
                                                ));
        }

        $options = $attributes['options'];
        unset($attributes['options']);

        $attributes['name'] = $name;
        $attributes['type'] = $this->getInputType();

        $values = array();
        if (isset($attributes['value'])) {
            $values = (array) $attributes['value'];
            unset($attributes['value']);
        }

        $escapeHelper   = $this->getEscapeHtmlHelper();
        $labelHelper    = $this->getLabelHelper();
        $labelOpen      = $labelHelper->openTag();
        $labelClose     = $labelHelper->closeTag();
        $labelPosition  = $this->getLabelPosition();
        $closingBracket = $this->getInlineClosingBracket();
        $template       = $labelOpen . '%s%s' . $labelClose;
        $combinedMarkup = array();
        $count          = 0;

        foreach ($options as $value => $label) {
            $count++;
            if ($count > 1 && array_key_exists('id', $attributes)) {
                unset($attributes['id']);
            }
            $attributes['value']   = $value;
            $attributes['checked'] = '';
            if (in_array($value, $values, true)) {
                $attributes['checked'] = 'checked';
            }

            $label = $escapeHelper($label);
            $input = sprintf(
                '<input %s%s',
                $this->createAttributesString($attributes),
                $closingBracket
            );

            switch ($labelPosition) {
                case self::LABEL_PREPEND:
                    $markup = sprintf($template, $label, $input);
                    break;
                case self::LABEL_APPEND:
                default:
                    $markup = sprintf($template, $input, $label);
                    break;
            }

            $combinedMarkup[] = $markup;
        }

        $html   = implode($this->getSeparator(), $combinedMarkup);
        return $html;
    }
}