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
        'formtextareatwb'                       => 'DluTwBootstrap\Form\View\Helper\FormTextareaTwb',
        'form_textarea_twb'                     => 'DluTwBootstrap\Form\View\Helper\FormTextareaTwb',
        'formelementtwb'                        => 'DluTwBootstrap\Form\View\Helper\FormElementTwb',
        'form_element_twb'                      => 'DluTwBootstrap\Form\View\Helper\FormElementTwb',
        'forminlinehelptwb'                     => 'DluTwBootstrap\Form\View\Helper\FormInlineHelpTwb',
        'form_inline_help_twb'                  => 'DluTwBootstrap\Form\View\Helper\FormInlineHelpTwb',
        'formelementdescriptiontwb'             => 'DluTwBootstrap\Form\View\Helper\FormElementDescriptionTwb',
        'form_element_description_twb'          => 'DluTwBootstrap\Form\View\Helper\FormElementDescriptionTwb',
        'formelementerrorstwb'                  => 'DluTwBootstrap\Form\View\Helper\FormElementErrorsTwb',
        'form_element_errors_twb'               => 'DluTwBootstrap\Form\View\Helper\FormElementErrorsTwb',
    );
}
