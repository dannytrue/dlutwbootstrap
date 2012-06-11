<?php
namespace DluTwBootstrap\Form;

use Zend\Form\ElementInterface;

class Util
{
    const FORM_TYPE_HORIZONTAL  = 'horizontal';
    const FORM_TYPE_VERTICAL    = 'vertical';
    const FORM_TYPE_INLINE      = 'inline';
    const FORM_TYPE_SEARCH      = 'search';

    /* ********************************** METHODS ***************************** */

    /**
     * If the 'id' attribute of the element is not defined, it is set to the element's name value
     * @param ElementInterface $element
     */
    public function addIdAttributeIfMissing(ElementInterface $element) {
        if(!$element->getAttribute('id')) {
            $element->setAttribute('id', $element->getName());
        }
    }
}