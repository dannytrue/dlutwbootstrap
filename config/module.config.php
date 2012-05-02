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
                            'label'         => 'Forms',
                            'module'        => 'DluTwBootstrap',
                            'controller'    => 'tw-bootstrap-demo',
                            'action'        => 'form'
                        ),
                        array(
                            'label'     => 'Navigation',
                            'type'       => 'uri',
                            'pages'     => array(
                                array(
                                    'label'         => 'Navbar (static)',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'navbar',
                                ),
                                array(
                                    'label'         => 'Nav List',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'nav-list',
                                ),
                                array(
                                    'label'         => 'Tabs and Pills',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'nav-tabs',
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
