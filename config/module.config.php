<?php
return array(
    'di'    => array(
        'instance'  => array(
            //Setup for router and routes
            'Zend\Mvc\Router\RouteStack' => array(
                'parameters' => array(
                    'routes' => array(
                        'twBootstrapDemo' => array(
                            'type'    => 'Zend\Mvc\Router\Http\Segment',
                            'options' => array(
                                'route'    => '/tw-bootstrap-demo[/:action]',
                                'constraints' => array(
                                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                ),
                                'defaults' => array(
                                    'controller' => 'DluTwBootstrap\Controller\DemoController',
                                    'action'     => 'index',
                                ),
                            ),
                        ),
                    ),
                ),
            ),

            'alias'     => array(
                'dlutwb-nav-menu-main'      => 'Zend\Navigation\Navigation',
            ),
            'Zend\View\Resolver\TemplateMapResolver' => array(
                'parameters' => array(
                    'map'  => array(
                        'layout/layouttwb'      => __DIR__ . '/../view/layout/layouttwb.phtml',
                        'layout/layouttwb-demo' => __DIR__ . '/../view/layout/layouttwb-demo.phtml',
                    ),
                ),
            ),
            'Zend\View\Resolver\TemplatePathStack'  => array(
                'parameters'    => array(
                    'paths'         => array(
                        'dluTwBootstrap' => __DIR__ . '/../view',
                        'partials'       => __DIR__ . '/../view/partials',
                    ),
                ),
            ),
            'dlutwb-nav-menu-main'  => array(
                'parameters'    => array(
                    'pages' => array(
                        array(
                            'label'         => 'Forms',
                            'module'        => 'DluTwBootstrap',
                            'controller'    => 'DluTwBootstrap\Controller\DemoController',
                            'action'        => 'form'
                        ),
                        array(
                            'label'     => 'Navigation',
                            'type'       => 'uri',
                            'pages'     => array(
                                array(
                                    'label'         => 'Navbar (static)',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'DluTwBootstrap\Controller\DemoController',
                                    'action'        => 'navbar',
                                ),
                                array(
                                    'label'         => 'Nav List',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'DluTwBootstrap\Controller\DemoController',
                                    'action'        => 'nav-list',
                                ),
                                array(
                                    'label'         => 'Tabs and Pills',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'DluTwBootstrap\Controller\DemoController',
                                    'action'        => 'nav-tabs',
                                ),
                                array(
                                    'label'         => 'Buttons',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'DluTwBootstrap\Controller\DemoController',
                                    'action'        => 'buttons',
                                ),
                            ),
                        ),
                        array(
                            'label'         => 'Links',
                            'title'         => 'Resources utilized by DluTwBootstrap',
                            'type'          => 'uri',
                            'pages'         => array(
                                array(
                                    'label'     => 'ZFDaily Tutorials',
                                    'type'      => 'uri',
                                    'navHeader' => true,
                                ),
                                array(
                                    'label'     => 'Twitter Bootstrap Forms with ZF2. Easily.',
                                    'uri'       => 'http://www.zfdaily.com/2012/04/twitter-bootstrap-forms-with-zf2-easily',
                                ),
                                array(
                                    'type'      => 'uri',
                                    'divider'   => true,
                                ),
                                array(
                                    'label'     => 'Git Repository',
                                    'type'      => 'uri',
                                    'navHeader' => true,
                                ),
                                array(
                                    'label'     => 'DluTwBootstrap on Bitbucket',
                                    'uri'       => 'https://bitbucket.org/dlu/dlutwbootstrap',
                                ),
                                array(
                                    'type'      => 'uri',
                                    'divider'   => true,
                                ),
                                array(
                                    'label'     => 'Twitter Bootstrap',
                                    'type'      => 'uri',
                                    'navHeader' => true,
                                ),
                                array(
                                    'label'     => 'Forms',
                                    'uri'       => 'http://twitter.github.com/bootstrap/base-css.html#forms',
                                ),
                                array(
                                    'label'     => 'Navigation',
                                    'uri'       => 'http://twitter.github.com/bootstrap/components.html#navs',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
