<?php
namespace DluTwBootstrap\Form\View\Helper;

use \DluTwBootstrap\Util\Util as GenUtil;
use \DluTwBootstrap\Form\Util as FormUtil;
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
     * @var GenUtil
     */
    protected $genUtil;

    /**
     * @var FormUtil
     */
    protected $formUtil;

    /* **************************** METHODS ****************************** */

    /**
     * Constructor
     * @param \DluTwBootstrap\Util\Util $genUtil
     * @param \DluTwBootstrap\Form\Util $formUtil
     */
    public function __construct(GenUtil $genUtil, FormUtil $formUtil) {
        $this->genUtil  = $genUtil;
        $this->formUtil = $formUtil;
    }

    /**
     * Render a form <input> element from the provided $element
     * @param  ElementInterface $element
     * @param string $sizeClass
     * @param string|null $formType
     * @return string
     */
    public function render(ElementInterface $element, $sizeClass = null, $formType = null) {
        $escapeHelper   = $this->getEscapeHelper();
        $type           = $element->getAttribute('type');
        //Type specific mods
        switch($type) {
            case 'submit':
                $class  = $element->getAttribute('class');
                $class  = $this->genUtil->addWord('btn btn-primary', $class);
                $element->setAttribute('class', $class);
                break;
            case 'reset':
                $class  = $element->getAttribute('class');
                $class  = $this->genUtil->addWord('btn', $class);
                $element->setAttribute('class', $class);
                break;
            case 'button':
                $class  = $element->getAttribute('class');
                $class  = $this->genUtil->addWord('btn', $class);
                $element->setAttribute('class', $class);
                break;
            case 'text':
                if($sizeClass) {
                    $class  = $element->getAttribute('class');
                    $class  = $this->genUtil->addWord($sizeClass, $class);
                    $element->setAttribute('class', $class);
                }
                if($formType == \DluTwBootstrap\Form\Util::FORM_TYPE_SEARCH) {
                    $class  = $element->getAttribute('class');
                    $class  = $this->genUtil->addWord('search-query', $class);
                    $element->setAttribute('class', $class);
                }
                $this->formUtil->addIdAttributeIfMissing($element);
                break;
            case 'password':
                if($sizeClass) {
                    $class  = $element->getAttribute('class');
                    $class  = $this->genUtil->addWord($sizeClass, $class);
                    $element->setAttribute('class', $class);
                }
                $this->formUtil->addIdAttributeIfMissing($element);
                break;
            case 'checkbox':
                $this->formUtil->addIdAttributeIfMissing($element);
                break;
            case 'file':
                $this->formUtil->addIdAttributeIfMissing($element);
                break;
            default:
                //No default action
                break;
        }
        //Generate the element
        $html   = parent::render($element);
        //Wrap simple checkbox into label for proper rendering
        if($type == 'checkbox' && !is_array($element->getAttribute('options'))) {
            $html   = '<label class="checkbox">' . $html . '</label>';
        }
        //Text prepend / append
        $prepAppClass   = '';
        if($type == 'text' && $element->getAttribute('prependText')) {
            $prepAppClass   = $this->genUtil->addWord('input-prepend', $prepAppClass);
            $html           = '<span class="add-on">' . $escapeHelper($element->getAttribute('prependText')) . '</span>'
                              . $html;
        }
        if($type == 'text' && $element->getAttribute('appendText')) {
            $prepAppClass   = $this->genUtil->addWord('input-append', $prepAppClass);
            $html           .= '<span class="add-on">' . $escapeHelper($element->getAttribute('appendText')) . '</span>';
        }
        if($prepAppClass) {
            $html           = '<div class="' . $prepAppClass . '">' . "\n$html\n" . '</div>';
        }
        return $html;
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface $element
     * @param string $sizeClass
     * @param string|null $formType
     * @return string
     */
    public function __invoke(ElementInterface $element, $sizeClass = null, $formType = null) {
        return $this->render($element, $sizeClass, $formType);
    }
}