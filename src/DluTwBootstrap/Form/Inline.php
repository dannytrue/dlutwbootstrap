<?php
namespace DluTwBootstrap\Form;

/**
 * Inline Form
 * Responsibility: Represent the Twitter Bootstrap inline form
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class Inline extends AbstractLineForm
{
    /* ********************* METHODS ********************** */

    /**
     * Load the default decorators
     * @return AbstractForm
     */
    public function loadDefaultDecorators() {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }
        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormLegend', array('tag' => 'legend'))
                ->addDecorator('FormElements')
                ->addDecorator('FormDecorator', array('class' => 'form-inline'));
        }
        return $this;
    }

}