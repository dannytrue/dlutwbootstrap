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
    'view_manager' => array(
        'layout'                    => 'layout/layouttwb',
    ),
);