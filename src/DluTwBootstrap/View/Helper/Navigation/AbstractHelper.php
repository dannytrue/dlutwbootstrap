<?php
namespace DluTwBootstrap\View\Helper\Navigation;

abstract class AbstractHelper extends \Zend\View\Helper\Navigation\AbstractHelper
{


    /* *********************** METHODS *************************** */

    protected function getUlFromContainer(\Zend\Navigation\Container $container,
                                          $ulClass = '',
                                          $align = null,
                                          $renderIcons = true) {
        if($ulClass == '') {
            $ulClass    = 'nav';
        } else {
            $ulClass    = 'nav ' . $ulClass;
        }
        if($align == 'left') {
            $ulClass    .= ' pull-left';
        } elseif($align == 'right') {
            $ulClass    .= ' pull-right';
        }
        $html   = '<ul class="' . $ulClass . '">';
        $pages  = $container->getPages();
        foreach ($pages as $page) {
            /* @var $page \Zend\Navigation\Page\AbstractPage */
            if($page->hasPages()) {
                //A dropdown
                $html   .= "\n" . $this->renderDropdown($page, $renderIcons);
            } else {
                //A page without children
                $html   .= "\n" . $this->renderItem($page, $renderIcons);
            }
        }
        $html   .= "\n</ul>";
        return $html;
    }

    protected function renderDropdown(\Zend\Navigation\Page\AbstractPage $page, $renderIcons = true) {
        $html   = '';
        if($page->getTitle()) {
            $title      = 'title="' . $page->getTitle() . '"';
        } else {
            $title      = '';
        }
        $icon           = $this->renderIcon($page, $renderIcons, $page->isActive());
        $html   .= "\n" . '<li class="dropdown">';
        $html   .= "\n" . '<a href="#" class="dropdown-toggle" data-toggle="dropdown"' . $title . '>'
                   . $icon . $page->getLabel() . '<b class="caret"></b></a>';
        $html   .= "\n" . '<ul class="dropdown-menu">';
        foreach ($page->getPages() as $child) {
            $html   .= "\n" . $this->renderItem($child, $renderIcons);
        }
        $html   .= "\n</ul>";
        $html   .= "\n</li>";
        return $html;
    }

    protected function renderItem(\Zend\Navigation\Page\AbstractPage $item, $renderIcons = true) {
        if($item->navHeader) {
            $html   = $this->renderNavHeader($item, $renderIcons);
        } elseif($item->divider) {
            $html   = $this->renderDivider($item);
        } else {
            $html   = $this->renderLink($item, $renderIcons);
        }
        return $html;
    }

    protected function renderNavHeader(\Zend\Navigation\Page\AbstractPage $item, $renderIcons = true) {
        $icon   = $this->renderIcon($item, $renderIcons, false);
        $html   = '<li class="nav-header">' . $icon . $item->getLabel() . '</li>';
        return $html;
    }

    protected function renderDivider(\Zend\Navigation\Page\AbstractPage $item) {
        $html   = '<li class="divider"></li>';
        return $html;
    }

    protected function renderLink(\Zend\Navigation\Page\AbstractPage $page, $renderIcons = true) {
        //Active
        if($page->isActive()) {
            $liClass    = ' class="active"';
        } else {
            $liClass    = '';
        }
        //Title
        if($page->getTitle()) {
            $title      = 'title="' . $page->getTitle() . '"';
        } else {
            $title      = '';
        }
        //Icon
        $icon   = $this->renderIcon($page, $renderIcons, $page->isActive());
        //Assemble html
        $html   = '<li' . $liClass . '><a href="' . $page->getHref() . '"' . $title . '>'
                  . $icon
                  . $page->getLabel() . '</a></li>';
        return $html;
    }

    protected function renderIcon(\Zend\Navigation\Page\AbstractPage $item, $renderIcons = true, $white = false) {
        if($item->icon && $renderIcons) {
            $iClass = $item->icon;
            if($white) {
                $iClass .= ' icon-white';
            }
            $icon   = "\n" . '<i class="' . $iClass . '"></i>' . "\n";
        } else {
            $icon   = '';
        }
        return $icon;
    }

    /**
     * View helper entry point:
     * Retrieves helper and optionally sets container to operate on
     * @param  \Zend\Navigation\Container $container [optional] container to operate on
     * @return TwbNavbar    fluent interface, returns self
     */
    public function __invoke(\Zend\Navigation\Container $container = null) {
        if (null !== $container) {
            $this->setContainer($container);
        }
        return $this;
    }
}