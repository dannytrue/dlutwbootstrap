<?php
namespace DluTwBootstrap;

use Zend\Module\Manager,
    Zend\EventManager\StaticEventManager,
    Zend\Module\Consumer\AutoloaderProvider;

class Module implements AutoloaderProvider
{
    /**
     * View Renderer
     * @var \Zend\View\Renderer\PhpRenderer
     */
    protected $renderer;

    /**
     * Navbar container
     * @var \Zend\Navigation\Navigation
     */
    protected $navbarContainer;

    /* ********************** METHODS ************************** */

    public function init(Manager $moduleManager) {
        $events = StaticEventManager::getInstance();
        $events->attach('bootstrap', 'bootstrap', array($this, 'onBootstrap'));
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }


    /**
     * OnBootstrap listener
     * The navigation view helpers do not work 'out-of-the-box' currently,
     * the are configured here and in the onRoute method
     * Other information:
     * @link http://zend-framework-community.634137.n4.nabble.com/Zend-Navigation-problem-td4256771.html
     * @link http://mwop.net/slides/2012-04-25-ViewWebinar/Zf2Views.html#slide41
     * @param $e
     */
    public function onBootstrap($e) {
        $app      = $e->getParam('application');
        $locator  = $app->getLocator();

        //Store renderer as a property, it will be used by the onRoute() method
        $this->renderer         = $locator->get('Zend\View\Renderer\PhpRenderer');
        $this->navbarContainer  = $locator->get('dlutwb-nav-menu-main');

        //Register DluTwBootstrap view navigation helpers
        $this->renderer->plugin('navigation')
                       ->getPluginLoader()
                       ->registerPlugin('twbNavbar', 'DluTwBootstrap\View\Helper\Navigation\TwbNavbar');

        //Prepare the \Zend\Navigation\Page\Mvc for use in the navigation view helper
        \Zend\Navigation\Page\Mvc::setDefaultUrlHelper($this->renderer->plugin('url'));

        //Attach a listener to the app route event (to configure the url view helper)
        $app->events()->attach('route', array($this, 'onRoute'));
    }

    /**
     * OnRoute listener
     * Configures the url view helper to be usable in navigation view helpers
     * @param \Zend\Mvc\MvcEvent $e
     */
    public function onRoute(\Zend\Mvc\MvcEvent $e) {
        $routeMatch      = $e->getRouteMatch();
        $this->renderer->plugin('url')->setRouteMatch($routeMatch);
        $ri = new \RecursiveIteratorIterator($this->navbarContainer, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($ri as $page) {
            if($page instanceof \Zend\Navigation\Page\Mvc) {
                $page->setRouteMatch($routeMatch);
            }
        }
    }
}
