<?php
add_action('admin_menu', 't_guide');

function t_guide() {
	add_theme_page('Guide du thème', 'Guide', 8, 'user_guide', 't_guide_options');
	
}

function t_guide_options() {

?>
<div class="wrap">
<div class="opwrap" style="background:#fff; margin:20px auto; width:80%; padding:30px; border:1px solid #ddd;" >

<div id="wrapr">

<div class="headsection">
<h2 style="clear:both; padding:20px 10px; color:#444; font-size:32px; background:#eee">Guide d'utilisation du thème</h2>
</div>

<div class="gblock">
<h2>Plugins nécessaires</h2>

<p>Le plugin (extension) : <strong>Meta Slider (Version 2.7.2)</strong> est utilisé pour le slider dans la home page (il faut référencer l'ID du slider dans la page de configuration du thème</p>
<p>Le plugin (extension) : <strong>jQuery Mega Menu (Version 1.3.10)</strong> est utilisé comme menu principal de navigation, il doit être placé dans le sidebar (zone de widget) Header</p>
<p>Le plugin (extension) : <strong>WEN's Social Links (Version 2.0.0) </strong> est utilisé pour les réseaux sociaux (en haut à droite) </p>
</div>

<div class="gblock">  
  <h2>Page d'accueil</h2>
  <p>La page d'acceuil est décomposée en 5 zones de widget (sidebar) :
  <ul>
	<li>En haut sur toute la largeur : le menu (sidebar = "Header")</li>
	<li>En dessous à gauche : le slider</li>
	<li>En dessous à droite en sur toute la hauteur jusqu'au footer : la barre de droite (sidebar = "Siderbar")</li>
	<li>En dessous à gauche en sur toute la hauteur jusqu'au footer : 2 sidebars en colonne (sidebar = "Homepage Left" et "Homepage Right")</li>
	<li>En haut sur toute la largeur : le footer(sidebar = "footer")</li>
  </ul>
  
  </p>
</div>

<div class="gblock">

  <h2>License</h2>

  <p> The PHP code of the theme is licensed under the GPL license as is WordPress itself. You can read it here: http://codex.wordpress.org/GPL. </p>
  <p> All other parts of the theme including, but not limited to the CSS code, images, and design are licensed for free personal usage.  </p>
  <p> You are requested to retain the credit banners on the template. </p>
  <p> You are allowed to use the theme on multiple installations, and to edit the template for your personal use. </p>
  <p> You are NOT allowed to edit the theme or change its form with the intention to resell or redistribute it. </p>  
  <p> You are NOT allowed to use the theme as a part of a template repository for any paid CMS service. </p>  
  
</div>

</div>

</div>

<?php }; ?>