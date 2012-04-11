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
}