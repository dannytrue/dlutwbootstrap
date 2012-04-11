<?php
namespace DluTwBootstrap\Form;

/**
 * Horizontal Form
 * Responsibility: Represent the Twitter Bootstrap vertical form
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class Vertical extends AbstractBlockForm
{
    /* **************** METHODS ******************** */

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
                 ->addDecorator('FormDecorator', array('class' => 'form-vertical'));
        }
        return $this;
    }
}