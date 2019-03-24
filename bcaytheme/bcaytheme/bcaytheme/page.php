<!-- page.php  -->
<?php get_header(); ?>



<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php $disposition = get_post_meta($post->ID, 'bcaytheme_sidebarlayout', true); ?>
<?php if ($disposition != 'no-sidebar') : ?>
<div id="content">	
<?php else: ?>
<div id="content_s_sb">	
<?php endif; ?>
	
<div class="post" id="post-<?php the_ID(); ?>">

	<div class="title">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	</div>

	<div class="entry">
		<?php the_content('Lire la suite &raquo;'); ?>
		<div class="clear"></div>
		<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>

</div>

<?php endwhile; endif; ?>
</div>		


<?php if ($disposition != 'no-sidebar') : ?>
<?php get_sidebar(); ?>
<?php endif; ?>

<?php get_footer(); ?>