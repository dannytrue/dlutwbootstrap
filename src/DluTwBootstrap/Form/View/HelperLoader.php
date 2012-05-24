<?php
namespace DluTwBootstrap\Form\View;

use Zend\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for TWB form view helpers.
 */
class HelperLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased view helpers
     */
    protected $plugins = array(
        'formlabelmaintwb'      => 'DluTwBootstrap\Form\View\Helper\FormLabelMainTwb',
        'form_label_main_twb'   => 'DluTwBootstrap\Form\View\Helper\FormLabelMainTwb',

    );
}
