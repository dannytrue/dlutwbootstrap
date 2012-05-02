<?php
namespace DluTwBootstrap\Demo\Navigation;

use DluTwBootstrap\Form\Search;
/**
 * DemoSearch Form for Navbar
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class DemoSearchForm extends Search
{
    /**
     * Init form
     */
    public function init() {
        $this->setName('searchForm');
        $this->addElement('text', 'searchTerm', array(
            'placeholderText'   => 'Search',
            'class'             => 'search-query',
            'required'          => true,
            'filters'           => array(
                'stringTrim'
            ),
        ));

        /*
        $this->addElement('submit', 'submitBtn', array(
            'label'             => 'Go!',
            'title'             => 'Submit button',
            'class'             => 'search-query',
        ));
        */
   }
}