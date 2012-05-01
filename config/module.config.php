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
                            'type'       => 'uri',
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
                            'label'         => 'My Dropdown',
                            'title'         => 'My Dropdown test',
                            'type'          => 'uri',
                            'pages'         => array(
                                array(
                                    'label'     => 'File',
                                    'type'      => 'uri',
                                    'navHeader' => true,
                                ),
                                array(
                                    'label'     => 'New',
                                    'type'      => 'uri',
                                ),
                                array(
                                    'label'     => 'Open',
                                    'type'      => 'uri',
                                ),
                                array(
                                    'type'      => 'uri',
                                    'divider'   => true,
                                ),
                                array(
                                    'label'     => 'Edit',
                                    'type'      => 'uri',
                                    'navHeader' => true,
                                ),
                                array(
                                    'label'     => 'Copy',
                                    'type'      => 'uri',
                                ),
                                array(
                                    'label'     => 'Cut',
                                    'type'      => 'uri',
                                ),
                                array(
                                    'label'     => 'Paste',
                                    'type'      => 'uri',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
