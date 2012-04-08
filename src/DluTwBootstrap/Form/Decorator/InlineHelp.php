<?php
namespace DluTwBootstrap\Form\Decorator;

class InlineHelp extends \Zend\Form\Decorator\Description
{
    /* ***************** METHODS ******************* */

    /**
     * Render an inline help
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();
        if(!($element instanceof \DluTwBootstrap\Form\Element\InlineHelp)) {
            return $content;
        }
        $view    = $element->getView();
        if (null === $view) {
            return $content;
        }
        /* @var $element \DluTwBootstrap\Form\Element\InlineHelp */
        $inlineHelp = $element->getInlineHelp();
        $inlineHelp = trim($inlineHelp);

        if (!empty($inlineHelp) && (null !== ($translator = $element->getTranslator()))) {
            $inlineHelp = $translator->translate($inlineHelp);
        }

        if (empty($inlineHelp)) {
            return $content;
        }

        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        $tag       = $this->getTag();
        $escape    = $this->getEscape();

        $options   = $this->getOptions();

        if ($escape) {
            $inlineHelp = $view->escape($inlineHelp);
        }

        if (!empty($tag)) {
            $options['tag'] = $tag;
            $decorator      = new \Zend\Form\Decorator\HtmlTag($options);
            $inlineHelp    = $decorator->render($inlineHelp);
        }

        switch ($placement) {
            case self::PREPEND:
                return $inlineHelp . $separator . $content;
            case self::APPEND:
            default:
                return $content . $separator . $inlineHelp;
        }
    }
}
