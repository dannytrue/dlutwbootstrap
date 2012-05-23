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
        'formlabeltwb'          => 'DluTwBootstrap\Form\View\Helper\FormLabelTwb',
        'form_label_twb'        => 'DluTwBootstrap\Form\View\Helper\FormLabelTwb',

    );
}
