<?php
/**
 * Plugin Name: Blog Widget
 * Plugin URI: http://web2feel.com
 * Description: A widget that displays a featured post section.
 * Version: 0.1
 * Author: Jinsona ( Widget framework courtesy - Justin Tadlock )
 * Author URI: http://web2feel.com , http://justintadlock.com
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
add_action( 'widgets_init', 'w2f_blog_widgets' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function w2f_blog_widgets() {
	register_widget( 'W2F_Blog_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class W2F_Blog_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function W2F_Blog_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'w2f_blog_widget', 'description' => __('Un widget qui affiche plusieurs articles d\'une catégorie', 'web2feel') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'w2f_blog_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'w2f_blog_widget', __('Edito - Articles par Categorie', 'web2feel'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$count = $instance['count'];
		$cats = $instance['posts_cat'];
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>


			
			
			
<div class="blog-widget"> <!-- #################  highlight category-2 #################### -->
<?php $i = 1;?>

<?php
	$high_query = new WP_Query(array('cat' => $cats,'posts_per_page'=>$count ) );
	while ($high_query->have_posts()) : $high_query->the_post();
 ?>


<?php if($i == 1):?>

	<div class="high-first-item">
	<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
	<div class="pmet">Par <?php the_author_posts_link(); ?>  le <?php the_time('j M Y'); ?></div>
<?php if ( has_post_thumbnail() ) { ?>
	<a href="<?php the_permalink() ?>" ><img class="highmage" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=120&amp;w=303&amp;zc=1" alt="" /></a>
<?php } ?>
	<?php wpe_excerpt('wpe_excerptlength_aside', 'wpe_excerptmore'); ?>

	</div>

<?php elseif($i > 1 ):?>

	<div class="high-rest-item clearfix">
<?php if ( has_post_thumbnail() ) { ?>
	<a href="<?php the_permalink() ?>" ><img class="restmage" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=60&amp;w=60&amp;zc=1" alt="" /></a>
<?php } else { ?>
	<a href="<?php the_permalink() ?>" ><img class="restmage" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo get_option('bcay_img_une_defaut'); ?>&amp;h=60&amp;w=60&amp;zc=1" alt="" /></a>
<?php } ?>
	<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
	<div class="postmeta">
	<span class="pmet">Par <?php the_author_posts_link(); ?>  le <?php the_time('j M Y'); ?> </span>
	</div>
	</div>
 <?php endif; ?>

 <?php $i++; ?>
<?php endwhile; ?>
 <?php wp_reset_query(); ?>
</div>			
			

			
<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['posts_cat'] = ( $new_instance['posts_cat'] );
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('From the blog', 'web2feel'), 'count' => 3 , 'posts_cat' => __('Uncategorized', 'web2feel'),);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'web2feel'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>
		<p>
					<label for="<?php echo $this->get_field_id( 'posts_cat' ); ?>"><?php _e( 'Category', 'web2feel' ); ?>:</label><br/>
					<?php
					$categories_args = array(
						'name'            => $this->get_field_name( 'posts_cat' ),
						'selected'        => $instance['posts_cat'],
						'orderby'         => 'Name',
						'hierarchical'    => 1,
						'show_option_all' => __( 'All Categories', 'web2feel' ),
						'hide_empty'      => '0',
					);
					wp_dropdown_categories( $categories_args ); ?>
		</p>
		
		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of posts:', 'web2feel'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" style="width:95%;" />
		</p>

	

	<?php
	}
}

?>