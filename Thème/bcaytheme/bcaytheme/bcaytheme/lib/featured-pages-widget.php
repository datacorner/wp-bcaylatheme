<?php
/**
 * Plugin Name: Blog Widget
 * Plugin URI: http://web2feel.com
 * Description: A widget that displays a featured page.
 * Version: 0.1
 * Author: BCAY
 * Author URI: 
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *
 * textdomain() used - web2feel
 *
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'w2f_page_widgets' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function w2f_page_widgets() {
	register_widget( 'W2F_Page_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class W2F_Page_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function W2F_Page_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'w2f_page_widget', 'description' => __('Un widget qui affiche une page via son ID', 'web2feel') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'w2f_page_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'w2f_page_widget', __('Edito - Page par ID', 'web2feel'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$page_id = $instance['page_id'];
		$pid = $instance['pid'];
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>


			
			
			
<div class="blog-widget"> <!-- #################  highlight category-2 #################### -->
<?php $i = 1;?>

<?php
	$high_query = new WP_Query(array('page_id' => $pid ) );
 ?>

<?php if($high_query->have_posts()):$high_query->the_post();?>

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
		/* Paramétrage du widget dans wp-admin */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['pid'] = ( $new_instance['pid'] );
		$instance['page_id'] = ( $new_instance['page_id'] );
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Nouvelles', 'page_id' => 0 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Titre</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>

		<!-- Your Name: Text Input -->
<!--
		<p>
			<label for="<?php echo $this->get_field_id( 'page_id' ); ?>">Page ID:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'page_id' ); ?>" name="<?php echo $this->get_field_name( 'page_id' ); ?>" value="<?php echo $instance['page_id']; ?>" style="width:95%;" />
		</p>

-->	
		<p>
				<label for="<?php echo $this->get_field_id( 'pid' ); ?>">Sélectionner une page [<?php echo $instance['pid']; ?>]</label><br/>
					<?php $args = array(
								'depth'            => 0,
								'child_of'         => 0,
								'selected'         => $instance['pid'],
								'echo'             => 1,
								'name'             => $this->get_field_name( 'pid' )); 
								
						  wp_dropdown_pages( $args ); ?> 
		</p>		
	
	<?php
	}
}

?>