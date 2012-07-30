<?php
namespace DluTwBootstrap\Form\View;

use DluTwBootstrap\GenUtil;
use DluTwBootstrap\Form\FormUtil;

use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Service manager configuration for form view helpers
 */
class HelperConfig implements ConfigInterface
{
    /**
     * @var array Pre-aliased view helpers
     */
    protected $invokables = array(
        'formactionstwb'                        => 'DluTwBootstrap\Form\View\Helper\FormActionsTwb',
        'formcontrolgrouptwb'                   => 'DluTwBootstrap\Form\View\Helper\FormControlGroupTwb',
        'formcontrolstwb'                       => 'DluTwBootstrap\Form\View\Helper\FormControlsTwb',
        'formdescriptiontwb'                    => 'DluTwBootstrap\Form\View\Helper\FormDescriptionTwb',
        //'formelementfulltwb'                    => 'DluTwBootstrap\Form\View\Helper\FormElementFullTwb',
        'formelementtwb'                        => 'DluTwBootstrap\Form\View\Helper\FormElementTwb',
        'formlabeltwb'                          => 'DluTwBootstrap\Form\View\Helper\FormLabelTwb',
        'formhiddentwb'                         => 'DluTwBootstrap\Form\View\Helper\FormHiddenTwb',
        'formhinttwb'                           => 'DluTwBootstrap\Form\View\Helper\FormHintTwb',
        'forminputtwb'                          => 'DluTwBootstrap\Form\View\Helper\FormInputTwb',
    );

    /**
     * @var GenUtil
     */
    protected $genUtil;

    /**
     * @var FormUtil
     */
    protected $formUtil;

    /* ******************** METHODS ******************** */

    /**
     * Constructor
     * @param GenUtil $genUtil
     * @param FormUtil $formUtil
     */
    public function __construct(GenUtil $genUtil, FormUtil $formUtil)
    {
        $this->genUtil  = $genUtil;
        $this->formUtil = $formUtil;
    }

    /**
     * Configure the provided service manager instance with the configuration
     * in this class.
     *
     * In addition to using each of the internal properties to configure the
     * service manager, also adds an initializer to inject ServiceManagerAware
     * classes with the service manager.
     *
     * @param  ServiceManager $serviceManager
     * @return void
     */
    public function configureServiceManager(ServiceManager $serviceManager)
    {
        foreach ($this->invokables as $name => $service) {
            $serviceManager->setInvokableClass($name, $service);
        }
        $factories  = $this->getFactories();
        foreach ($factories as $name => $factory) {
            $serviceManager->setFactory($name, $factory);
        }
    }

    /**
     * Returns an array of view helper factories
     * @return array
     */
    protected function getFactories()
    {
        $genUtil    = $this->genUtil;
        $formUtil   = $this->formUtil;
        return array(
            'formbuttontwb'                     => function($sm) use ($genUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormButtonTwb($genUtil);
                return $instance;
            },
            'formcheckboxtwb'                   => function($sm) use ($formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormCheckboxTwb($formUtil);
                return $instance;
            },
            'formelementerrorstwb'              => function($sm) use ($genUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormElementErrorsTwb($genUtil);
                return $instance;
            },
            'formfieldsettwb'                   => function($sm) use ($formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormFieldsetTwb($formUtil);
                return $instance;
            },
            'formfiletwb'                       => function($sm) use ($formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormFileTwb($formUtil);
                return $instance;
            },
            /*
            'formlabelcheckboxoptioninlinetwb'  => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionInlineTwb($genUtil, $formUtil);
                return $instance;
            },
            'formlabelcheckboxoptiontwb'        => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionTwb($genUtil, $formUtil);
                return $instance;
            },
            'formlabelmaintwb'                  => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelMainTwb($genUtil, $formUtil);
                return $instance;
            },
            'formlabelradiooptioninlinetwb'     => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionInlineTwb($genUtil, $formUtil);
                return $instance;
            },
            'formlabelradiooptiontwb'           => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionTwb($genUtil, $formUtil);
                return $instance;
            },
            */
            'formmulticheckboxtwb'              => function($sm) use ($genUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormMultiCheckboxTwb($genUtil);
                return $instance;
            },
            'formpasswordtwb'                   => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormPasswordTwb($genUtil, $formUtil);
                return $instance;
            },
            'formradiotwb'                      => function($sm) use ($genUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormRadioTwb($genUtil);
                return $instance;
            },
            'formresettwb'                      => function($sm) use ($genUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormResetTwb($genUtil);
                return $instance;
            },
            'formrowtwb'                        => function($sm) use ($genUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormRowTwb($genUtil);
                return $instance;
            },
            'formselecttwb'                     => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormSelectTwb($genUtil, $formUtil);
                return $instance;
            },
            'formsubmittwb'                     => function($sm) use ($genUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormSubmitTwb($genUtil);
                return $instance;
            },
            'formtexttwb'                       => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormTextTwb($genUtil, $formUtil);
                return $instance;
            },
            'formtextareatwb'                   => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormTextareaTwb($genUtil, $formUtil);
                return $instance;
            },
            'formtwb'                           => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormTwb($genUtil, $formUtil);
                return $instance;
            },
        );
    }
}
