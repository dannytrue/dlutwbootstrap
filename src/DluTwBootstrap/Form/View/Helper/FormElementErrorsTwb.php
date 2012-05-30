<?php
namespace DluTwBootstrap\Form\View\Helper;
use \Zend\Form\ElementInterface;
use \DluTwBootstrap\Util\Util as GenUtil;

class FormElementErrorsTwb extends \Zend\Form\View\Helper\FormElementErrors
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
     * Render validation errors for the provided $element
     *
     * @param  ElementInterface $element
     * @param array $attributes
     * @return string
     */
    public function render(ElementInterface $element, array $attributes = array()) {
        $attributes = $this->genUtil->addWordToArrayItem('errors', $attributes, 'class');
        return parent::render($element, $attributes);
    }

}