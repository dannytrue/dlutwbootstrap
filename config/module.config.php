<?php
return array(
    'router' => array(
        'routes' => array(
            'twBootstrapDemo' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/tw-bootstrap-demo[/:action]',
                    'constraints' => array(
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'tw-bootstrap-demo',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controller' => array(
        'classes' => array(
            'tw-bootstrap-demo' => 'DluTwBootstrap\Controller\DemoController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'layout/layouttwb'      => __DIR__ . '/../view/layout/layouttwb.phtml',
            'layout/layouttwb-demo' => __DIR__ . '/../view/layout/layouttwb-demo.phtml',
        ),
        'template_path_stack' => array(
            'dluTwBootstrap'            => __DIR__ . '/../view',
            'dluTwBootstrap-partials'   => __DIR__ . '/../view/partials',
        ),
    ),

    'di'    => array(
        'instance'  => array(
            'alias'     => array(
                'dlutwb-nav-menu-main'      => 'Zend\Navigation\Navigation',
            ),
            'dlutwb-nav-menu-main'  => array(
                'parameters'    => array(
                    'pages' => array(
                        array(
                            'label'         => 'Form',
                            'type'          => 'uri',
                            'pages'         => array(
                                array(
                                    'label'         => 'Horizontal',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'form-horizontal',
                                ),
                                array(
                                    'label'         => 'Vertical',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'form-vertical',
                                ),
                                array(
                                    'label'         => 'Inline',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'form-inline',
                                ),
                                array(
                                    'label'         => 'Search',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
                                    'action'        => 'form-search',
                                ),
                            ),
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
                                array(
                                    'label'         => 'Buttons',
                                    'module'        => 'DluTwBootstrap',
                                    'controller'    => 'tw-bootstrap-demo',
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

    'dlu_tw_bootstrap'  => array(
        'sup_ver_zf2'       => '2.0.0beta4-251-g12ccc9c',
        'sup_ver_twb'       => '2.0.4',
    ),
);
