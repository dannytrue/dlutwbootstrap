<?php
namespace DluTwBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;

/**
 * @category   Zend
 * @package    Zend_Form
 * @subpackage View
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class FormInputTwb extends \Zend\Form\View\Helper\FormInput
{
    /**
     * Render a form <input> element from the provided $element
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element) {
        $html   = parent::render($element);
        return $html;
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface $element
     * @return string
     */
    public function __invoke(ElementInterface $element) {
        return $this->render($element);
    }
}