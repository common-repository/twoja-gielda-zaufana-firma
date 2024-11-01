<?php
/*
	Plugin Name: Twoja Giełda Zaufana Firma
	Plugin URI: https://www.twojagielda.com
	Description: Integracja opinii z serwisu Twoja Giełda na Twojej stronie internetowej.
	Version: 1.0
	Author: Twoja Giełda
	Author URI: https://www.twojagielda.com/
	Domain Path: /lang/ 
	Requires at least: 4.5
    Tested up to: 5.2.3

	Copyright 2019 Twoja Giełda.

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
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

add_action('admin_menu', 'gielda_plugin_setup_menu');
 
function gielda_plugin_setup_menu(){
	add_menu_page( 'Zaufana Firma', 'Zaufana Firma', 'manage_options', 'gielda-plugin', 'gielda_init', 'dashicons-chart-pie' );
}
 
function gielda_init(){
	
	if(isset($_POST['codegielda'])){
		$codeGielda = esc_sql($_POST['codegielda']);
		
		update_option( 'gielda_trusted_reviews', $codeGielda );
	}
	  
	echo "<h1>Zaufana Firma - Ustawienia</h1>";

?>
	<style>
        #trusted-twojagielda{width:80%}#trusted-twojagielda input{width:100%;max-width:500px;min-width:240px;border:1px #ccc solid;padding:5px}#trusted-twojagielda label{margin:10px 0;display:block;width:100%}input#sub{margin-top:30px;width:100px;min-width:inherit;border:0;color:#fff;background:#009aec;border-radius:20px;font-size:16px}
    </style>

    <p>Uniwersalny kod klienta możesz zanleźć w panelu Twojego konta w serwisie Twoja Giełda w zakładce <a href="https://twojagielda.com/integracja-zaufana-firma/" target="_blank">Integracja Zaufana Firma</a></p>
      
	<form id="trusted-twojagielda" action="<?php $_SERVER['REQUEST_URI']; ?>" method="post"> 
		<label>Wprowadź kod: <input name="codegielda" type="text" value="<?php 
		
		if(!empty(get_option('gielda_trusted_reviews'))){ echo get_option('gielda_trusted_reviews'); } ?>" placeholder="uniwersalny kod" /></label>
		<input id="sub" type="submit" value="Zapisz"/>
	</form>
    
<?php
}

add_action('wp_head', 'change_this_name');
function change_this_name(){
	if(!empty(get_option('gielda_trusted_reviews'))){ 
	?>
	<style>
	iframe#gielda-trust:hover { left: 0px !important;}
	</style>
	<iframe id="gielda-trust" style=" border: none;position: fixed;top: 30%;left: -322px;z-index:111111;height: 400px;width: 365px; transition:1s" src="https://twojagielda.com/wp-content/trusted_pligin.php?code=<?php echo get_option('gielda_trusted_reviews'); ?>"></iframe>
	<?php
	}
};

?>