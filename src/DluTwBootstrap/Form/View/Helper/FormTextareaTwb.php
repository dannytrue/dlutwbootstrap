<?php
namespace DluTwBootstrap\Form\View\Helper;

use \DluTwBootstrap\Util as GenUtil;
use \DluTwBootstrap\Form\Util as FormUtil;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

/**
 * Form Textarea
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormTextareaTwb extends \Zend\Form\View\Helper\FormTextarea
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
     * Render a form <textarea> element from the provided $element
     * @param  ElementInterface $element
     * @param string $sizeClass
     * @param integer $rows
     * @return string
     */
    public function render(ElementInterface $element, $sizeClass = null, $rows = null) {
        if($sizeClass) {
            $class  = $element->getAttribute('class');
            $class  = $this->genUtil->addWord($sizeClass, $class);
            $element->setAttribute('class', $class);
        }
        if($rows) {
            $element->setAttribute('rows', $rows);
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
     * @param integer $rows
     * @return string
     */
    public function __invoke(ElementInterface $element, $sizeClass = null, $rows = null) {
        return $this->render($element, $sizeClass, $rows);
    }
}