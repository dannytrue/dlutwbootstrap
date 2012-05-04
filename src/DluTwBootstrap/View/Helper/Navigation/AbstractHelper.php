<?php
namespace DluTwBootstrap\View\Helper\Navigation;

abstract class AbstractHelper extends \Zend\View\Helper\Navigation\AbstractHelper
{


    /* *********************** METHODS *************************** */

    protected function getUlFromContainer(\Zend\Navigation\Container $container,
                                          $ulClass,
                                          $align = null,
                                          $renderIcons = true,
                                          $activeIconWhite = true) {
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
                $html   .= "\n" . $this->renderDropdown($page, $renderIcons, $activeIconWhite);
            } else {
                //A page without children
                $html   .= "\n" . $this->renderItem($page, $renderIcons, $activeIconWhite);
            }
        }
        $html   .= "\n</ul>";
        return $html;
    }

    protected function renderDropdown(\Zend\Navigation\Page\AbstractPage $page,
                                      $renderIcons = true,
                                      $activeIconWhite = true) {
        $view   = $this->getView();
        $html   = '';
        if($page->getTitle()) {
            $title      = 'title="' . $view->escape($page->getTitle()) . '"';
        } else {
            $title      = '';
        }
        $icon           = $this->renderIcon($page, $renderIcons, $activeIconWhite);
        $html   .= "\n" . '<li class="dropdown">';
        $html   .= "\n" . '<a href="#" class="dropdown-toggle" data-toggle="dropdown"' . $title . '>'
                   . $icon . $view->escape($page->getLabel()) . '<b class="caret"></b></a>';
        $html   .= "\n" . '<ul class="dropdown-menu">';
        foreach ($page->getPages() as $child) {
            $html   .= "\n" . $this->renderItem($child, $renderIcons, $activeIconWhite);
        }
        $html   .= "\n</ul>";
        $html   .= "\n</li>";
        return $html;
    }

    protected function renderItem(\Zend\Navigation\Page\AbstractPage $item,
                                  $renderIcons = true,
                                  $activeIconWhite = true) {
        if($item->navHeader) {
            $html   = $this->renderNavHeader($item, $renderIcons, $activeIconWhite);
        } elseif($item->divider) {
            $html   = $this->renderDivider($item);
        } else {
            $html   = $this->renderLink($item, $renderIcons, $activeIconWhite);
        }
        return $html;
    }

    protected function renderNavHeader(\Zend\Navigation\Page\AbstractPage $item,
                                       $renderIcons = true,
                                       $activeIconWhite = true) {
        $icon   = $this->renderIcon($item, $renderIcons, $activeIconWhite);
        $html   = '<li class="nav-header">' . $icon . $this->getView()->escape($item->getLabel()) . '</li>';
        return $html;
    }

    protected function renderDivider(\Zend\Navigation\Page\AbstractPage $item) {
        $html   = '<li class="divider"></li>';
        return $html;
    }

    protected function renderLink(\Zend\Navigation\Page\AbstractPage $page,
                                  $renderIcons = true,
                                  $activeIconWhite = true) {
        //Return empty string if the page is not visible or not allowed in ACL
        //TODO - Implement ACL support
        if(!$page->isVisible()) {
            return '';
        }
        $view   = $this->getView();
        //Active
        if($page->isActive()) {
            $liClass    = ' class="active"';
        } else {
            $liClass    = '';
        }
        //Title
        if($page->getTitle()) {
            $title      = 'title="' . $view->escape($page->getTitle()) . '"';
        } else {
            $title      = '';
        }
        //Icon
        $icon   = $this->renderIcon($page, $renderIcons, $activeIconWhite);
        //Assemble html
        $html   = '<li' . $liClass . '><a href="' . $page->getHref() . '"' . $title . '>'
                  . $icon
                  . $view->escape($page->getLabel()) . '</a></li>';
        return $html;
    }

    protected function renderIcon(\Zend\Navigation\Page\AbstractPage $item, $renderIcons = true, $activeIconWhite = true) {
        if($item->icon && $renderIcons) {
            $iClass = $item->icon;
            if($activeIconWhite && $item->isActive()) {
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