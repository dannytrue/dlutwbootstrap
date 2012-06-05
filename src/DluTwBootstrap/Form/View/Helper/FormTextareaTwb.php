<?php
namespace DluTwBootstrap\Form\View\Helper;

use \DluTwBootstrap\Util\Util as GenUtil;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormTextareaTwb extends \Zend\Form\View\Helper\FormTextarea
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
        $html               = parent::render($element);
        $renderer           = $this->getView();
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
     * @param integer $rows
     * @return string
     */
    public function __invoke(ElementInterface $element, $sizeClass = null, $rows = null) {
        return $this->render($element, $sizeClass, $rows);
    }
}