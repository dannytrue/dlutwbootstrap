<?php
namespace DluTwBootstrap\Form\View;

use DluTwBootstrap\Util as GenUtil;
use DluTwBootstrap\Form\Util as FormUtil;

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
        'formradiotwb'                          => 'DluTwBootstrap\Form\View\Helper\FormRadioTwb',
        'formmulticheckboxtwb'                  => 'DluTwBootstrap\Form\View\Helper\FormMultiCheckboxTwb',
        'formelementtwb'                        => 'DluTwBootstrap\Form\View\Helper\FormElementTwb',
        'forminlinehelptwb'                     => 'DluTwBootstrap\Form\View\Helper\FormHintTwb',
        'formelementdescriptiontwb'             => 'DluTwBootstrap\Form\View\Helper\FormDescriptionTwb',
        'formcontrolgrouptwb'                   => 'DluTwBootstrap\Form\View\Helper\FormControlGroupTwb',
        'formcontrolstwb'                       => 'DluTwBootstrap\Form\View\Helper\FormControlsTwb',
        'formelementfulltwb'                    => 'DluTwBootstrap\Form\View\Helper\FormElementFullTwb',
        'formfieldsettwb'                       => 'DluTwBootstrap\Form\View\Helper\FormFieldsetTwb',
        'formrowtwb'                            => 'DluTwBootstrap\Form\View\Helper\FormRowTwb',
        'formhinttwb'                           => 'DluTwBootstrap\Form\View\Helper\FormHintTwb',
        'formdescriptiontwb'                    => 'DluTwBootstrap\Form\View\Helper\FormDescriptionTwb',
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
     * @param \DluTwBootstrap\Util $genUtil
     * @param \DluTwBootstrap\Form\Util $formUtil
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
            'formlabelmaintwb'                  => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelMainTwb($genUtil, $formUtil);
                return $instance;
            },
            'formlabelradiooptiontwb'           => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionTwb($genUtil, $formUtil);
                return $instance;
            },
            'formlabelradiooptioninlinetwb'     => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelRadioOptionInlineTwb($genUtil, $formUtil);
                return $instance;
            },
            'formlabelcheckboxoptiontwb'        => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionTwb($genUtil, $formUtil);
                return $instance;
            },
            'formlabelcheckboxoptioninlinetwb'  => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormLabelCheckboxOptionInlineTwb($genUtil, $formUtil);
                return $instance;
            },
            'formselecttwb'                     => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormSelectTwb($genUtil, $formUtil);
                return $instance;
            },
            'forminputtwb'                      => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormInputTwb($genUtil, $formUtil);
                return $instance;
            },
            'formtextareatwb'                   => function($sm) use ($genUtil, $formUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormTextareaTwb($genUtil, $formUtil);
                return $instance;
            },
            'formelementerrorstwb'              => function($sm) use ($genUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormElementErrorsTwb($genUtil);
                return $instance;
            },
            'formtwb'                           => function($sm) use ($genUtil) {
                $instance       = new \DluTwBootstrap\Form\View\Helper\FormTwb($genUtil);
                return $instance;
            },
        );
    }
}
