<?php
namespace DluTwBootstrap\Form;

class DemoSearch extends Search
{
    public function init() {
        $this->setName('searchForm');
        $this->setLegend('Search Form Demo');

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