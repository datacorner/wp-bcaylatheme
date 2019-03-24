<!-- searchform.php  -->
<div id="search">
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>" >
	<input id="s"  type="text" name="s" onfocus="if(this.value=='Rechercher dans le site'){this.value=''};" onblur="if(this.value==''){this.value='Rechercher dans le site'};" value="<?php echo wp_specialchars($s, 1); ?>" />
	<input id="searchsubmit" type="submit" value="Rechercher" />
	</form>
</div>
<div class='clear'></div>	
