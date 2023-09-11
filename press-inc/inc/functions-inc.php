<?php
// Add a folder where else to look for a permanent page template
add_filter( 'page_template_hierarchy', function( $templates ){
	// add folder search 'page-templates' File named 'page-(page_name).php'
	array_unshift( $templates, 'page-templates/'. $templates[0] ); // 'tpl/page-(page_name).php'
	//array_unshift( $templates, 'tpl/'. $templates[1] ); // 'tpl/page-(page_id).php'
	return $templates;
});

// Create Page
add_action( 'after_switch_theme', 'create_page_on_theme_activation_auth' );
function create_page_on_theme_activation_auth(){
    $new_page_title     = 'Log in';
    $new_page_content   = '';
    $new_page_template  = 'page-templates/page-auth.php';
    $page_check = get_page_by_title($new_page_title);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'login'
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

add_action( 'after_switch_theme', 'create_page_on_theme_activation_email_verifi' );
function create_page_on_theme_activation_email_verifi(){
    $new_page_title     = 'E-mail verification';
    $new_page_content   = '';
    $new_page_template  = 'page-templates/page-email-verification.php';
    $page_check = get_page_by_title($new_page_title);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'email-verification'
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

add_action( 'after_switch_theme', 'create_page_on_theme_activation_reg' );
function create_page_on_theme_activation_reg(){
    $new_page_title     = 'Sign up';
    $new_page_content   = '';
    $new_page_template  = 'page-templates/page-reg.php';
    $page_check = get_page_by_title($new_page_title);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'signup'
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

add_action( 'after_switch_theme', 'create_page_on_theme_activation_recovery' );
function create_page_on_theme_activation_recovery(){
    $new_page_title     = 'Lost password';
    $new_page_content   = '';
    $new_page_template  = 'page-templates/page-forgot.php';
    $page_check = get_page_by_title($new_page_title);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'forgot'
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

add_action( 'after_switch_theme', 'create_page_on_theme_activation_forgot' );
function create_page_on_theme_activation_forgot(){
    $new_page_title     = 'Password recovery';
    $new_page_content   = '';
    $new_page_template  = 'page-templates/page-recovery.php';
    $page_check = get_page_by_title($new_page_title);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'recovery-password'
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

add_action( 'after_switch_theme', 'create_page_on_theme_activation_edit_post' );
function create_page_on_theme_activation_edit_post(){
    $new_page_title     = 'Edit post';
    $new_page_content   = '';
    $new_page_template  = 'page-templates/edit-post.php';
    $page_check = get_page_by_title($new_page_title);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'edit-post'
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

add_action( 'after_switch_theme', 'create_page_on_theme_activation_users' );
function create_page_on_theme_activation_users(){
    $new_page_title     = 'Users';
    $new_page_content   = '';
    $new_page_template  = 'page-templates/users.php';
    $page_check = get_page_by_title($new_page_title);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'users'
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

## page tags
add_filter( 'display_post_states', 'press_net_special_page_mark', 10, 2 );
function press_net_special_page_mark( $post_states, $post ){
	if( $post->post_type === 'page' ){
		if( $post->post_name === 'login' ){
			$post_states[] = 'Login page';
		}
		if( $post->post_name === 'email-verification' ){
			$post_states[] = 'Email verification page';
		}
		if( $post->post_name === 'signup' ){
			$post_states[] = 'Signup page';
		}
		if( $post->post_name === 'forgot' ){
			$post_states[] = 'Forgot password page';
		}
		if( $post->post_name === 'recovery-password' ){
			$post_states[] = 'Recovery password page';
		}
		if( $post->post_name === 'edit-post' ){
			$post_states[] = 'Edit post page';
		}
		if( $post->post_name === 'users' ){
			$post_states[] = 'Users page';
		}
	}

	return $post_states;
}

/**
 * Declension of nouns after numerals.
 *
 * @param string $value Meaning
 * @param array $words An array of options, for example: array('day','days','days'), num_word($days,array('day','days','days'))
 * @param bool $show Includes value $value in the resulting string
 * @return string
 */
function num_word($value, $words, $show = true) {
	$num = $value % 100;
	if ($num > 19) {
		$num = $num % 10;
	}
	$out = ($show) ?  $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2:
		case 3:
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	return $out;
}

add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );
