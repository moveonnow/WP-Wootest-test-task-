# wootest_plugin

Плагин для тестового задания

		add_action('init', array( $this, 'create_redirect_page'));
		add_filter('login_redirect', array( $this, 'redirect_to_page'));
		add_filter ('woocommerce_add_to_cart_redirect', array( $this, 'redirect_to_checkout'));
		add_filter('woocommerce_add_cart_item_data', array( $this, 'woo_custom_add_to_cart'));
		add_filter('page_template', array( $this, 'switch_template'));
