<?php
/**
 * Name : MyTestPlugin test unit
 * Author: Eric
 * Version : 1.0.1
 */
class MyTestPluginTest extends WP_UnitTestCase {
    public $plugin_slug = 'my-test-plugin';

    public function setUp() {
        parent::setUp();
        $this->my_plugin = $GLOBALS['my_test_plugin'];
    }

    public function testMyFunc() {
        $this->assertEquals( 2, $this->my_plugin->test_my_func() , ' here is the test description ');
    }

    /**
	 * Check each of the WP_Query is_* functions/properties against expected boolean value.
	 *
	 * Any properties that are listed by name as parameters will be expected to be true; any others are
	 * expected to be false. For example, assertQueryTrue('is_single', 'is_feed') means is_single()
	 * and is_feed() must be true and everything else must be false to pass.
	 *
	 * @param string $prop,... Any number of WP_Query properties that are expected to be true for the current request.
	 */
	function assertQueryTrue(/* ... */) {
		global $wp_query;
		$all = array(
			'is_single', 'is_preview', 'is_page', 'is_archive', 'is_date', 'is_year', 'is_month', 'is_day', 'is_time',
			'is_author', 'is_category', 'is_tag', 'is_tax', 'is_search', 'is_feed', 'is_comment_feed', 'is_trackback',
			'is_home', 'is_404', 'is_paged', 'is_admin', 'is_attachment', 'is_singular', 'is_robots',
			'is_posts_page', 'is_post_type_archive',
		);
		$true = func_get_args();

		$passed = true;
		$not_false = $not_true = array(); // properties that were not set to expected values

		foreach ( $all as $query_thing ) {
			$result = is_callable( $query_thing ) ? call_user_func( $query_thing ) : $wp_query->$query_thing;

			if ( in_array( $query_thing, $true ) ) {
				if ( ! $result ) {
					array_push( $not_true, $query_thing );
					$passed = false;
				}
			} else if ( $result ) {
				array_push( $not_false, $query_thing );
				$passed = false;
			}
		}

		$message = '';
		if ( count($not_true) )
			$message .= implode( $not_true, ', ' ) . ' should be true. ';
		if ( count($not_false) )
			$message .= implode( $not_false, ', ' ) . ' should be false.';
		$this->assertTrue( $passed, $message );
    }
    
    function test_home() {
		$this->go_to('/');
		$this->assertQueryTrue('is_home');
	}

    function test_page() {
		$page_id = $this->factory->post->create( array( 'post_type' => 'page', 'post_title' => 'about' ) );
		$this->go_to( get_permalink( $page_id ) );
		$this->assertQueryTrue('is_page','is_singular');
    }
    function test_post() {
		$post = $this->factory->post->create_and_get( array( 'post_type' => 'post', 'post_title' => 'about' ) );
        // print debug logs in console: 
        // fwrite(STDERR, print_r($post, TRUE));
        $this->assertEquals( "post", $post->post_type );

    }
}