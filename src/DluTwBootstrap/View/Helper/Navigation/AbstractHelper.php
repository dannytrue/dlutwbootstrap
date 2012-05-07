<?php
namespace DluTwBootstrap\View\Helper\Navigation;

abstract class AbstractHelper extends \Zend\View\Helper\Navigation\AbstractHelper
{


    /* *********************** METHODS *************************** */

    protected function getUlFromContainer(\Zend\Navigation\Container $container,
                                          $ulClass,
                                          $align = null,
                                          $renderIcons = true,
                                          $activeIconInverse = true) {
        if($align == 'left') {
            $ulClass    .= ' pull-left';
        } elseif($align == 'right') {
            $ulClass    .= ' pull-right';
        }
        $html   = '<ul class="' . $ulClass . '">';
        $html   .= $this->renderItems($container, $renderIcons, $activeIconInverse);
        $html   .= "\n</ul>";
        return $html;
    }

    protected function renderItems(\Zend\Navigation\Container $container, $renderIcons = true, $activeIconInverse = true) {
        $pages  = $container->getPages();
        $html   = '';
        foreach ($pages as $page) {
            /* @var $page \Zend\Navigation\Page\AbstractPage */
            if(!$this->accept($page)) {
                continue;
            }
            if($page->navHeader) {
                //Nav Header
                $html   .= $this->renderNavHeader($page, $renderIcons, $activeIconInverse);
            } elseif($page->divider) {
                //Divider
                $html   .= $this->renderDivider($page);
            } elseif($page->hasPages()) {
                //Subnav
                $html   .= $this->renderSubnav($page);
            } else {
                //Menu link
                $html   .= $this->renderLink($page, $renderIcons, $activeIconInverse);
            }
        }
        return $html;
    }

    protected function renderSubnav(\Zend\Navigation\Page\AbstractPage $page,
                                      $renderIcons = true,
                                      $activeIconInverse = true) {
        //Get label and title
        $label      = $this->translate($page->getLabel());
        $title      = $this->translate($page->getTitle());
        $escaper    = $this->view->plugin('escape');
        //Get attribs
        $liAttribs = array(
            'id'            => $page->getId(),
            'class'         => 'dropdown' . ($page->isActive(true) ? ' active' : ''),
        );
        $aAttribs   = array(
            'title'         => $title,
            'class'         => 'dropdown-toggle' . ($page->getClass() ? (' ' . $page->getClass()) : ''),
            'data-toggle'   => 'dropdown',
        );
        if($renderIcons) {
            $iconHtml   = $this->htmlifyIcon($page, $activeIconInverse);
        } else {
            $iconHtml   = '';
        }
        $html   = '';
        $html   .= "\n" . '<li' . $this->_htmlAttribs($liAttribs) . '>';
        $html   .= "\n" . '<a href="#"' . $this->_htmlAttribs($aAttribs) . '>'
                   . $iconHtml . $escaper($label) . '<b class="caret"></b></a>';
        $html   .= "\n" . '<ul class="dropdown-menu">';
        $html   .= $this->renderItems($page, $renderIcons, $activeIconInverse);
        $html   .= "\n</ul>";
        $html   .= "\n</li>";
        return $html;
    }

    protected function renderNavHeader(\Zend\Navigation\Page\AbstractPage $item,
                                       $renderIcons = true,
                                       $activeIconInverse = true) {
        $icon   = $this->htmlifyIcon($item, $renderIcons, $activeIconInverse);
        $html   = '<li class="nav-header">' . $icon . $this->getView()->escape($item->getLabel()) . '</li>';
        return $html;
    }

    protected function renderDivider(\Zend\Navigation\Page\AbstractPage $item) {
        $html   = '<li class="divider"></li>';
        return $html;
    }

    protected function renderLink(\Zend\Navigation\Page\AbstractPage $page,
                                  $renderIcons = true,
                                  $activeIconInverse = true) {
        //Active
        if($page->isActive(true)) {
            $liClass    = ' class="active"';
        } else {
            $liClass    = '';
        }
        //Assemble html
        $html   = '<li' . $liClass . '>' . $this->htmlifyA($page, $renderIcons, $activeIconInverse) . '</li>';
        return $html;
    }

    /**
     * Returns an HTML string containing an 'a' element for the given page
     * @param \Zend\Navigation\Page\AbstractPage $page
     * @param bool $renderIcons
     * @param bool $activeIconInverse
     * @return string
     */
    public function htmlifyA(\Zend\Navigation\Page\AbstractPage $page, $renderIcons = true, $activeIconInverse = true) {
        // get label and title for translating
        $label      = $this->translate($page->getLabel());
        $title      = $this->translate($page->getTitle());
        $escaper    = $this->view->plugin('escape');
        //Get attribs for anchor element
        $attribs = array(
            'id'     => $page->getId(),
            'title'  => $title,
            'class'  => $page->getClass(),
            'href'   => $page->getHref(),
            'target' => $page->getTarget()
        );
        if($renderIcons) {
            $iconHtml   = $this->htmlifyIcon($page, $activeIconInverse);
        } else {
            $iconHtml   = '';
        }
        $html       = '<a' . $this->_htmlAttribs($attribs) . '>'
                      . $iconHtml . $escaper($label)
                      . '</a>';
        return $html;
    }

    protected function htmlifyIcon(\Zend\Navigation\Page\AbstractPage $item, $activeIconInverse = true) {
        if($item->icon) {
            $iClass     = $item->icon;
            if($activeIconInverse && $item->isActive(true)) {
                $classes    = explode(' ', $iClass);
                $iconWhiteClassKey  = array_search('icon-white', $classes);
                if($iconWhiteClassKey === false) {
                    //icon-white class not found
                    $iClass .= ' icon-white';
                } else {
                    //icon-white class found
                    unset($classes[$iconWhiteClassKey]);
                    $iClass = implode(' ', $classes);
                }
            }
            $icon   = '<i class="' . $iClass . '"></i>' . "\n";
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

    protected function translate($text) {
        $t = $this->getTranslator();
        if ($this->getUseTranslator()
            && $t
            && is_string($text)
            && !empty($text)) {
                $text = $t->translate($text);
        }
        return $text;
    }
}