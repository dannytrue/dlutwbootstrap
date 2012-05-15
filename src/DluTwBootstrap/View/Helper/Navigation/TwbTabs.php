<?php
namespace DluTwBootstrap\View\Helper\Navigation;

class TwbTabs extends AbstractNavHelper
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
        return $this->renderTabs($container);
    }

    public function renderTabs(\Zend\Navigation\Container $container = null,
                               $pills = false,
                               $stacked = false,
                               $renderIcons = true) {
        if (null === $container) {
            $container = $this->getContainer();
        }
        $ulClass    = 'nav';
        //Tabs or Pills
        if($pills) {
            $ulClass            .= ' nav-pills';
            $activeIconInverse    = true;
        } else {
            $ulClass            .= ' nav-tabs';
            $activeIconInverse    = false;
        }
        //Stacked
        if($stacked) {
            $ulClass            .= ' nav-stacked';
        }
        //Container
        $options    = array(
            'ulClass'   => $ulClass,
        );
        $html   = "\n" . $this->renderContainer($container, $renderIcons, $activeIconInverse, $options);
        return $html;
    }

}