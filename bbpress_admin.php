<?php
/*
Plugin Name: New bbPress Admin
Plugin URI: http://rohan-kapoor.com/projects/plugins/bbpress-admin/
Description: Provides bbPress admin access from WordPress! This is a very basic plugin that uses an iframe to provide access to the bbPress Admin pages from WordPress! Compatible with WPMU 2.8.x and bbPress 1.x! No longer requires direct file editing! Updated with no bugs!
Version: 3.1
Author: Rohan Kapoor
Author URI: http://rohan-kapoor.com
*/
?>
<?php
/*  Copyright 2009  Rohan Kapoor  (email : rohan@rohan-kapoor.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
add_action('admin_menu', 'silpstream_bbpress_admin_add_option_page');
function silpstream_bbpress_admin_add_option_page() {
	if ( function_exists('add_management_page') ) {
		 add_management_page('bbPress-Admin', 'bbPress Admin', 8, __FILE__, 'silpstream_bbpress_admin_option_page');
	}
}

function silpstream_bbpress_admin_option_page() {
?>
<?php
// variables for the field and option names 
    $opt_name = 'bbpress_location';
    $bbpress_uri_changed = 'mt_submit_hidden';
    $bbpress_uri = 'bbpress_location';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $bbpress_uri_changed ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $bbpress_uri ];

        // Save the posted value in the database
        update_option( $bbpress_uri, $opt_val );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'new_bbpress_admin' ); ?></strong></p></div>
<?php
    }
    // Now display the options editing screen
    echo '<div class="wrap">';
    // header
    echo "<h2>" . __( 'bbPress Admin Options', 'new_bbpress_admin' ) . "</h2>";
    // options form
?>
<p>Help and Support for this plugin is available at <a href="http://rohan-kapoor.com/projects/plugins/">WordPress Plugins by Rohan Kapoor!</a></p>
<p>You can also request help at my <a href="http://wpmu.zyrot.com/forums/">Forums!</a>
<p>If you found this plugin helpful please consider a <a href="http://rohan-kapoor.com/donate/">donation</a>. Thanks in advance!</p>
<p>Please Enter the Full Path to the bbPress Admin Section (/bb-admin/) in the box below and then click the update options button, which will connect you to the bbPress Admin Panel. If you have cookie integration working correctly, then you should already be logged in and ready to go.</p>
<p><br></p>



<form name="bbpress_admin" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $bbpress_uri_changed; ?>" value="Y">

<p><?php _e("Full Path to bbPress Admin Page:", 'new_bbpress_admin' ); ?> 
<input type="text" name="<?php echo $bbpress_uri; ?>" value="<?php echo $opt_val; ?>" size="40">
<class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'new_bbpress_admin' ) ?>" />
</p>

</form>
</div>
<hr />
<br>
<iframe width="100%" height="1250" src="<?php echo $opt_val; ?>"></iframe>
<?php
}
?>
