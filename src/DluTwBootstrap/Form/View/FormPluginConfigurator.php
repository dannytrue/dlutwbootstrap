<?php
namespace DluTwBootstrap\Form\View;

use Zend\View\HelperPluginManager;
use DluTwBootstrap\Form\View\Helper\FormLabelMainTwb;

/**
 * FormPluginConfigurator
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class FormPluginConfigurator
{
    /**
     * @var array View helpers
     */
    protected $invokables = array(
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
        'formcontrolgrouptwb'                   => 'DluTwBootstrap\Form\View\Helper\FormControlGroupTwb',
        'form_control_group_twb'                => 'DluTwBootstrap\Form\View\Helper\FormControlGroupTwb',
        'formelementfulltwb'                    => 'DluTwBootstrap\Form\View\Helper\FormElementFullTwb',
        'form_element_full_twb'                 => 'DluTwBootstrap\Form\View\Helper\FormElementFullTwb',
        'formtwb'                               => 'DluTwBootstrap\Form\View\Helper\FormTwb',
        'form_twb'                              => 'DluTwBootstrap\Form\View\Helper\FormTwb',
        'formfieldsettwb'                       => 'DluTwBootstrap\Form\View\Helper\FormFieldsetTwb',
        'form_fieldset_twb'                     => 'DluTwBootstrap\Form\View\Helper\FormFieldsetTwb',
    );

    protected $aliases      = array(
        'form_label_main_twb'       => 'formlabelmaintwb',
    );

    /* **************************** METHODS ************************** */

    public function getFactories() {
        $factories  = array(
            'formlabelmaintwb'                      => function($sm) {
                /* @var $sm \Zend\ServiceManager\ServiceManager */
                $formUtil       = $sm->get('dlu-twb-form-util');
                $genUtil        = $sm->get('dlu-twb-gen-util');
                $instance       = new FormLabelMainTwb($formUtil, $genUtil);
                return $instance;
            },
        );
        return $factories;
    }

    /**
     * Configures the submitted HelperPluginManager with the predefined view helpers
     * @param HelperPluginManager $helperPluginManager
     */
    public function configureHelperPluginManager(HelperPluginManager $helperPluginManager) {
        foreach($this->helpers as $name => $fqcn) {
            $helperPluginManager->setInvokableClass($name, $fqcn);
        }
    }
}