<!-- search.php  -->
<?php get_header(); ?>

<div id="content">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
		
<div class="post" id="post-<?php the_ID(); ?>">

	<div class="title">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	</div>
	<div class="postmeta">
		<span class="pmet">Ecrit par <?php the_author_posts_link(); ?>  le <?php the_time('j M Y'); ?></span>
	</div>	
	<div class="entry">
		<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
		<div class="clear"></div>
	</div>

</div>
<?php endwhile; ?>

<?php getpagenavi(); ?>

<?php else : ?>

	<h1 class="title">Non trouv&eacute;</h1>
	<p>D&eacute;sol&eacute; mais ce que vous cherchez ne se trouve pas ici.</p>

<?php endif; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>