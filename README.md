DluTwBootstrap (ZF2 module)
===========================

-------------------------------------------------

Introduction
------------

DluTwBootstrap is a [Zend Framework 2](http://framework.zend.com/zf2) module facilitating usage of [Twitter Bootstrap](http://twitter.github.com/bootstrap) in ZF2 applications.

If you are new to DluTwBootstrap, first go to [http://apps.zfdaily.com/dlutwbootstrap-demo](http://apps.zfdaily.com/dlutwbootstrap-demo) to see it in action on-line.

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
- Inline help (hint), block help (description) and placeholder texts are supported with relevant elements
- Error state and messages (error messages are supported on Horizontal and Vertical forms)
- Highlighting required fields
- Prepend / append text to text input
- Multi-checkbox and radio can be optionally rendered inline
- Fieldset legend

Supported versions
------------------

- [Zend Framework 2.0.0rc3 - 12 (commit 22808d1273)](https://github.com/zendframework/zf2/tree/22808d127393e1e3ff898a6993cc2b4ecce2607d)
- Twitter Bootstrap v2.0.4

IMPORTANT: If the module does not seem to work, check the version of your ZF2 library and update to the version **and commit**
specified above.

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

- [DluTwBootstrap (ZF2 module) source](https://bitbucket.org/dlu/dlutwbootstrap)
- [DluTwBootstrap Demo (ZF2 module) source](https://bitbucket.org/dlu/dlutwbootstrap-demo)
- DluTwBootstrap Demo App (ZF2 application)
    - [Live Demo App @ http://apps.zfdaily.com/dlutwbootstrap-demo](http://apps.zfdaily.com/dlutwbootstrap-demo)
    - [Source](https://bitbucket.org/dlu/dlutwbootstrap-demo-app)
- [Tutorials ans discussion of DluTwBootstrap on ZF Daily](http://www.zfdaily.com/tag/dlutwbootstrap/)
