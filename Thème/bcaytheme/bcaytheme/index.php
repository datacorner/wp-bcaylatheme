<!-- index.php  -->
<?php get_header(); ?>

<div id="content">

<div id="slide">

<?php 
    echo do_shortcode("[metaslider id=" . get_option('bcay_metaslider_id') ."]"); 
?>

</div>

<div id="home-widget" class="clearfix">
<div class="hwidleft">	
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Homepage left') ) : else : ?>
	<?php endif; ?>
</div>
	
<div class="hwidright">	
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Homepage right') ) : else : ?>
	<?php endif; ?>
</div>
</div>
<div class="clear"></div>

</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>