<?php
return array(
    'view_manager' => array(
        'template_map' => array(
            'layout/layouttwb'      => __DIR__ . '/../view/layout/layouttwb.phtml',
        ),
        'template_path_stack' => array(
            'dluTwBootstrap'        => __DIR__ . '/../view',
        ),
    ),
    'service_manager'   => array(
         'invokables'       => array(
            'route-match-injector'  => 'DluTwBootstrap\Navigation\RouteMatchInjector',
         ),
    ),
    'dlu_tw_bootstrap'  => array(
        'sup_ver_zf2'       => '2.0.0beta4 - 458 (commit 698d1ce396)',
        'sup_ver_twb'       => '2.0.4',
    ),
);