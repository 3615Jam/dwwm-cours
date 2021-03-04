<?php

/*
Plugin Name: JM Plugin
Plugin URI: 
Description: Ceci est un test de création de plugin perso. 
Author: JM
Version: 1.0
Author URI: 
*/

function getdelatourette()
{
    // on prépare une sélection de 'paramètres' ;) possibles  
    $gromo = "P*tain,B*rdel,M*rde,Fait ch*er,C*nnard";

    // on sépare la phrase précédente en différents éléments  
    $gromo = explode(",", $gromo);

    // et on en récupère un au hasard 
    return wptexturize($gromo[mt_rand(0, count($gromo) - 1)]);
}

// This just echoes the chosen line, we'll position it later.
function delatourette()
{
    $chosen = getdelatourette();
    echo '<p id="gromo"><span class="">' . $chosen . '</span></p>';
}

// Now we set that function up to execute when the admin_notices action is called.
add_action('admin_notices', 'delatourette');

// We need some CSS to position the paragraph.
function gromo_css()
{
    echo "
	<style type='text/css'>
	#gromo {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #gromo {
		float: left;
	}
	.block-editor-page #gromo {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#gromo,
		.rtl #gromo {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action('admin_head', 'gromo_css');
