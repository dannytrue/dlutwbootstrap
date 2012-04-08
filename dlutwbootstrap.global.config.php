<?php
/* ************************* NOTE ******************************
 * Move this file to <your project>/config/autoload directory! *
 * *************************************************************
 */

/**
 * DluTwBootstrap - Global configuration override
 * Responsibility: Set layout to the layout script provided with the DluTwBootstrap package to set-up
 * Twitter Bootstrap environment.
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */

return array(
    'di' => array(
        'instance' => array(
            // Defining where the layout/layout view should be located
            'Zend\View\Resolver\TemplateMapResolver' => array(
                'parameters' => array(
                    'map'  => array(
                        'layout/layout' => __DIR__ . '/../../vendor/DluTwBootstrap/view/layout/layouttwb.phtml',
                    ),
                ),
            ),
        ),
    ),
);
