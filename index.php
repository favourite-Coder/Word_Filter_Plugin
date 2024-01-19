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
        $mainPageHook = add_menu_page(
            'Words To Filter',
            'Word Filter',
            'manage_options',
            'ourwordfilter',
            array($this, 'wordFilterPage'),
            'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+Cg==',
            100
        ); // plugin_dir_url(__FILE__) . 'custom.svg',
        // To use custom color on svg

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

        //LOAD CSS
        add_action("load-{$mainPageHook}", array($this, 'mainPageAssets'));

    }

    //LOAD CSS
    function mainPageAssets() {
         wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . 'styles.css');
    }

    //handleForm

    function handleForm() {
        if (wp_verify_nonce($_POST['ourNonce'], 'saveFilterWords') AND current_user_can('manage_options')) {
          update_option('plugin_words_to_filter', sanitize_text_field($_POST['plugin_words_to_filter'])); ?>
          <div class="updated">
            <p>Your filtered words were saved.</p>
          </div>
        <?php } else { ?>
          <div class="error">
            <p>Sorry, you do not have permission to perform that action.</p>
          </div>
        <?php } 
      }

    //MENU
    function wordFilterPage()
    { ?>
            <div class="wrap">
            <h1>Word Filter</h1>
            <?php if( isset($_POST['justsubmitted']) &&  $_POST['justsubmitted'] == "true") $this->handleForm() ?>
            <form  method="POST">
                <input type="hidden" name="justsubmitted" value="true">
                <?php wp_nonce_field('saveFilterWords', 'ourNounce') ?>
             <label for="plugin_words_to_filter">
                  <p>Enter a <strong>comma-seprated</strong> list of words to filter from your site's content.</p>
             </label>
             <div class="word-filter__flex-container">
                <textarea name="plugin_words_to_filter" 
                id="plugin_words_to_filter" 
                placeholder="Fool, bad, Idiot, awful, horrible"><?php echo esc_textarea(get_option('plugin_words_to_filter')) ?></textarea>
             </div>
             <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            </form>
        </div>
<?php   }

    //SUB-MENU
    function optionsSubPage()
    { ?>
 
    <?php   }
    
}

$ourWordFilterPlugin = new ourWordFilterPlugin();
