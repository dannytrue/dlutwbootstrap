<?php
namespace DluTwBootstrap\Form;
/**
 * DgFormActions display group
 * Responsibility: Render action buttons on horizontal form
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class DgFormActions extends \Zend\Form\DisplayGroup
{
    /* ********************** METHODS ********************** */

    /**
     * Load default decorators
     * @return DgFormActions
     */
    public function loadDefaultDecorators() {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }
        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'form-actions'));
        }
        return $this;
    }

}