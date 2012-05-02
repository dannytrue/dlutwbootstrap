<?php
namespace DluTwBootstrap\View\Helper\Navigation;

class TwbNavList extends AbstractHelper
{


    /* *********************** METHODS *************************** */

    /**
     * Renders helper
     * @param  \Zend\Navigation\Container $container [optional] container to render.
     *                                         Default is null, which indicates
     *                                         that the helper should render
     *                                         the container returned by {@link
     *                                         getContainer()}.
     * @return string helper output
     * @throws \Zend\View\Exception if unable to render
     */
    public function render(\Zend\Navigation\Container $container = null) {
        return $this->renderNavList($container);
    }

    public function renderNavList(\Zend\Navigation\Container $container = null, $well = true, $renderIcons = true) {
        if (null === $container) {
            $container = $this->getContainer();
        }
        $html   = '';
        //Well
        if($well) {
            $html   .= "\n" . '<div class="well" style="padding: 8px 0;">';
        }
        //UL
        $html   .= "\n" . $this->getUlFromContainer($container, 'nav-list', null, $renderIcons);
        //Well (close div)
        if($well) {
            $html   .= "\n" . '</div>';
        }
        return $html;
    }

}