<?php
return array(
    'di'    => array(
        'instance'  => array(
            'alias'     => array(
                'tw-bootstrap-demo'     => 'DluTwBootstrap\Controller\DemoController',
                'nav-menu-main'         => 'Zend\Navigation\Navigation',
            ),
            'Zend\View\Resolver\TemplatePathStack'  => array(
                'parameters'    => array(
                    'paths'         => array(
                        'dluTwBootstrap' => __DIR__ . '/../view',
                    ),
                ),
            ),
            'tw-bootstrap-demo'         => array(
                'parameters'    => array(
                    'navbar'    => 'nav-menu-main',
                ),
            ),
            'nav-menu-main'             => array(
                'parameters'    => array(
                    'pages' => array(
                        array(
                            'label'     => 'Demo',
                            'title'     => 'DluTwBootstrap Demo',
                            'uri'       => '#',
                            'pages'     => array(
                                array(
                                    'label'         => 'Forms',
                                    'title'         => 'Forms Demo',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'form'
                                ),
                                array(
                                    'label'         => 'NavBar',
                                    'title'         => 'NavBar Demo',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'navbar',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
