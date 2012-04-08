<?php
return array(
    'di'    => array(
        'instance'  => array(
            'alias'     => array(
                'tw-bootstrap-demo'     => 'DluTwBootstrap\Controller\DemoController',
            ),
            'Zend\View\Resolver\TemplatePathStack'  => array(
                'parameters'    => array(
                    'paths'         => array(
                        'dluTwBootstrap' => __DIR__ . '/../view',
                    ),
                ),
            ),
        ),
    ),
);
