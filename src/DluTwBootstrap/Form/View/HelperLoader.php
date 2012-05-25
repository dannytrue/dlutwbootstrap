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
        'formlabelmaintwb'                      => 'DluTwBootstrap\Form\View\Helper\FormLabelMainTwb',
        'form_label_main_twb'                   => 'DluTwBootstrap\Form\View\Helper\FormLabelMainTwb',
        'formlabelradiooptiontwb'               => 'DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionTwb',
        'form_label_radio_option_twb'           => 'DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionTwb',
        'formlabelradiooptioninlinetwb'         => 'DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionInlineTwb',
        'form_label_radio_option_inline_twb'    => 'DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionInlineTwb',
        'formradiotwb'                          => 'DluTwBootstrap\Form\View\Helper\FormRadioTwb',
        'form_radio_twb'                        => 'DluTwBootstrap\Form\View\Helper\FormRadioTwb',
        'formlabelcheckboxoptiontwb'            => 'DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionTwb',
        'form_label_checkbox_option_twb'        => 'DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionTwb',
        'formlabelcheckboxoptioninlinetwb'      => 'DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionInlineTwb',
        'form_label_checkbox_option_inline_twb' => 'DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionInlineTwb',
        'formmulticheckboxtwb'                  => 'DluTwBootstrap\Form\View\Helper\FormMultiCheckboxTwb',
        'form_multi_checkbox_twb'               => 'DluTwBootstrap\Form\View\Helper\FormMultiCheckboxTwb',
        'form_multicheckbox_twb'                => 'DluTwBootstrap\Form\View\Helper\FormMultiCheckboxTwb',
        'formselecttwb'                         => 'DluTwBootstrap\Form\View\Helper\FormSelectTwb',
        'form_select_twb'                       => 'DluTwBootstrap\Form\View\Helper\FormSelectTwb',
        'forminputtwb'                          => 'DluTwBootstrap\Form\View\Helper\FormInputTwb',
        'form_input_twb'                        => 'DluTwBootstrap\Form\View\Helper\FormInputTwb',
    );
}
