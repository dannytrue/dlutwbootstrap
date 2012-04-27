<?php
return array(
    'di'    => array(
        'instance'  => array(
            'alias'     => array(
                'tw-bootstrap-demo'         => 'DluTwBootstrap\Controller\DemoController',
                'dlutwb-nav-menu-main'      => 'Zend\Navigation\Navigation',
            ),
            'Zend\View\Resolver\TemplatePathStack'  => array(
                'parameters'    => array(
                    'paths'         => array(
                        'dluTwBootstrap' => __DIR__ . '/../view',
                        'partials'       => __DIR__ . '/../view/partials',
                    ),
                ),
            ),
            'tw-bootstrap-demo'         => array(
                'parameters'    => array(
                    'navMenuMain'        => 'dlutwb-nav-menu-main',
                ),
            ),
            'dlutwb-nav-menu-main'  => array(
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
                                    'label'         => 'Navigation',
                                    'title'         => 'Navigation Demo',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'navigation',
                                ),
                            ),
                        ),
                        array(
                            'label'     => 'A link',
                            'uri'       => 'http://www.zend.com',
                        ),
                        array(
                            'label'         => 'Navigation',
                            'title'         => 'Navigation Demo',
                            'module'        => 'DluTwBootstrap',
                            'controller'    => 'tw-bootstrap-demo',
                            'action'        => 'navigation',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
