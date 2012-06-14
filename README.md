DluTwBootstrap
==============

-------------------------------------------------

Introduction
------------

DluTwBootstrap is a [Zend Framework 2](http://framework.zend.com/zf2) module facilitating usage of [Twitter Bootstrap](http://twitter.github.com/bootstrap) in ZF2 applications.

Implemented features
--------------------

### [Forms](http://twitter.github.com/bootstrap/base-css.html#forms)

- All four Twitter Bootstrap form types supported - Horizontal, Vertical, Inline, Search
- Supported form elements
    - Button
    - Checkbox
    - Csrf
    - File
    - Hidden
    - MultiCheckbox (not supported on Inline and Search forms)
    - Multiselect (not supported on Inline and Search forms)
    - Password
    - Radio (not supported on Inline and Search forms)
    - Reset
    - Select
    - Submit
    - Text
    - Textarea
- Unsupported form elements
    - Captcha
- Inline help, block help (description) and placeholder text are supported with relevant elements
- Error state and messages (error messages are supported on Horizontal and Vertical forms)
- Highlighting required fields
- Prepend / append text to text input
- Multi-checkbox and radio can be optionally rendered inline
- Fieldset legend

Supported versions
------------------

- Zend Framework 2.0.0beta4 (v2.0.0beta4-405-g6bf5dff)
- Twitter Bootstrap v2.0.4

--------------------------------------------------------------

Installation
------------

1.   Go to your project's directory.
2.   Clone this project into your `./vendor/` directory as a `DluTwBootstrap` module:  
     `git clone https://bitbucket.org/dlu/dlutwbootstrap.git ./vendor/DluTwBootstrap`
3.   Enable this module in your `./config/application.config.php`.

     *If you already have the Twitter Bootstrap and jQuery environment set-up properly in your project, you just need to reference the style override file `/public/css/dlu-tw-bootstrap.css` in your layout and you may skip the rest of the installation.
     (Please see `/view/layout/layouttwb.phtml` if you are not sure where this file fits.)*

4.   Copy (or link) everything from the module's `public` directory to your project's `public` directory (i.e. Twitter Bootstrap and jQuery css files, js files and images).
5.   Move `module.DluTwBootstrap.global.php` from the module's root directory to your project's `./config/autoload` directory .This sets the layout script to the one supplied with the module to load all necessary css and js dependencies.
     (Do not do this if you have your own layout and you already have the Twitter Bootstrap environment set-up properly in your project!)

Check and Demo
--------------

To check that you have installed the module properly and to see it in action, install the [DluTwBootstrap Demo module](https://bitbucket.org/dlu/dlutwbootstrap-demo).
The Demo module is the easiest and quickest way to start working with the DluTwBootstrap module as it clearly shows the rendered output (e.g. a form) 'side by side'
with the actual source code used to produce that output. Recommended!

-----------------------------------------------------------------------------------

Links
-----

- The DluTwBootstrap ZF2 module is available at Bitbucket: [https://bitbucket.org/dlu/dlutwbootstrap](https://bitbucket.org/dlu/dlutwbootstrap)
- The DluTwBootstrap Demo ZF2 module is available at Bitbucket: [https://bitbucket.org/dlu/dlutwbootstrap-demo](https://bitbucket.org/dlu/dlutwbootstrap-demo)
- You may find other useful information and ask about the DluTwBootstrap module on the ZF Daily blog: [DluTwBootstrap stuff @ ZF Daily](http://www.zfdaily.com/tag/dlutwbootstrap/)
