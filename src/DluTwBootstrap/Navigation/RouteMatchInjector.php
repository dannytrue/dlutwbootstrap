<?php
namespace DluTwBootstrap\Navigation;

class RouteMatchInjector
{
    /**
     * @var  \Zend\Mvc\Router\RouteMatch
     */
    protected $routeMatch;

    /* *********************** METHODS ********************* */

    public function __construct(\Zend\Mvc\Router\RouteMatch $routeMatch = null) {
        $this->setRouteMatch($routeMatch);
    }

    public function setRouteMatch(\Zend\Mvc\Router\RouteMatch $routeMatch = null) {
        $this->routeMatch   = $routeMatch;
    }

    public function injectRouteMatch(\Zend\Navigation\Container $navContainer) {
        $ri = new \RecursiveIteratorIterator($navContainer, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($ri as $page) {
            if($page instanceof \Zend\Navigation\Page\Mvc) {
                $page->setRouteMatch($this->routeMatch);
            }
        }

    }
}