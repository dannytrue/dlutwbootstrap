<?php
namespace DluTwBootstrap;

/**
 * Module
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
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
        $application                = $e->getApplication();
        $serviceManager             = $application->getServiceManager();
        $renderer                   = $serviceManager->get('viewRenderer');
        /* @var $renderer \Zend\View\Renderer\PhpRenderer */
        $viewHelperPluginManager    = $renderer->getHelperPluginManager();
        /* @var $viewHelperPluginManager \Zend\View\HelperPluginManager */

        //Register DluTwBootstrap view navigation helpers
        $navPluginConfigurator      = new \DluTwBootstrap\View\NavPluginConfigurator();
        $navHelperPluginManager     = $viewHelperPluginManager->get('navigation')->getPluginManager();
        $navPluginConfigurator->configureHelperPluginManager($navHelperPluginManager);

        //Prepare the \Zend\Navigation\Page\Mvc for use in the navigation view helper
        $router                     = $serviceManager->get('router');
        \Zend\Navigation\Page\Mvc::setDefaultRouter($router);
        //Attach a listener to the app route event
        $application->getEventManager()->attach('route', array($this, 'onRoute'));
    }

    /**
     * OnRoute listener
     * @param \Zend\Mvc\MvcEvent $e
     */
    public function onRoute(\Zend\Mvc\MvcEvent $e) {
        $serviceManager = $e->getApplication()->getServiceManager();
        $routeMatch     = $e->getRouteMatch();
        $renderer       = $serviceManager->get('viewRenderer');
        //Configure routeMatchInjector with the current routeMatch
        $routeMatchInjector = $serviceManager->get('route-match-injector');
        /* @var $routeMatchInjector \DluTwBootstrap\Navigation\RouteMatchInjector */
        $routeMatchInjector->setRouteMatch($routeMatch);
        //Inject routeMatch into url helper
        $renderer->plugin('url')->setRouteMatch($routeMatch);
    }

    public function getViewHelperConfiguration() {
        return array(
            'factories'     => array(
                'formlabelmaintwb'      => function($sm) {
                    $formUtil       = $sm->get('dlu-twb-form-util');
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelMainTwb($genUtil, $formUtil);
                    return $instance;
                },
                'formlabelradiooptiontwb'      => function($sm) {
                    $formUtil       = $sm->get('dlu-twb-form-util');
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionTwb($genUtil, $formUtil);
                    return $instance;
                },
                'formlabelradiooptioninlinetwb'      => function($sm) {
                    $formUtil       = $sm->get('dlu-twb-form-util');
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionInlineTwb($genUtil, $formUtil);
                    return $instance;
                },
                'formlabelcheckboxoptiontwb'      => function($sm) {
                    $formUtil       = $sm->get('dlu-twb-form-util');
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionTwb($genUtil, $formUtil);
                    return $instance;
                },
                'formlabelcheckboxoptioninlinetwb'      => function($sm) {
                    $formUtil       = $sm->get('dlu-twb-form-util');
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionInlineTwb($genUtil, $formUtil);
                    return $instance;
                },
                'formselecttwb'      => function($sm) {
                    $formUtil       = $sm->get('dlu-twb-form-util');
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormSelectTwb($genUtil, $formUtil);
                    return $instance;
                },
                'forminputtwb'      => function($sm) {
                    $formUtil       = $sm->get('dlu-twb-form-util');
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormInputTwb($genUtil, $formUtil);
                    return $instance;
                },
                'formtextareatwb'      => function($sm) {
                    $formUtil       = $sm->get('dlu-twb-form-util');
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormTextareaTwb($genUtil, $formUtil);
                    return $instance;
                },
                'formelementerrorstwb'      => function($sm) {
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormElementErrorsTwb($genUtil);
                    return $instance;
                },
                'formtwb'      => function($sm) {
                    $genUtil        = $sm->get('dlu-twb-gen-util');
                    $instance       = new \DluTwBootstrap\Form\View\Helper\FormTwb($genUtil);
                    return $instance;
                },
            ),
        );
    }
}
