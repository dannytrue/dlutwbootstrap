<?php
namespace DluTwBootstrap\Controller;
use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    DluTwBootstrap\Form\DemoVertical,
    DluTwBootstrap\Form\DemoHorizontal,
    DluTwBootstrap\Form\DemoInline,
    DluTwBootstrap\Form\DemoSearch;

/**
 * DemoController
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class DemoController extends ActionController
{

    /* ***************************** METHODS ****************************** */

    /**
     * Form action
     * @return \Zend\View\Model\ViewModel
     */
    public function formAction() {
        $formVertical   = new DemoVertical();
        $nameVertical   = $formVertical->getElement('name');
        $nameVertical->setErrors(array('Validation error 1', 'Another validation problem', 'You should correct also this'));
        $formHorizontal = new DemoHorizontal();
        $nameHorizontal = $formHorizontal->getElement('name2');
        $nameHorizontal->setErrors(array('This is not right', 'Error!'));
        $formInline     = new DemoInline();
        $formSearch     = new DemoSearch();
        $viewModel      = new ViewModel(array(
            'formVertical'      => $formVertical,
            'formHorizontal'    => $formHorizontal,
            'formInline'        => $formInline,
            'formSearch'        => $formSearch,
        ));
        return $viewModel;
    }

    public function formHorizontalAction() {
        $form           = new \DluTwBootstrap\Demo\Form\BlockForm();
        $inputFilter    = new \DluTwBootstrap\Demo\Form\BlockFormInputFilter();
        $form->setInputFilter($inputFilter);
        $form->get('fullName')->setMessages(array('This is not right', 'This is wrong', 'You should correct this',));
        $form->get('notes')->setMessages(array('Hmm, you screwed this', 'Try again',));
        $viewModel  = new ViewModel(array(
            'form'  => $form,
        ));
        return $viewModel;
    }

    /**
     * Navigation action
     * @return \Zend\View\Model\ViewModel
     */
    public function navbarAction() {
        $viewModel      = new ViewModel(array(
        ));
        return $viewModel;
    }

    public function navListAction() {
        $navList        = new \Zend\Navigation\Navigation(array(
            array(
                'label'     => 'Main',
                'type'      => 'uri',
                'navHeader' => true,
            ),
            array(
                'label'     => 'Home',
                'type'      => 'uri',
                'icon'      => 'icon-home',
            ),
            array(
                'label'     => 'Library',
                'type'      => 'uri',
                'icon'      => 'icon-book',
                'active'    => true,
            ),
            array(
                'label'     => 'Applications',
                'type'      => 'uri',
                'icon'      => 'icon-pencil',
                'pages'     => array(
                    array(
                        'label'     => 'Sub 1',
                        'type'      => 'uri',
                    ),
                    array(
                        'label'     => 'Sub 2',
                        'type'      => 'uri',
                    ),
                ),
            ),
            array(
                'label'     => 'User Account',
                'type'      => 'uri',
                'navHeader' => true,
            ),
            array(
              'label'     => 'Profile',
              'type'      => 'uri',
              'icon'      => 'icon-user',
            ),
            array(
              'label'     => 'Settings',
              'type'      => 'uri',
              'icon'      => 'icon-cog',
            ),
            array(
                'type'      => 'uri',
                'divider'   => true,
            ),
            array(
                'label'     => 'Help',
                'type'      => 'uri',
                'icon'      => 'icon-flag',
            ),
        ));
        $viewModel      = new ViewModel(array(
            'navList'       => $navList,
        ));
        return $viewModel;
    }

    public function navTabsAction() {
        $navTabs        = new \Zend\Navigation\Navigation(array(
            array(
                'label'     => 'Home',
                'type'      => 'uri',
                'icon'      => 'icon-home',
            ),
            array(
                'label'     => 'Library',
                'type'      => 'uri',
                'icon'      => 'icon-book',
                'active'    => true,
            ),
            array(
                'label'     => 'Applications',
                'type'      => 'uri',
                'icon'      => 'icon-pencil',
                'pages'     => array(
                    array(
                        'label'     => 'Text Editor',
                        'type'      => 'uri',
                    ),
                    array(
                        'label'     => 'Spreadsheet',
                        'type'      => 'uri',
                    ),
                ),
            ),
        ));
        $viewModel      = new ViewModel(array(
            'navTabs'       => $navTabs,
        ));
        return $viewModel;
    }

    public function buttonsAction() {
        $nav        = new \Zend\Navigation\Navigation(array(
            array(
                'label'     => 'Home',
                'type'      => 'uri',
                'icon'      => 'icon-home',
            ),
            array(
              'type'      => 'uri',
              'divider' => true,
            ),
            array(
                'label'     => 'Play',
                'type'      => 'uri',
                'icon'      => 'icon-play',
                'active'    => true,
            ),
            array(
                'label'     => 'Pause',
                'type'      => 'uri',
                'icon'      => 'icon-pause',
            ),
            array(
                'label'     => 'Stop',
                'type'      => 'uri',
                'icon'      => 'icon-stop',
            ),
            array(
              'type'      => 'uri',
              'divider' => true,
            ),
            array(
                'label'     => 'App',
                'type'      => 'uri',
                'id'        => 'app',
                'icon'      => 'icon-random',
                'pages'     => array(
                    array(
                        'label'     => 'Text Editor',
                        'type'      => 'uri',
                        'icon'      => 'icon-pencil',
                    ),
                    array(
                        'label'     => 'Spreadsheet',
                        'type'      => 'uri',
                        'icon'      => 'icon-th',
                    ),
                    array(
                        'type'      => 'uri',
                        'divider' => true,
                    ),
                    array(
                        'label'     => 'Media Player',
                        'type'      => 'uri',
                        'icon'      => 'icon-music',
                    ),
                    array(
                        'label'     => 'E-mail Client',
                        'type'      => 'uri',
                        'icon'      => 'icon-envelope',
                    ),
                ),
            ),
            array(
              'label'     => 'Vol -',
              'type'      => 'uri',
              'icon'      => 'icon-volume-down',
            ),
            array(
              'label'     => 'Vol +',
              'type'      => 'uri',
              'icon'      => 'icon-volume-up',
            ),
        ));
        $viewModel      = new ViewModel(array(
            'nav'       => $nav,
        ));
        return $viewModel;
    }

    public function indexAction() {
        return new ViewModel();
    }
}