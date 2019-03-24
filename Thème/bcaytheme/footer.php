<!-- footer.php  -->
<div class="clear"></div>
</div>	
<?php include (TEMPLATEPATH . '/bottom.php'); ?>	
<div id="footer">
	<div class="fcred">
		Copyright &copy; <?php echo date('Y');?> <a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<br />
	</div>	
<div class='clear'></div>	
<?php wp_footer(); ?>
</div>
<div class='clear'></div>	
</div>

</body>
<?php echo get_option('bcay_Code_Fin_Page'); ?>
</html>      