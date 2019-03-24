<?php

$themename = "bcaytheme";
$shortname = "bcay";
$zm_categories_obj = get_categories('hide_empty=0');
$zm_categories = array();
foreach ($zm_categories_obj as $zm_cat) {
$zm_categories[$zm_cat->cat_ID] = $zm_cat->category_nicename;
}
$categories_tmp = array_unshift($zm_categories, "Choisissez une categorie:");	

$options = array (

	 array( "name" => "Theme style ",
            "type" => "title",
			"desc" => " Choose your the skin color .",
       		),
	
	array(  "type" => "open"),
		
	array(  "name" => "Choose your theme skin color",
			"desc" => "Select between a skin color for your theme .",
			"id" => $shortname."_skin",
            "type" => "select",		
			"options" => array('default','brown','red','blue','green', 'vav'),		
   		    "std" => "default"),		
				
			
	array(  "type" => "close"),	

	
	array(  "name" => "Featured post setting",
            "type" => "title",
			"desc" => "This section customizes featured slider on the homepage.",
       		),
	   
	array(    "type" => "open"),		
			
	array( 	"name" => "ID Meta Slider",
			"desc" => "ID du Meta Slider utilisé en Home page",
			"id" => $shortname."_metaslider_id",
			"std" => "",
            "type" => "text"), 		
			
	array("type" => "open"),	
	
	array( 	"name" => "URL du logo",
			"desc" => "URL du logo",
			"id" => $shortname."_url_logo",
			"std" => "",
            "type" => "text"), 	
	array(    "type" => "open"),
	
	array( 	"name" => "Image par défaut",
			"desc" => "Image à la une placée par défaut (articles & pages)",
			"id" => $shortname."_img_une_defaut",
			"std" => "",
            "type" => "text"), 	
			
	array(    "type" => "open"),
	
	array( 	"name" => "Code (statistiques de site) de fin de page",
			"desc" => "Code de fin de page",
			"id" => $shortname."_Code_Fin_Page",
			"std" => "",
            "type" => "textarea"), 	
			
	array("type" => "close"),	
	
);
/* Utilisation
	<?php $skin = get_option('bcay_img_une_defaut'); ?>
*/
 
function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=theme_options.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); 
                update_option( $value['id'], $value['std'] );}

            header("Location: themes.php?page=theme_options.php&reset=true");
            die;

        }
    }

      add_theme_page($themename." Options", "$themename Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}



function mytheme_admin() {

    global $themename, $shortname, $options;


    
    
?>
<div class="wrap">
<div class="opwrap" style="background:#fff; margin:20px auto; width:80%; padding:30px; border:1px solid #ddd;" >

<h2 class="wraphead" style="margin:10px 0px; padding:15px 10px; font-family:arial black; font-style:normal; background:#B3D5EF;"><b><?php echo $themename; ?> theme options</b></h2>

<?php
   if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
   if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>
<form method="post">

<?php foreach ($options as $value) {


switch ( $value['type'] ) {

case "image":
?>


<tr>
<td width="30%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="70%"><img src="<?php echo $value['id']; ?>" /></td>
</tr>
<tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>

<?php break;

case "open":
?>
<table width="100%" border="0" style="background-color:#eef5fb; padding:10px;">

<?php break;

case "close":
?>

</table><br />
<?php break;

case "break":
?>
<tr><td colspan="2" style="border-top:1px solid #C2DCEF;">&nbsp;</td></tr>

<?php break;

case "title":
?>

<table width="100%" border="0" style="background-color:#dceefc; padding:5px 10px;">

<tr>
    <td colspan="2"><h3 style="font-size:18px;font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
</tr>

<?php break;

case 'text':
?>

<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'textarea':
?>

<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes (get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea></td>

</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'select':
?>
<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr>
<tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case "checkbox":
?>
    <tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
        <td width="80%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                </td>
    </tr>

    <tr>
        <td><small><?php echo $value['desc']; ?></small></td>
   </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php         break;

}
}
?>

<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

</div>
<?php
}
add_action('admin_menu', 'mytheme_add_admin'); ?>