<?php

/*
plugin Name: My Word Filter Plugin
Description: Replaces a list of words.
Version: 1.0
Author: Favour
Author URI: 

Text Domain: wcpdomain
Domain Path: /languages

*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class ourWordFilterPlugin
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'ourMenu'));
    }

    //MENU
    function ourMenu()
    {
        add_menu_page(
            'Words To Filter',
            'Word Filter',
            'manage_options',
            'ourwordfilter',
            array(
                $this, 'wordFilterPage'
            ),
            'dashicons-smiley',
            100
        );

        //SUB-MENU Word List
        add_submenu_page(
            'ourwordfilter',
            'Word To Filter',
            'Word List',
            'manage_options',
            'ourwordfilter',
            array(
                $this, 'wordFilterPage'
            )
        );

        //SUB-MENU 2
        add_submenu_page(
            'ourwordfilter',
            'Word Filter Options',
            'Options',
            'manage_options',
            'word-filter-options',
            array(
                $this, 'optionsSubPage'
            )
        );
    }

    //SUB-MENU
    function optionsSubPage()
    { ?>
        Hello Developer
    <?php   }

    //MENU
    function wordFilterPage()
    { ?>
        Hello Developer
<?php   }
}

$ourWordFilterPlugin = new ourWordFilterPlugin();
