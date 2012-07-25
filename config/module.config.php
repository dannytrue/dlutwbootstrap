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
            'dlu-twb-gen-util'      => 'DluTwBootstrap\Util',
            'dlu-twb-form-util'     => 'DluTwBootstrap\Form\Util',
         ),
    ),
    'view_helpers'      => array(
        'invokables'        => array(
            'formradiotwb'                          => 'DluTwBootstrap\Form\View\Helper\FormRadioTwb',
            'formmulticheckboxtwb'                  => 'DluTwBootstrap\Form\View\Helper\FormMultiCheckboxTwb',
            'formelementtwb'                        => 'DluTwBootstrap\Form\View\Helper\FormElementTwb',
            'forminlinehelptwb'                     => 'DluTwBootstrap\Form\View\Helper\FormHintTwb',
            'formelementdescriptiontwb'             => 'DluTwBootstrap\Form\View\Helper\FormDescriptionTwb',
            'formcontrolgrouptwb'                   => 'DluTwBootstrap\Form\View\Helper\FormControlGroupTwb',
            'formelementfulltwb'                    => 'DluTwBootstrap\Form\View\Helper\FormElementFullTwb',
            'formfieldsettwb'                       => 'DluTwBootstrap\Form\View\Helper\FormFieldsetTwb',
            'formrowtwb'                            => 'DluTwBootstrap\Form\View\Helper\FormRowTwb',
        ),
    ),
    'dlu_tw_bootstrap'  => array(
        'sup_ver_zf2'       => 'TODO! 2.0.0beta4 - 1364 (commit 8f535f3b23)',
        'sup_ver_twb'       => '2.0.4',
    ),
);