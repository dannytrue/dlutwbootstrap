<?php
namespace DluTwBootstrap\Demo\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class SearchForm extends Form
{
    public function __construct() {
        parent::__construct();

        $this->setName('demoFormInline');
        $this->setAttribute('method', 'post');


        //Hidden
        $this->add(array(
                       'name' => 'hiddenField',
                       'attributes' => array(
                           'type'       => 'hidden',
                           'value'      => 'myHiddenValue',
                       ),
                   ));

        //Text
        $this->add(array(
                        'name'          => 'text',
                        'attributes'    => array(
                            'type'               => 'text',
                            //'label'              => 'Text',
                            'placeholder'        => 'Search term...',
                            'inlineHelp'         => 'Inline help',
                            'description'        => 'Description.',
                        ),
        ));

        //Csrf
        $this->add(new Element\Csrf('csrf'));

        //Submit button
        $this->add(array(
                       'name' => 'submitBtn',
                       'attributes' => array(
                           'type'  => 'submit',
                           'value' => 'Search',
                       ),
                   ));
    }
}