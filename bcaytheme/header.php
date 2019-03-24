<!-- header.php  -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php $skin = get_option('bcay_skin'); ?>
<link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/css/<?php echo $skin;?>.css" type="text/css" media="screen" />


<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<?php 
	wp_enqueue_script('jquery');
	wp_enqueue_script('effects', get_stylesheet_directory_uri() .'/js/effects.js');
	wp_enqueue_script('superfish', get_stylesheet_directory_uri() .'/js/superfish.js'); 
	wp_enqueue_script('flexslider', get_stylesheet_directory_uri() .'/js/jquery.flexslider-min.js');
	wp_enqueue_script('effects', get_stylesheet_directory_uri() .'/js/effects.js');
	wp_enqueue_script('easing', get_stylesheet_directory_uri() . '/js/jquery.easing.1.3.js');
?>

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>


<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="wrapper">  <!-- wrapper begin -->

<div id="masthead"><!-- masthead begin -->
	<div id="top"> 
		<!-- Entete logo + titre -->
		<div id="logo">	
			<a href="<?php bloginfo('siteurl');?>">
			<img src="<?php echo get_option('bcay_url_logo'); ?>"></img>
			</a>
		</div>	
		<div id="blogname">	
			<h1><a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></h1>
			<h2><?php bloginfo( 'description' ); ?></h2>
		</div>
		<!-- .social-icons -->
		<div class="topad">
			<!-- <div class="social-icons clearfix"> -->
			<?php if (function_exists('wen_social_links')) echo wen_social_links(); ?> 
			<!-- </div> -->
		</div>
		<!-- Fin entete logo + titre + social -->
	</div>
	
	<!-- Debut menu (style: wrapper/masthead/menutop) -->
	<div id="menutop">
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Header Menu') ) : else : ?>
		<?php endif; ?>
	</div>
	<!-- Fin menu -->
	<div class="clear">
</div><!--end masthead-->

<div id="casing">