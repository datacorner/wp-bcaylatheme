<?php
/**
 * Plugin Name: Edito Post Widget
 * Plugin URI: 
 * Description: Un widget du theme bcaytheme pour afficher un article spécifique dans l'édito
 * Version: 1.0
 * Author: BCAY
 * Author URI: 
 */
 
// Creating the widget 
class bcay_Edito_PostUnit_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'wpb_widget', 

		// Widget name will appear in UI
		'Edito - Article par ID', 

		// Widget description
		array( 'description' => 'Un widget du theme bcaytheme pour afficher un article spécifique dans l\'édito', ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$pid = $instance['pid'];
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
?>

<div class="blog-widget"> <!-- Affichage du widget -->
<?php
	$pid_query = new WP_Query('p=' . $pid );
 ?>
<?php if($pid_query->have_posts()):$pid_query->the_post();?>

<div class="high-first-item">

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
<div class="pmet">Par <?php the_author_posts_link(); ?>  le <?php the_time('j M Y'); ?></div>
<?php if ( has_post_thumbnail() ) { ?>
<a href="<?php the_permalink() ?>" >
	<img class="highmage" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=120&amp;w=303&amp;zc=1" alt="" />
</a>
<?php } ?>
<?php wpe_excerpt('wpe_excerptlength_aside', 'wpe_excerptmore'); ?>

</div>

 <?php endif; ?>

 <?php wp_reset_query(); ?>
</div>			

<?php
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$pid = $instance[ 'pid' ];
		} else {
			$title = 'Des nouvelles ?';
			$pid = 0;
		}
		
	// Widget admin form
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			 <label for="<?php echo $this->get_field_id( 'pid' ); ?>"><?php _e( 'ID de l\'article:' ); ?></label> 
			 <select name="<?php echo $this->get_field_name( 'pid' ); ?>" id="<?php echo $this->get_field_id( 'pid' ); ?>" style="width:340px;">
			 <?php
			 global $post;
			 $args = array( 'numberposts' => -1);
			 $posts = get_posts($args);
			 foreach( $posts as $post ) : setup_postdata($post); ?>
							<option <?php if ($post->ID == $instance['pid']) echo 'selected="selected"'; ?> value="<? echo $post->ID; ?>"><? echo "[ " . $post->ID . " ]"; ?><?php the_title(); ?></option>
			 <?php endforeach; ?>
			 </select>		
		</p>
<!--
		<p>
			<label for="<?php echo $this->get_field_id( 'pid' ); ?>"><?php _e( 'ID de l\'article:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'pid' ); ?>" name="<?php echo $this->get_field_name( 'pid' ); ?>" type="text" value="<?php echo esc_attr( $pid ); ?>" />
		</p>
-->
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['pid'] = ( ! empty( $new_instance['pid'] ) ) ? strip_tags( $new_instance['pid'] ) : '';
		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_bcay_Edito_PostUnit_Widget() {
	register_widget( 'bcay_Edito_PostUnit_Widget' );
}
add_action( 'widgets_init', 'wpb_load_bcay_Edito_PostUnit_Widget' );

?>