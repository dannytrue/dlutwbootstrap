<?php
namespace DluTwBootstrap\Controller;
use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    DluTwBootstrap\Form\DemoVertical,
    DluTwBootstrap\Form\DemoHorizontal,
    DluTwBootstrap\Form\DemoInline,
    DluTwBootstrap\Form\DemoSearch;

class DemoController extends ActionController
{
    public function formAction() {
        $formVertical   = new DemoVertical();
        $nameVertical   = $formVertical->getElement('name');
        $nameVertical->setErrors(array('Validation error 1', 'Another validation problem', 'You should correct also this'));
        $formHorizontal = new DemoHorizontal();
        $nameHorizontal = $formHorizontal->getElement('name');
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