<?php 

class WootestFields {

	
	public $options = array();

	public function __construct($options, $user_fields, $woo_fields) {

		// woo fields
		add_action( 'woocommerce_product_options_general_product_data', array( $this, 'woo_fields_display' ));
		add_action( 'woocommerce_process_product_meta', array( $this, 'woo_fields_save' ));

		// user registration form
		add_action( 'register_form', array( $this, 'user_fields_display' ), 10, 1 );
		add_action( 'user_register', array( $this, 'user_fields_save' ), 10, 1 );
		add_action( 'show_user_profile', array( $this, 'edit_user_profile'));
		add_action( 'edit_user_profile', array( $this, 'edit_user_profile'));
		add_action( 'personal_options_update',  array( $this, 'edit_user_profile_update'));
		add_action( 'edit_user_profile_update', array( $this, 'edit_user_profile_update'));

		$this->options = $options;
 		$this->user_fields = $user_fields;
 		$this->woo_fields = $woo_fields;
	}



	/**
	   * Woo fields display
	*/

	public function woo_fields_display () { 
		
		foreach ($this->woo_fields as $key => $field) {
		
			woocommerce_wp_text_input( 
				array( 
					'id'          => $field['id'], 
					'label'       => __( $field['label'], 'woocommerce' ), 
					'placeholder' => $field['placeholder'],
					'desc_tip'    => 'true',
					'description' => __( $field['description'], 'woocommerce' ) 
				)
			);	

		}
		

	}



	/**
	   * Woo fields save
	*/
	public function woo_fields_save ($post_id) {  
		
		foreach ($this->woo_fields as $key => $field) {

			if(!empty($_POST[$field['id']])) {
				update_post_meta( $post_id, $field['id'], esc_attr( $_POST[$field['id']]));
			}
		
		}
			
	}


	
	/**
	   * User registration fields display
	*/
	public function user_fields_display( $user_id ) {

		foreach ($this->user_fields as $key => $field) {
		
			?>
			    <p>
			        <label for="<?php echo $field['id']; ?>"><?php _e($field['label']); ?><br />
			        <input type="text" name="<?php echo $field['id']; ?>" id="<?php echo $field['id']; ?>" class="input" value="<?php echo (isset($_POST[$field['id']])) ? esc_attr($_POST[$field['id']]) :  ''; ?>" size="25" tabindex="20" />
			        </label>
			    </p>

			<?php

		}

	}



	/**
	   * User registration fields save
	*/
	public function user_fields_save( $user_id ) {

		foreach ($this->user_fields as $key => $field) {

		    if (isset($_POST[$field['id']])) {
		 
		        update_user_meta($user_id, $field['id'], $_POST[$field['id']]);
		    }

		}

	}




	/**
	   Edit user profile
	*/

  	public function edit_user_profile($user) { 

		?>
		<h2> Wootest user options </h2>
		<table class="form-table">
			<tbody>
				
				<?php

					foreach ($this->user_fields as $key => $field) {					
					
					?>
					
						<tr>
							<th><?php echo $field['label']; ?></th>
							<td>
								<input type="text" name="<?php echo $field['id']; ?>" id="<?php echo $field['id']; ?>" value="<? 
										if (!empty(get_user_meta($user->data->ID, $field['id'], true ))) { 
												echo esc_attr(get_user_meta($user->data->ID, $field['id'], true ));
										} 
								?>" />  
							</td>
						</tr>

					<?php

					}

				?>

			</tbody>
		</table>
		<?php
	}




	/**
	   Update user profile
	*/

  	public function edit_user_profile_update($user_id) { 

	 	if ( ! current_user_can( 'edit_user', $user_id ) ) {
	   	 return false;
	    }

	    foreach ($this->user_fields as $key => $field) {
	    	update_usermeta( $user_id, $field['id'], $_POST[$field['id']] );
	    }

			
	}



}


?>