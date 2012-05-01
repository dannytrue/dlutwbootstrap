<?php
namespace DluTwBootstrap\View\Helper\Navigation;
use DluTwBootstrap\View\Helper\Navigation\Exception\UnsupportedElementTypeException;

class TwbNavbar extends \Zend\View\Helper\Navigation\AbstractHelper
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
        return $this->renderTwbNavbar($container);
    }

    public function renderTwbNavbar(\Zend\Navigation\Container $container = null,
                                    array $leftElements = null,
                                    array $rightElements = null,
                                    \Zend\Navigation\Page\AbstractPage $brandLink = null,
                                    $brandName = null,
                                    $fixed = false,
                                    $fixedBottom = false,
                                    $responsive = false) {
        if (null === $container) {
            $container = $this->getContainer();
        }
        if($leftElements && !is_array($leftElements)) {
            $leftElements   = array($leftElements);
        }
        if($rightElements && !is_array($rightElements)) {
            $rightElements  = array($rightElements);
        }
        $html   = '';

        //Navbar scaffolding
        $navbarClass    = 'navbar';
        if($fixed) {
            if($fixedBottom) {
                $navbarClass    .= ' navbar-fixed-bottom';
            } else {
                $navbarClass    .= ' navbar-fixed-top';
            }
        }
        $html   .= '<div class="' . $navbarClass . '">';
        $html   .= "\n" . '<div class="navbar-inner">';
        $html   .= "\n" . '<div class="container">';

        //Responsive (button)
        if($responsive) {
            $html   .= "\n" . '<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">';
            $html   .= "\n" . '<span class="icon-bar"></span>';
            $html   .= "\n" . '<span class="icon-bar"></span>';
            $html   .= "\n" . '<span class="icon-bar"></span>';
            $html   .= "\n" . '</a>';
        }

        //Brand
        if($brandLink) {
            $view   = $this->getView();
            if($brandName) {
                $brandName  = $view->escape($brandName);
            } else {
                $brandName  = $view->escape($brandLink->getLabel());
            }
            $html   .= "\n" . '<a class="brand" href="' . $brandLink->getHref() . '">' . $brandName . '</a>';
        }

        //Responsive (div)
        if($responsive) {
            $html   .= "\n" . '<div class="nav-collapse">';
        }

        //Primary container
        $html   .= "\n" . $this->getUlFromContainer($container);

        //Left elements
        if($leftElements) {
            $html   .= "\n" . $this->renderElements($leftElements, 'left');
        }

        //Right elements
        if($rightElements) {
            $html   .= "\n" . $this->renderElements($rightElements, 'right');
        }

        //Responsive (close div)
        if($responsive) {
            $html   .= "\n" . '</div>';
        }
        $html   .= "\n</div>";
        $html   .= "\n</div>";
        $html   .= "\n</div>";

        return $html;
    }

    protected function renderElements(array $elements, $align = null) {
        $html   = '';
        $view   = $this->getView();
        foreach($elements as $element) {
            if($element instanceof \Zend\Navigation\Container) {
                $html   .= "\n" . $this->getUlFromContainer($element, $align);
            } elseif ($element instanceof \Zend\Form\Form) {
                //TODO - implement rendering forms in menu
                throw new \Exception('Rendering forms in navbar not yet implemented.');
            } elseif (is_string($element)) {
                $pClass    = 'navbar-text';
                if($align == 'left') {
                    $pClass    .= ' pull-left';
                } elseif($align == 'right') {
                    $pClass    .= ' pull-right';
                }
                $html   .= "\n" . '<p class="' . $pClass . '">' . $view->escape($element) . '</p>';
            } else {
                throw new UnsupportedElementTypeException('Unsupported element type.');
            }
        }
        return $html;
    }

    protected function getUlFromContainer(\Zend\Navigation\Container $container, $align = null) {
        $ulClass    = 'nav';
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
                //A dropdown menu
                if($page->getTitle()) {
                    $title      = 'title="' . $page->getTitle() . '"';
                } else {
                    $title      = '';
                }
                $html   .= "\n" . '<li class="dropdown">';
                $html   .= "\n" . '<a href="#" class="dropdown-toggle" data-toggle="dropdown"' . $title . '>'
                                . $page->getLabel() . '<b class="caret"></b></a>';
                $html   .= "\n" . '<ul class="dropdown-menu">';
                foreach ($page->getPages() as $child) {
                    $html   .= "\n" . $this->renderDropdownItem($child);
                }
                $html   .= "\n</ul>";
                $html   .= "\n</li>";
            } else {
                //A link
                $html   .= "\n" . $this->renderLink($page);
            }
        }
        $html   .= "\n</ul>";
        return $html;
    }

    protected function renderLink(\Zend\Navigation\Page\AbstractPage $page) {
        if($page->isActive()) {
            $liClass    = ' class="active"';
        } else {
            $liClass    = '';
        }
        if($page->getTitle()) {
            $title      = 'title="' . $page->getTitle() . '"';
        } else {
            $title      = '';
        }
        $html   = '<li' . $liClass . '><a href="' . $page->getHref() . '"' . $title . '>' . $page->getLabel() . '</a></li>';
        return $html;
    }

    protected function renderDropdownItem(\Zend\Navigation\Page\AbstractPage $item) {
        if($item->navHeader) {
            $html   = '<li class="nav-header">' . $item->getLabel() . '</li>';
        } elseif($item->divider) {
            $html   = '<li class="divider"></li>';
        } else {
            $html   = $this->renderLink($item);
        }
        return $html;
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