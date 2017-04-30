<?php 

class Wootest {


	public $user;
	public $options = array();


	public function __construct($options, $user_fields, $woo_fields) {

		add_action('init', array( $this, 'create_redirect_page'));
		add_filter('login_redirect', array( $this, 'redirect_to_page'));
		add_filter ('woocommerce_add_to_cart_redirect', array( $this, 'redirect_to_checkout'));
		add_filter('woocommerce_add_cart_item_data', array( $this, 'woo_custom_add_to_cart'));
		add_filter('page_template', array( $this, 'switch_template'));

		$WootestFields = new WootestFields($options, $user_fields, $woo_fields);
		$this->options = $options;
	}



    /**
	   * Redirect to films.
	*/
	public function create_redirect_page() {
	  	
	  	if (get_page_by_path($this->options['redirect_slug']) == null) {
	  		
			$redirect_page = array(
			  'post_title'    => $this->options['redirect_title'],
			  'post_type'     => 'page',
			  'post_name'     => $this->options['redirect_slug'],
			  'post_content'  => '',
			  'post_status'   => 'publish',
			  'post_author'   => 1
			);

			$post_id = wp_insert_post($redirect_page);

		}

	}

 
    /**
	   * Redirect to films.
	*/
	public function redirect_to_page() {
	  return $this->options['redirect_slug'];
	}



    /**
	   * Redirect to checkout.
	*/
  	public function redirect_to_checkout() {
	    return WC()->cart->get_checkout_url();
	}



    /**
	   * Limit items in cart per 1.
	*/
	public function woo_custom_add_to_cart( $cart_item_data ) {

	    global $woocommerce;
	    $woocommerce->cart->empty_cart();
	    return $cart_item_data;
	}


	public function switch_template( $page_template ) {
        
        global $post;
        if ($post->post_name == 'films') {
        	$page_template = $this->options['plugin_path'].'wootest/templates/redirect_page.php';
        }
        return $page_template;
	}
}