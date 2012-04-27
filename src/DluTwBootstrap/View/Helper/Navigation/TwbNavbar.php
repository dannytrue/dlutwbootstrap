<?php
namespace DluTwBootstrap\View\Helper\Navigation;

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
        if (null === $container) {
            $container = $this->getContainer();
        }

        $html   = '';
        $html   .= '<div class="navbar">';
        $html   .= "\n" . '<div class="navbar-inner">';
        $html   .= "\n" . '<div class="container">';

        $ul     = $this->getUlFromContainer($container);
        $html   .= "\n" . $ul;

        $html   .= "\n</div>";
        $html   .= "\n</div>";
        $html   .= "\n</div>";

        return $html;
    }

    protected function getUlFromContainer(\Zend\Navigation\Container $container) {
        $html   = '<ul class="nav">';
        $pages  = $container->getPages();
        foreach ($pages as $page) {
            /* @var $page \Zend\Navigation\Page\AbstractPage */
            if($page->hasPages()) {
                //A dropdown menu
                $html   .= "\n" . '<li class="dropdown">';
                $html   .= "\n" . '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $page->getLabel() . '<b class="caret"></b></a>';
                $html   .= "\n" . '<ul class="dropdown-menu">';
                foreach ($page->getPages() as $child) {
                    $html   .= "\n" . $this->renderLink($child);
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
        //TODO - active is not working!
        if($page->isActive()) {
            $liClass    = ' class="active"';
        } else {
            $liClass    = '';
        }
        $html   = '<li' . $liClass . '><a href="' . $page->getHref() . '">' . $page->getLabel() . '</a></li>';
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