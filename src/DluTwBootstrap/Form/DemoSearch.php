<?php
namespace DluTwBootstrap\Form;

/**
 * DemoSearch Form
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class DemoSearch extends Search
{
    /**
     * Init form
     */
    public function init() {
        $this->setName('searchForm');
        $this->setLegend('Search Form Demo');
        $this->setAttrib('id', 'search-form-demo');

        $this->addElement('hidden', 'hiddenInfo', array(
            'filters'   => array(
                'int',
            )
        ));

        $this->addElement('text', 'searchTerm', array(
            'placeholderText'   => 'Search term',
            'class'             => 'search-query',
            'required'          => true,
            'filters'           => array(
                'stringTrim'
            ),
        ));

        $this->addElement('submit', 'submitBtn', array(
            'label'             => 'Go!',
            'title'             => 'Submit button',
        ));
   }
}