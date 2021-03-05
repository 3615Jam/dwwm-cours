<?php

/*
Plugin Name: JM Plugin
Plugin URI: 
Description: Ceci est un test de création de plugin perso. 
Author: JM
Version: 1.0
Author URI: 
*/

function nytime()
{
	$timezone = 'America/New_York';
	date_default_timezone_set($timezone);
    echo '<p id="nytime">Heure de New York : ' . date('h:i:s A') . '</p>';
}

// Now we set that function up to execute when the admin_notices action is called.
add_action('admin_notices', 'nytime');

// We need some CSS to position the paragraph.
function nytime_css()
{
    echo "
	<style type='text/css'>
	#nytime {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #nytime {
		float: left;
	}
	.block-editor-page #nytime {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#nytime,
		.rtl #nytime {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action('admin_head', 'nytime_css');
