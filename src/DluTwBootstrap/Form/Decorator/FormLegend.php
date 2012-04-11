<?php
namespace DluTwBootstrap\Form\Decorator;

/**
 * FormLegend decorator
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormLegend extends \Zend\Form\Decorator\Description
{
    /* ***************** METHODS ******************* */

    /**
     * Render an inline help
     * @param  string $content
     * @return string
     */
    public function render($content) {
        $element = $this->getElement();
        if(!($element instanceof \DluTwBootstrap\Form\AbstractForm)) {
            return $content;
        }
        $view    = $element->getView();
        if (null === $view) {
            return $content;
        }
        /* @var $element \DluTwBootstrap\Form\AbstractForm */
        $formLegend = $element->getLegend();
        $formLegend = trim($formLegend);

        if (!empty($formLegend) && (null !== ($translator = $element->getTranslator()))) {
            $formLegend = $translator->translate($formLegend);
        }

        if (empty($formLegend)) {
            return $content;
        }

        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        $tag       = $this->getTag();
        $escape    = $this->getEscape();

        $options   = $this->getOptions();

        if ($escape) {
            $formLegend = $view->escape($formLegend);
        }

        if (!empty($tag)) {
            $options['tag'] = $tag;
            $decorator      = new \Zend\Form\Decorator\HtmlTag($options);
            $formLegend    = $decorator->render($formLegend);
        }

        switch ($placement) {
            case self::PREPEND:
                return $formLegend . $separator . $content;
            case self::APPEND:
            default:
                return $content . $separator . $formLegend;
        }
    }
}
