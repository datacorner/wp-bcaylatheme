<?php
/**
 * Plugin Name: Edito Post'it widget
 * Plugin URI: 
 * Description: Un widget du theme bcaytheme pour afficher un contenu dans un postit
 * Version: 1.0
 * Author: BCAY
 * Author URI: 
 */
 
// Creating the widget 
class bcay_Edito_Postit_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'bcay_Edito_Postit_Widget', 

		// Widget name will appear in UI
		'Edito - Postit', 

		// Widget description
		array( 'description' => 'Un widget du theme bcaytheme pour afficher un contenu dans un postit', ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$postit = $instance['postit'];
		$textsize = $instance['textsize'];
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			//echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
?>

	<div class="bcayMainContainer">
		<div class="bcayBloc">
		<p class="bcayBlocTitre"><?php echo $title; ?></p>
		<p style="font-size: <?php echo $instance['textsize']; ?>;"><?php echo $instance['postit']; ?></p>
		</div>
	</div>
		
<?php
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$postit = $instance[ 'postit' ];
			$textsize = $instance[ 'textsize' ];
		} else {
			$title = 'A noter !';
			$postit = '';
			$textsize = 'x-small';
		}
		
	// Widget admin form
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titre:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'postit' ); ?>"><?php _e( 'Contenu:' ); ?></label> 
			<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'postit' ); ?>" name="<?php echo $this->get_field_name( 'postit' ); ?>""><?php echo esc_attr( $postit ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'textsize' ); ?>"><?php _e( 'Taille du texte:' ); ?></label> 
			 <select name="<?php echo $this->get_field_name( 'textsize' ); ?>" id="<?php echo $this->get_field_id( 'textsize' ); ?>">
					<option <?php if ("larger" == $instance['textsize']) echo 'selected="selected"'; ?> value="larger">larger</option>
					<option <?php if ("large" == $instance['textsize']) echo 'selected="selected"'; ?> value="large">large</option>
					<option <?php if ("medium" == $instance['textsize']) echo 'selected="selected"'; ?> value="medium">medium</option>
					<option <?php if ("small" == $instance['textsize']) echo 'selected="selected"'; ?> value="small">small</option>
					<option <?php if ("smaller" == $instance['textsize']) echo 'selected="selected"'; ?> value="smaller">smaller</option>
					<option <?php if ("x-small" == $instance['textsize']) echo 'selected="selected"'; ?> value="x-small">x-small</option>
					<option <?php if ("xx-small" == $instance['textsize']) echo 'selected="selected"'; ?> value="xx-small">xx-small</option>
			 </select>	
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['postit'] = ( ! empty( $new_instance['postit'] ) ) ? strip_tags( $new_instance['postit'] ) : '';
		$instance['textsize'] = ( ! empty( $new_instance['textsize'] ) ) ? strip_tags( $new_instance['textsize'] ) : '';
		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_bcay_Edito_Postit_Widget() {
	register_widget( 'bcay_Edito_Postit_Widget' );
}
add_action( 'widgets_init', 'wpb_load_bcay_Edito_Postit_Widget' );

?>