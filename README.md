DluTwBootstrap
==============

Introduction
------------

DluTwBootstrap is a [Zend Framework 2](http://framework.zend.com/zf2) module facilitating usage of [Twitter Bootstrap](http://twitter.github.com/bootstrap) in ZF2 applications.

Implemented features
--------------------

### [Forms](http://twitter.github.com/bootstrap/base-css.html#forms)

- All four form types supported (vertical, horizontal, inline, search)
- Supported ZF2 form elements (all except Captcha and Image):
    - Button
    - Checkbox
    - File
    - Hash
    - Hidden
    - MultiCheckbox
    - Multiselect
    - Password
    - Radio
    - Reset
    - Select
    - Submit
    - Text
    - Textarea
- Inline help, block help, placeholder text supported with relevant controls
- Error state and messages
- Highlighting required fields
- Prepend / append text to text input
- Multi-checkbox and radio can be optionally rendered inline

Supported versions
------------------

- Zend Framework 2.0.0beta3
- Twitter Bootstrap v2.0.2

Installation
------------

1.   Go to your project's directory.
2.   Clone this project into your `./vendor/` directory as a `DluTwBootstrap` module:
`git clone https://bitbucket.org/dlu/dlutwbootstrap.git ./vendor/DluTwBootstrap`
3.   Enable this module in your `./config/application.config.php`.

     *If you already have the Twitter Bootstrap and jQuery environment set-up properly in your project, you may skip the rest of the installation and go directly to the Demo. Otherwise please continue.*

4.   Copy (or link) everything from the module's `public` directory to your project's `public` directory (i.e. Twitter Bootstrap and jQuery css and js files).
5.   Copy `dlutwbootstrap.global.config.php` from the module's root directory to your project's `./config/autoload` directory (this sets the layout script to the one supplied with the module to load all necessary css and js dependencies).

Check and Demo
--------------

Check that everything is working properly by going to the demo page included with the module where you can also see all form elements in action:
`http://<your-machine>/tw-bootstrap-demo/form`

Links
-----

The DluTwBootstrap ZF2 module source code is available at Bitbucket: [bitbucket.org/dlu/dlutwbootstrap](https://bitbucket.org/dlu/dlutwbootstrap)
