<?php
namespace DluTwBootstrap\Form;
use Zend\Form\Form as ZendForm;
use Zend\Form\Exception\InvalidArgumentException;
use Zend\Form\FieldsetInterface;

/**
 * Form
 * Responsibility: Correct the checkbox bug in ZF2
 * The original ZF2 component sets the checkbox element value to the provided value instead of marking the element
 * 'checked'. This component corrects this bug.
 * @link http://framework.zend.com/issues/browse/ZF2-343
 */
class Form extends ZendForm
{
    /* ************************** METHODS ************************ */

    /**
     * Recursively populate values of attached elements and fieldsets
     * @param  array|Traversable $data
     * @return void
     * @throws InvalidArgumentException
     */
    public function populateValues($data) {
        if (!is_array($data) && !$data instanceof Traversable) {
            throw new InvalidArgumentException(sprintf(
                                                   '%s expects an array or Traversable set of data; received "%s"',
                                                   __METHOD__,
                                                   (is_object($data) ? get_class($data) : gettype($data))
                                               ));
        }
        foreach ($data as $name => $value) {
            if (!$this->has($name)) {
                continue;
            }
            $element = $this->get($name);
            if ($element instanceof FieldsetInterface && is_array($value)) {
                $element->populateValues($value);
                continue;
            }
            if($element->getAttribute('type') == 'checkbox') {
                //Checkbox
                if($value) {
                    $element->setAttribute('checked', 'checked');
                }
            } else {
                //Other elements
                $element->setAttribute('value', $value);
            }
        }
    }
}