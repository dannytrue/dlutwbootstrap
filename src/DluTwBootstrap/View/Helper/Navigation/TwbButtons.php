<?php
namespace DluTwBootstrap\View\Helper\Navigation;

class TwbButtons extends AbstractButtonHelper
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
        return $this->renderButtons($container);
    }

    public function renderButtons(\Zend\Navigation\Container $container = null,
                               $type = null,
                               $renderIcons = true) {
        if (null === $container) {
            $container = $this->getContainer();
        }
        if(!$container->hasPages()) {
            return '';
        }
        $options    = array('type'  => $type);
        $html       = $this->renderContainer($container, $renderIcons, false, $options);
        return $html;
    }

    protected function xrenderSubnav(\Zend\Navigation\Page\AbstractPage $page,
                                    $renderIcons = true,
                                    $activeIconInverse = true,
                                    array $options = array()) {
        //Get label and title
        $label      = $this->translate($page->getLabel());
        $title      = $this->translate($page->getTitle());
        $escaper    = $this->view->plugin('escape');
        //Get attribs
        $aAttribs   = array(
            'title'         => $title,
            'class'         => 'btn dropdown-toggle' . ($page->getClass() ? (' ' . $page->getClass()) : ''),
            'data-toggle'   => 'dropdown',
        );
        if($renderIcons) {
            $iconHtml   = $this->htmlifyIcon($page, $activeIconInverse);
        } else {
            $iconHtml   = '';
        }
        $html   = '<div class="btn-group">';
        $html   .= "\n" . '<a href="#"' . $this->_htmlAttribs($aAttribs) . '>'
            . $iconHtml . $escaper($label) . '<b class="caret"></b></a>';
        $html   .= "\n" . '<ul class="dropdown-menu">';
        $html   .= $this->renderContainer($page, $renderIcons, $activeIconInverse, $options);
        $html   .= "\n</ul>";
        $html   .= '</div>';
        return $html;
    }
}