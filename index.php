<?php
/*
Plugin Name: De S&S plugin
Plugin URI: http://www.sensmarketing.nl/
Description: Login portaal en instellingen!
Version: 1.4
Author: Wilbert
Author URI: http://www.sensmarketing.nl
License: GPLv2
*/

/*Logo alt text*/
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'S&S Online Marketing';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function login_styles() { 
     wp_enqueue_style( 'login-styles', plugins_url( 'media/style.css' , __FILE__ ), false ); 
}
add_action( 'login_enqueue_scripts', 'login_styles' );

add_action( 'login_enqueue_scripts', 'wpse_login_enqueue_scripts', 10 );
function wpse_login_enqueue_scripts() {
    wp_enqueue_script( 'custom.js', plugins_url( 'sens-login/media/label-to-placeholder.js') , array( 'jquery' ), 1.4 );
}
function remove_lostpassword_text ( $text ) {
         if ($text == 'Wachtwoord vergeten?' or $text == 'Lost your password?'){$text = '<div class="lostpw">?</div>';}
                return $text;
         }
add_filter( 'gettext', 'remove_lostpassword_text' );

function login_checked_remember_me() {
	add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );

function rememberme_checked() {
	echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

/** Scherm instellingen > Paginering Aantal items per pagina **/
function my_edit_per_page( $result, $option, $user ) {
    if ( (int)$result < 1 )
        return 60; // or whatever you want
}
add_filter( 'get_user_option_edit_page_per_page', 'my_edit_per_page', 10, 3 );  // for pages
add_filter( 'get_user_option_edit_post_per_page', 'my_edit_per_page', 10, 3 );  // for posts

?>