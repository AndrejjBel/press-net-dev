<?php
define( 'COMPANY', 'company' );
define( 'MEDIA', 'mass-media' );
define( 'COMPANY_CAT', 'company-cat' );
define( 'MEDIA_CAT', 'mass-media-cat' );
define( 'REQUESTS', 'requests' );
define( 'REQUESTS_CAT', 'requests-cat' );
require get_template_directory() . '/press-inc/inc/smtp-mailer.php';
require get_template_directory() . '/press-inc/inc/post-types.php';
require get_template_directory() . '/press-inc/inc/functions-inc.php';
require get_template_directory() . '/press-inc/inc/auth-reg.php';
require get_template_directory() . '/press-inc/inc/user-inc.php';
require get_template_directory() . '/press-inc/inc/add-post.php';
require get_template_directory() . '/press-inc/inc/archive-inc.php';
require get_template_directory() . '/press-inc/inc/edit-post-inc.php';
require get_template_directory() . '/press-inc/inc/filtr-inc.php';

remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' ); // remove extra svg code in wordpress

// Adds a main styles and scripts.
add_action( 'wp_enqueue_scripts', 'press_net_main_scripts_old', 99 );
function press_net_main_scripts_old() {
    global $current_user, $authordata;
    if ( $authordata ) {
        $author_id = $authordata->ID;
    } else {
        $author_id = false;
    }
    $bundle_obj = [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('press-network-nonce'),
        'author_id' => $author_id,
        'current_user_id' => $current_user->ID
    ];
    // css
    wp_enqueue_style('main-min', get_stylesheet_directory_uri() . '/dist/main.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/dist/main.min.css' )
    );
    // wp_enqueue_style('magnific-popup', get_stylesheet_directory_uri() . '/src/magnific-popup/magnific-popup.css',	array(),
    //     filemtime( get_stylesheet_directory() . '/src/magnific-popup/magnific-popup.css' )
    // );

    // js
    // wp_enqueue_script('magnific-popup', get_stylesheet_directory_uri() . '/src/magnific-popup/magnific-popup.min.js',	array('jquery'),
    //     filemtime( get_stylesheet_directory() . '/src/magnific-popup/magnific-popup.min.js' )
    // );
    wp_enqueue_script('bundle', get_stylesheet_directory_uri() . '/dist/bundle.min.js',	array('jquery'),
        filemtime( get_stylesheet_directory() . '/dist/bundle.min.js' )
    );
    wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js',	array('jquery'),
        filemtime( get_stylesheet_directory() . '/js/custom.js' )
    );

    // wp_enqueue_script('filtr-req', get_stylesheet_directory_uri() . '/js/filtr-req.js',	array('jquery'),
    //     filemtime( get_stylesheet_directory() . '/js/filtr-req.js' )
    // );

    // wp_add_inline_script( 'bundle', 'const press_net_ajax = ' . wp_json_encode( $bundle_obj ), 'before' );
    // wp_add_inline_script( 'custom', 'const post_list_json = ' . wp_json_encode( press_net_post_list_json() ), 'before' );
}

// Add defer to js
add_filter( 'script_loader_tag', 'press_net_add_async_attribute', 10, 2 );
function press_net_add_async_attribute( $tag, $handle ) {
	$handles = array(
        'magnific-popup',
        'bundle',
        'custom',
        'filtr-req'
	);
	foreach( $handles as $defer_script) {
		if ( $defer_script === $handle ) {
			return str_replace( ' src', ' defer="defer" src', $tag );
		}
	}
	return $tag;
}

// Redirect wp-admin and wp-login
add_action( 'init', 'press_net_noadmin' );
function press_net_noadmin() {
	if ( is_admin() && !current_user_can('administrator') && !wp_doing_ajax() ) {
		wp_redirect(home_url( '/login/' ));
		exit;
	}
}

function press_net_custom_login_page() {
  $new_login_page_url = home_url( '/login/' ); // new login page
  global $pagenow;
  if( $pagenow == 'wp-login.php' && $_SERVER['REQUEST_METHOD'] == 'GET'  && !wp_doing_ajax() ) {
    wp_redirect($new_login_page_url);
    exit;
  }
}
if( !is_user_logged_in() ){
  add_action('init', 'press_net_custom_login_page');
}

add_action( 'init', function(){
	if ( ! current_user_can( 'manage_options' ) ) {
		show_admin_bar( false );
	}
} );

// add_action( 'template_redirect', 'press_net_template_redirect' );
// function press_net_template_redirect(){
//   if( is_page_template( array('auth-page.php', 'forgot-password.php', 'reg-page.php', 'remember-page.php') ) && is_user_logged_in() ){
// 		wp_redirect( home_url( '/' ) );
// 		exit();
// 	}
// }
