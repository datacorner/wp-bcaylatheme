<!-- single.php  -->
<?php get_header(); ?>

<div id="content" >

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

	<div class="title">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	</div>
	<div class="postmeta">
		<span class="pmet">Ecrit par <?php the_author_posts_link(); ?>  le <?php the_time('j M Y'); ?> </span>
	</div>	
	<div class="entry">
		<?php the_content('Lire plus &raquo;'); ?>
		<div class="clear"></div>
		<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>

	<div class="titlemeta clearfix">
		<span class="categori"> Cat&eacute;gories: <?php the_category(', '); ?>   </span>
	
	</div>
</div>

<?php comments_template(); ?>
<?php endwhile; endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>