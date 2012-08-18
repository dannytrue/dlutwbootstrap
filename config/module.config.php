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
            'dlu_twb_gen_util'                      => 'DluTwBootstrap\GenUtil',
            'dlu_twb_form_util'                     => 'DluTwBootstrap\Form\FormUtil',
            'dlu_twb_nav_view_helper_configurator'  => 'DluTwBootstrap\View\Helper\Navigation\PluginConfigurator',
         ),
    ),
    'dlu_tw_bootstrap'  => array(
        'sup_ver_zf2'       => '2.0.0rc4 - 0 (commit 022113e031)',
        'sup_ver_twb'       => '2.0.4',
    ),
);