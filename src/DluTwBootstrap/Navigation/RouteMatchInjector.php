<?php
namespace DluTwBootstrap\Navigation;

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
     * @var  \Zend\Mvc\Router\RouteMatch
     */
    protected $routeMatch;

    /* *********************** METHODS ********************* */

    /**
     * Constructor
     * @param \Zend\Mvc\Router\RouteMatch $routeMatch
     */
    public function __construct(\Zend\Mvc\Router\RouteMatch $routeMatch) {
        $this->routeMatch   = $routeMatch;
    }

    /**
     * Injects the current RouteMatch object into every MVC page in the container
     * @param \Zend\Navigation\AbstractContainer $navContainer
     */
    public function injectRouteMatch(\Zend\Navigation\AbstractContainer $navContainer) {
        $ri = new \RecursiveIteratorIterator($navContainer, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($ri as $page) {
            if($page instanceof \Zend\Navigation\Page\Mvc) {
                /* @var $page \Zend\Navigation\Page\Mvc */
                $page->setRouteMatch($this->routeMatch);
            }
        }
    }
}