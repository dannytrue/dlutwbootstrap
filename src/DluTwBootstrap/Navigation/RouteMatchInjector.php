<?php
namespace DluTwBootstrap\Navigation;

use Zend\Mvc\Router\RouteMatch;
use Zend\Navigation\AbstractContainer;
use Zend\Navigation\Page\Mvc as MvcPage;

/**
 * Route Match Injector
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class RouteMatchInjector
{
    /**
     * Current RouteMatch object
     * @var  RouteMatch
     */
    protected $routeMatch;

    /* *********************** METHODS ********************* */

    /**
     * Sets the current RouteMatch object
     * @param RouteMatch $routeMatch
     */
    public function setRouteMatch(RouteMatch $routeMatch) {
        $this->routeMatch   = $routeMatch;
    }

    /**
     * Injects the current RouteMatch object into every MVC page in the container
     * @param AbstractContainer $navContainer
     */
    public function injectRouteMatch(AbstractContainer $navContainer) {
        $ri = new \RecursiveIteratorIterator($navContainer, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($ri as $page) {
            if($page instanceof MvcPage) {
                /* @var $page MvcPage */
                $page->setRouteMatch($this->routeMatch);
            }
        }
    }
}