<?php
namespace DluTwBootstrap\View\Helper\Navigation;
use \DluTwBootstrap\Util\Util;

class TwbButtons extends AbstractHelper
{
    const TYPE_VERTICAL = 'vertical';

    const TYPE_GROUP    = 'group';

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
        if($type == self::TYPE_GROUP) {
            $html       = '<div class="btn-group">';
        } else {
            $html       = '';
        }
        $html       .= $this->renderItems($container, $renderIcons, false, $options);
        if($type == self::TYPE_GROUP) {
            $html       .= "\n</div>";
        }
        return $html;
    }

    protected function renderLink(\Zend\Navigation\Page\AbstractPage $page,
                                  $renderIcons = true,
                                  $activeIconInverse = true,
                                  array $options = array()) {
        $class  = $page->getClass();
        Util::addWord('btn', $class);
        if($page->isActive(true)) {
            Util::addWord('active', $class);
        }
        $page->setClass($class);
        $html   = '';
        $vertical   = array_key_exists('type', $options) && $options['type'] == self::TYPE_VERTICAL;
        if($vertical) {
            $html   .= "\n<p>";
        }
        $html   .= "\n" . $this->htmlifyA($page, $renderIcons, $activeIconInverse);
        if($vertical) {
            $html   .= "\n</p>";
        }
        return $html;
    }

    protected function renderSubnav(\Zend\Navigation\Page\AbstractPage $page,
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
        $html   .= $this->renderItems($page, $renderIcons, $activeIconInverse, $options);
        $html   .= "\n</ul>";
        $html   .= '</div>';
        return $html;
    }
}