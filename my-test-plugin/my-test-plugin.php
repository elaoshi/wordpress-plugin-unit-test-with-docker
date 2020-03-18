<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
/*
Plugin Name: My Test Plugin
Description: See detail in  <a href="https://github.com/elaoshi/wordpress-plugin-unit-test">WordPress Plugin Unit Test</a>
Author: Eric
Version: 1.0.1
*/

if ( ! class_exists( 'My_TEST_Plugin' ) ) :

class My_TEST_Plugin {

    /**
     * demo function for testing
     * 
     * @return 2
     */
    public function test_my_func( ) {
        return 1+1;
    }

}

$GLOBALS['my_test_plugin'] = new My_TEST_Plugin();

endif;