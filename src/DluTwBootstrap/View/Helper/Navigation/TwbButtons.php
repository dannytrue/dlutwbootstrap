<?php
namespace DluTwBootstrap\View\Helper\Navigation;

class TwbButtons extends AbstractButtonHelper
{
    /* *********************** METHODS *************************** */

    /**
     * Renders helper
     * @param  string|\Zend\Navigation\AbstractContainer $container [optional] container to render.
     *                                         Default is null, which indicates
     *                                         that the helper should render
     *                                         the container returned by {@link
     *                                         getContainer()}.
     * @return string helper output
     * @throws \Zend\View\Exception\ExceptionInterface if unable to render
     */
    public function render($container = null){
        return $this->renderButtons($container);
    }

    public function renderButtons(\Zend\Navigation\Navigation $container = null,
                               $type = null,
                               $renderIcons = true) {
        if (null === $container) {
            $container = $this->getContainer();
        }
        if(!$container->hasPages()) {
            return '';
        }
        if(is_null($type)) {
            $type   = self::TYPE_GROUPS_HORIZONTAL;
        }
        $options    = array('type'  => $type);
        $html       = $this->renderContainer($container, $renderIcons, false, $options);
        return $html;
    }
}