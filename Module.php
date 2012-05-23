<?php
namespace DluTwBootstrap;
use DluTwBootstrap\Form\View\HelperLoader as FormHelperLoader;

class Module
{
    /* ********************** METHODS ************************** */

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

    public function init(\Zend\ModuleManager\ModuleManager $moduleManager) {
        $sharedEvents   = $moduleManager->events()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', array($this, 'onModuleDispatch'));
    }

    /**
     * OnBootstrap listener
     * The navigation view helpers do not work 'out-of-the-box' currently,
     * they are configured here and in the onRoute method
     * Other information:
     * @link http://zend-framework-community.634137.n4.nabble.com/Zend-Navigation-problem-td4256771.html
     * @link http://mwop.net/slides/2012-04-25-ViewWebinar/Zf2Views.html#slide41
     * @param $e
     */
    public function onBootstrap(\Zend\Mvc\MvcEvent $e) {
        $application    = $e->getApplication();
        $serviceManager = $application->getServiceManager();
        $renderer       = $serviceManager->get('viewRenderer');
        $broker         = $renderer->getBroker();
        $helperLoader   = $broker->getClassLoader();
        /* @var $helperLoader \Zend\View\HelperLoader */

        //Register form view helpers
        $helperLoader->registerPlugins(new FormHelperLoader());

        //Register DluTwBootstrap view navigation helpers
        $renderer->plugin('navigation')
                       ->getPluginLoader()
                       ->registerPlugin('twbNavbar', 'DluTwBootstrap\View\Helper\Navigation\TwbNavbar')
                       ->registerPlugin('twbNavList', 'DluTwBootstrap\View\Helper\Navigation\TwbNavList')
                       ->registerPlugin('twbTabs', 'DluTwBootstrap\View\Helper\Navigation\TwbTabs')
                       ->registerPlugin('twbButtons', 'DluTwBootstrap\View\Helper\Navigation\TwbButtons');
        //Prepare the \Zend\Navigation\Page\Mvc for use in the navigation view helper
        \Zend\Navigation\Page\Mvc::setDefaultUrlHelper($renderer->plugin('url'));
        //Attach a listener to the app route event
        $application->events()->attach('route', array($this, 'onRoute'));
    }

    /**
     * OnRoute listener
     * @param \Zend\Mvc\MvcEvent $e
     */
    public function onRoute(\Zend\Mvc\MvcEvent $e) {
        $serviceManager = $e->getApplication()->getServiceManager();
        $renderer       = $serviceManager->get('viewRenderer');
        $locator        = $serviceManager->get('dependencyInjector');
        /* @var $locator \Zend\Di\Di */
        $routeMatch     = $e->getRouteMatch();
        //Configure routeMatchInjector with the current routeMatch
        $locator->instanceManager()->setParameters(
            'DluTwBootstrap\Navigation\RouteMatchInjector', array(
                'routeMatch' => $routeMatch,
        ));
        //Inject routeMatch into url helper
        $renderer->plugin('url')->setRouteMatch($routeMatch);
    }

    public function onModuleDispatch(\Zend\Mvc\MvcEvent $e) {

        //Set the layout template for every action in this module
        $controller         = $e->getTarget();
        $controller->layout('layout/layouttwb-demo');

        //Set the main menu into the layout view model
        $serviceManager     = $e->getApplication()->getServiceManager();
        $locator  = $serviceManager->get('dependencyInjector');
        /* @var $locator \Zend\Di\Di */
        $navbarContainer    = $locator->get('dlutwb-nav-menu-main');
        $viewModel          = $e->getViewModel();
        $viewModel->setVariable('navbar', $navbarContainer);

        //Inject routeMatch into every MVC page, otherwise marking pages as active does not work
        $routeMatchInjector = $locator->get('DluTwBootstrap\Navigation\RouteMatchInjector');
        /* @var $routeMatchInjector \DluTwBootstrap\Navigation\RouteMatchInjector */
        $routeMatchInjector->injectRouteMatch($navbarContainer);
    }
}
