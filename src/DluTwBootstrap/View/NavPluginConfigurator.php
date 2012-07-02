<?php
namespace DluTwBootstrap\View;

use Zend\ServiceManager\AbstractPluginManager;

/**
 * NavPluginConfigurator
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class NavPluginConfigurator
{
    /**
     * @var array Nav View helpers
     */
    protected $helpers = array(
        'twbNavbar'     => 'DluTwBootstrap\View\Helper\Navigation\TwbNavbar',
        'twbNavList'    => 'DluTwBootstrap\View\Helper\Navigation\TwbNavList',
        'twbTabs'       => 'DluTwBootstrap\View\Helper\Navigation\TwbTabs',
        'twbButtons'    => 'DluTwBootstrap\View\Helper\Navigation\TwbButtons',
    );

    /* **************************** METHODS ************************** */

    /**
     * Configures the submitted Plugin manager with the predefined helpers
     * @param AbstractPluginManager $pluginManager
     */
    public function configureHelperPluginManager(AbstractPluginManager $pluginManager) {
        foreach($this->helpers as $name => $fqcn) {
            $pluginManager->setInvokableClass($name, $fqcn);
        }
    }
}
