DluTwBootstrap
==============

-------------------------------------------------

Introduction
------------

DluTwBootstrap is a [Zend Framework 2](http://framework.zend.com/zf2) module facilitating usage of [Twitter Bootstrap](http://twitter.github.com/bootstrap) in ZF2 applications.

Implemented features
--------------------

### [Forms](http://twitter.github.com/bootstrap/base-css.html#forms)

- All four form types supported (Horizontal, Vertical, Inline, Search)
- All ZF2 form elements except Captcha and Image are supported (see the list below).
All elements can be displayed on horizontal and vertical forms. Display on Inline and Search
forms is indicated in parenthesis:
    - Button (I, S)
    - Checkbox (I, S)
    - File (I, S)
    - Hash (I, S)
    - Hidden (I, S)
    - MultiCheckbox
    - Multiselect
    - Password (I, S)
    - Radio
    - Reset (I, S)
    - Select (I, S)
    - Submit (I, S)
    - Text (I, S)
    - Textarea
- Inline help, block help, placeholder text supported with relevant controls
- Error state and messages
- Highlighting required fields
- Prepend / append text to text input
- Multi-checkbox and radio can be optionally rendered inline
- Form legend

Supported versions
------------------

- Zend Framework 2.0.0beta3
- Twitter Bootstrap v2.0.2

--------------------------------------------------------------

Installation
------------

1.   Go to your project's directory.
2.   Clone this project into your `./vendor/` directory as a `DluTwBootstrap` module:  
     `git clone https://bitbucket.org/dlu/dlutwbootstrap.git ./vendor/DluTwBootstrap`
3.   Enable this module in your `./config/application.config.php`.

     *If you already have the Twitter Bootstrap and jQuery environment set-up properly in your project, you may skip the rest of the installation and go directly to the Demo. Otherwise please continue.*

4.   Copy (or link) everything from the module's `public` directory to your project's `public` directory (i.e. Twitter Bootstrap and jQuery css and js files).
5.   Move `dlutwbootstrap.global.config.php` from the module's root directory to your project's `./config/autoload` directory (this sets the layout script to the one supplied with the module to load all necessary css and js dependencies).

Check and Demo
--------------

Check that everything is working properly by going to the demo page included with the module where you can also see all form elements in action:  
`http://<your-machine>/tw-bootstrap-demo/form`

The demo page also describes the capabilities of the individual form elements.

-----------------------------------------------------------------------------------

How to use
----------

1.   Your form class must extend one of the four supplied form classes (and you are basically done!):
       - `\DluTwBootstrap\Form\Horizontal`
       - `\DluTwBootstrap\Form\Vertical`
       - `\DluTwBootstrap\Form\Inline`
       - `\DluTwBootstrap\Form\Search`
2.   Create and add your form elements as usual
3.   Display your form as usual
4.   ...that's all there is to it!

### Form Legend

If you want to display a form heading (legend), use the standard form method `setLegend()`.

### Element help texts

Some form elements support an inline help (short line of text displayed inline after the element) and / or a placeholder text (text displayed as an element's value until the actual value is entered). Please check the demo page to see which elements support these texts.

To set these texts, use either the element's setter methods:

- `setInlineHelp()`
- `setPlaceholderText()`

or use the element's configuration options (see below).

The standard element description is rendered below the element and is supported with all form elements on horizontal and vertical forms either via the standard element's setter (`setDescription()`) or via a configuration option:

    $this->addElement('text', 'name', array(
        'label'             => 'Name',
        'placeholderText'   => 'Your name',
        'inlineHelp'        => 'Use your real name',
        'description'       => 'We will not use your name for anything bad.',
    ));

### Inline Radio and Multicheckbox elements

To display the radio buttons or multi checkboxes inline, eiter use the element's method `setInline(true)` or use the element's configuration options:

    $this->addElement('radio', 'rateUs2', array(
        'label'             => 'Select a letter',
        'inline'            => true,
        'multiOptions'      => array(
            'a'   => 'A',
            'b'   => 'B',
            'c'   => 'C',
        ),
    ));

### Prepend or append text to Text elements

To display a fixed text before and/or after a text element, either use the element's methods `setPrependText()` and `setAppendText()` or use the element's configuration options:

    $this->addElement('text', 'salary', array(
        'label'             => 'Salary',
        'prependText'       => '$',
        'appendText'        => '.00',
    ));

Prepended and appended text is supported on horizontal and inline forms.

### Display form buttons in gray strip (horizontal form)

To display the buttons on a horizontal form indented on gray background, add them to a display group of `\DluTwBootstrap\Form\DgFormActions` class:

	$this->addDisplayGroup(array('submitBtn', 'resetBtn'),
		'formActions',
		array('displayGroupClass' => '\DluTwBootstrap\Form\DgFormActions'));
	
-----------------------------------------------------------------

Links
-----

- The DluTwBootstrap ZF2 module is available at Bitbucket: [https://bitbucket.org/dlu/dlutwbootstrap](https://bitbucket.org/dlu/dlutwbootstrap)
- You may find other useful information in my blog post at ZF Daily: [Twitter Bootstrap Forms with ZF2. Easily.](http://www.zfdaily.com/2012/04/twitter-bootstrap-forms-with-zf2-easily/) 
