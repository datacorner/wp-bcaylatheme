<?php
/**
 * Bcaytheme Meta Boxes
 *
 */
 
 add_action( 'add_meta_boxes', 'bcaytheme_add_custom_box' );
/**
 * Add Meta Boxes.
 * 
 * Add Meta box in page and post post types.
 */ 
function bcaytheme_add_custom_box() {
	add_meta_box(
		'siderbar-layout',							  										//Unique ID
		__( 'Choisissez un mode d\'affichage', 'bcaytheme' ),   	//Title
		'bcaytheme_sidebar_layout',                   							//Callback function
		'page'                                          							//show metabox in pages
	); 
	add_meta_box(
		'siderbar-layout',							  										//Unique ID
		__( 'Select layout for this specific Post only', 'bcaytheme' ),   	//Title
		'bcaytheme_sidebar_layout',                   							//Callback function
		'post'                                          							//show metabox in posts
	); 
}

/****************************************************************************************/

global $sidebar_layout;
$sidebar_layout = array(
							'no-sidebar' 				=> array(
															'id'			=> 'bcaytheme_sidebarlayout',
															'value' 		=> 'no-sidebar',
															'label' 		=> __( 'Sans sidebar', 'bcaytheme' ),
															'thumbnail' => get_template_directory_uri() . '/panel/images/no-sidebar.png'
															),
							'right-sidebar' => array(
															'id' 			=> 'bcaytheme_sidebarlayout',
															'value' 		=> 'right-sidebar',
															'label' 		=> __( 'Avec une sidebar à droite', 'bcaytheme' ),
															'thumbnail' => get_template_directory_uri() . '/panel/images/right-sidebar.png'
															)
						);
	
/****************************************************************************************/

/**
 * Displays metabox to for sidebar layout
 */
function bcaytheme_sidebar_layout() {  
	global $sidebar_layout, $post;  
	// Use nonce for verification  
	wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );

	// Begin the field table and loop  ?>
	<table id="sidebar-metabox" class="form-table" width="100%">
		<tbody> 
			<tr>
				<?php  
				foreach ($sidebar_layout as $field) {  
					$meta = get_post_meta( $post->ID, $field['id'], true );
					if(empty( $meta ) ){
						$meta='right-sidebar';
					}
					if( ' ' == $field['thumbnail'] ): ?>
						<label class="description">
						<input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $meta ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
						</label>
					<?php else: ?>
						<td>
							<label class="description">
							<span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" width="136" height="122" alt="" /></span></br>
							<input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $meta ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
							</label>
						</td>
					<?php endif;
				} // end foreach 
				?>
			</tr>
		</tbody>
	</table>
	<?php 
}

/****************************************************************************************/


add_action('save_post', 'bcaytheme_save_custom_meta'); 
/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function bcaytheme_save_custom_meta( $post_id ) { 
	global $sidebar_layout, $post; 
	
	// Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) )
      return;
		
	// Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
      return;
		
	if ('page' == $_POST['post_type']) {  
      if (!current_user_can( 'edit_page', $post_id ) )  
         return $post_id;  
   } 
   elseif (!current_user_can( 'edit_post', $post_id ) ) {  
      return $post_id;  
   }  
	
	foreach ($sidebar_layout as $field) {  
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true); 
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {  
			update_post_meta($post_id, $field['id'], $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id, $field['id'], $old);  
		} 
	} // end foreach   
}