<?php
namespace DluTwBootstrap\Form;

use Zend\Form\ElementInterface;

/**
 * Form Utilities
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class Util
{
    /**
     * Form type Horizontal
     * @var string
     */
    const FORM_TYPE_HORIZONTAL  = 'horizontal';

    /**
     * Form type Vertical
     * @var string
     */
    const FORM_TYPE_VERTICAL    = 'vertical';

    /**
     * Form type Inline
     * @var string
     */
    const FORM_TYPE_INLINE      = 'inline';

    /**
     * Form type Search
     * @var string
     */
    const FORM_TYPE_SEARCH      = 'search';

    /* ********************************** METHODS ***************************** */

    /**
     * If the 'id' attribute of the element is not defined, it is set to equal the element's name value
     * @param ElementInterface $element
     */
    public function addIdAttributeIfMissing(ElementInterface $element) {
        if(!$element->getAttribute('id')) {
            $element->setAttribute('id', $element->getName());
        }
    }
}