<?php
// Function for `register_new_user` action-hook, $user_id ID of the newly registered user.
// add_action( 'register_new_user', 'press_net_register_new_user_action' );
function press_net_register_new_user_action( $user_id ){
	// action...
}

// Adding an Email check field
add_action( 'show_user_profile', 'press_net_profile_fields' );
add_action( 'edit_user_profile', 'press_net_profile_fields' );
function press_net_profile_fields( $user ) {
    echo '<h3>Additionally</h3>';
    echo '<table class="form-table">';

    $user_identified = ( $user_identified = get_the_author_meta( 'user_identified', $user->ID ) ) ? $user_identified : 'no';
 	echo '<tr><th><label for="user_identified">Email check</label></th>
 		<td><ul>
 			<li><label><input value="no" name="user_identified"' . checked( $user_identified, 'no', false ) . ' type="radio" /> No</label></li>
 			<li><label><input value="yes" name="user_identified"' . checked( $user_identified, 'yes', false ) . ' type="radio" /> Yes</label></li>
 		</ul></td>
 	</tr>';
    // echo '</table>';

    $account_type = ( $account_type = get_the_author_meta( 'account_type', $user->ID ) ) ? $account_type : 'expert';
    foreach( $account_type as $value ){
        if ( $value == 'expert' ) {
            $type_expert = 'expert';
        }
        if ( $value == 'journalist' ) {
            $type_journalist = 'journalist';
        }
    }
 	echo '<tr><th><label for="account_type">Account type</label></th>
 		<td><ul>
 			<li><label><input value="expert" name="account_type[0]"' . checked( $type_expert, 'expert', false ) . ' type="checkbox" /> Expert</label></li>
 			<li><label><input value="journalist" name="account_type[1]"' . checked( $type_journalist, 'journalist', false ) . ' type="checkbox" /> Journalist</label></li>
 		</ul></td>
 	</tr>';

    $parent_user = get_the_author_meta( 'parent_user', $user->ID );
 	echo '<tr><th><label for="parent_user">Parent user</label></th>
 		<td>
 			<input name="parent_user" type="number" value="' . $parent_user . '" />
 		</td>
 	</tr>';

    // $pn_avatar = get_the_author_meta( 'pn-avatar', $user->ID );
    // echo '<tr><th><label>Avatar</label></th>
 	// 	<td><ul>
    //         <img src="' . wp_get_attachment_image_url( $pn_avatar, 'thumbnail' ) . '" alt="" />
 	// 	</ul></td>
 	// </tr>';
    echo '</table>';
}
// Save the Email check field
add_action( 'personal_options_update', 'press_net_save_profile_fields' );
add_action( 'edit_user_profile_update', 'press_net_save_profile_fields' );
function press_net_save_profile_fields( $user_id ) {
    if ( $_POST[ 'user_identified' ] ) {
        update_user_meta( $user_id, 'user_identified', sanitize_text_field( $_POST[ 'user_identified' ] ) );
    }
    if ( $_POST[ 'parent_user' ] ) {
        update_user_meta( $user_id, 'parent_user', $_POST[ 'parent_user' ] );
    }
    // if ( $_POST[ 'account_type' ] ) {
        $val_at = [];
        foreach( $_POST['account_type'] as $value ){
    		$val_at[] = $value;
    	}
        update_user_meta( $user_id, 'account_type', $val_at );
    // }
}

// Adding columns to the user list
add_filter( 'manage_users_columns', 'press_net_user_custom_column' );
function press_net_user_custom_column( $columns ) {
    $columns[ 'account_type' ] = 'Account type';
    $columns[ 'parent_user' ] = 'Parent user';
    $columns[ 'user_identified' ] = 'Email check';
    $columns[ 'registration_date' ] = 'Date of registration';
    return $columns;
}

add_filter( 'manage_users_custom_column', 'press_net_user_custom_column_content', 25, 3 );
function press_net_user_custom_column_content( $row_output, $column_id, $user ) {
    $role_user = get_user_role_name( $user );
    if( 'account_type' == $column_id && $role_user != 'Administrator' ) {
        $account_type = get_the_author_meta( 'account_type', $user );
        if ( is_array($account_type) ) {
            return implode( ', ', $account_type );
        } else {
            return $account_type;
        }
    }
    if( 'parent_user' == $column_id && $role_user != 'Administrator' ) {
        $parent_user = get_the_author_meta( 'parent_user', $user );
        return $parent_user;
    }
    if( 'user_identified' == $column_id ) {
        $user_identified = get_the_author_meta( 'user_identified', $user );
        if ( $user_identified == 'no' ) {
            return '<span style="color:red; font-weight:600; text-transform:uppercase;">' . $user_identified . '</span>';
        } else {
            return $user_identified;
        }

    }
    if( 'registration_date' == $column_id ) {
        $registered_date = get_the_author_meta( 'registered', $user );
        return wp_date( 'H:i:s - j-m-Y', strtotime($registered_date) );
    }
    return $row_output;
}

// Adjust the width of the columns through css
add_action('admin_head', 'press_net_add_column_css');
function press_net_add_column_css(){
    echo '<style type="text/css">.column-account_type{width:6%;} .column-parent_user{width:6%;} .column-user_identified{width:6%;} .column-registration_date{width:11%;}</style>';
}
// Adding columns to the user list end

// Two-factor email authentication
add_action( 'wp_authenticate', 'press_net_authenticate_action', 10, 2 );
function press_net_authenticate_action( $user_login, $user_password ){
    $referrer = $_SERVER['HTTP_REFERER'];
    $user_id_name = username_exists( $user_login );
    $user_id_email = email_exists( $user_login );
    if ( $user_id_name ) {
        $user_identified = get_user_meta( $user_id_name, 'user_identified', true );
        if (!$user_identified || $user_identified == 'no') {
            wp_redirect( add_query_arg('user_identified', 'failed', $referrer ) );
            exit;
        } else {
            return;
        }
    } elseif ( $user_id_email ) {
        $user_identified = get_user_meta( $user_id_email, 'user_identified', true );
        if (!$user_identified || $user_identified == 'no') {
            wp_redirect( add_query_arg('user_identified', 'failed', $referrer ) );
            exit;
        } else {
            return;
        }
    }
}

// We leave the user on the same page when entering an incorrect login / password in the authorization form wp_login_form()
add_action( 'wp_login_failed', 'press_net_front_end_login_fail' );
function press_net_front_end_login_fail( $username ) {
    $referrer = $_SERVER['HTTP_REFERER'];
    // If there is a referrer and it is not a wp-login.php page
    if( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')  && !wp_doing_ajax() ) {
        wp_redirect( add_query_arg('login', 'failed', $referrer ) );  // редиркетим и добавим параметр запроса ?login=failed
        exit;
    }
}

// Checking E-mail when recovering a password
add_action('wp_ajax_emailverifi', 'press_net_email_verifi');
add_action('wp_ajax_nopriv_emailverifi', 'press_net_email_verifi');
function press_net_email_verifi() {
    // Получение отправленных данных
    $error = array();
    $user_email = esc_sql( $_POST['email_forgot'] );
    $nonce = esc_sql( $_POST['nonce'] );
    if ( !wp_verify_nonce( $nonce, 'exchange_forgot_password' ) ) {
        $error['empty_nonce'] = 'The request failed';
    }
    $user = get_user_by( 'email', $user_email );
    if ( !$user ) {
        $error['no_user'] = 'The user with the specified data is not registered';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    } else {
        $key = get_password_reset_key( $user );
        $url = get_site_url( null, 'recovery-password/?key=' . $key . '&email=' . $user_email . '&login=' . $user->data->user_login );
        $subject = 'Password reset request: ';
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: admin@dinskinform.ru <admin@dinskinform.ru>\r\n";
        $message = '<p>Someone has requested a password reset for the following account:</p>';
        $message .= '<p>Name of the site: ' . get_bloginfo( 'name' ) . '</p>';
        $message .= '<p>Login: ' . $user->data->user_login . '</p>';
        $message .= '<p>If an error occurs, just ignore this email and nothing will happen.</p>';
        $message .= '<p>To reset your password, go to the following link: <a href="' . $url . '" target="blank">Restore password</a></p>';
        $message .= "<p>This letter was generated automatically. You don't need to answer it.</p>";
        $message .= '<p>Thank you.</p>';
        wp_mail( $user_email, $subject, $message, $headers );
        $error['error_send_mail'] = 'An email with instructions has been sent to your email address.';
        $error['class'] = 'error_plus';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    }
    die();
}

// Change Password
add_action('wp_ajax_new_user_pass', 'press_net_recovery_pass');
add_action('wp_ajax_nopriv_new_user_pass', 'press_net_recovery_pass');
function press_net_recovery_pass () {
    $error = array();
    $key = $_POST['key'];
    $login = $_POST['login'];
    if ( isset( $key ) && isset( $login ) ) {
        $user = check_password_reset_key( $key, $login );
    }
    if ( !$user ) {
        $error['empty_user'] = 'Identification error';
    }
    $user_pass = $_POST['pass'];
    $nonce = $_POST['nonce'];
    if ( !wp_verify_nonce( $nonce, 'new_user_pass_nonce' ) ) {
        $error['empty_nonce'] = 'Error, please try again later';
    }
    if ( !$user_pass ) {
        $error['user_pass_no'] = 'No new password specified';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        reset_password( $user, $user_pass );
        $error['class'] = 'success';
        $error['notise'] = 'Password changed successfully';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
}

// Регистраниция пользователей
add_action('wp_ajax_press_net_register', 'press_net_register_func');
add_action('wp_ajax_nopriv_press_net_register', 'press_net_register_func');

// function press_net_register_func_test() {
//     adding_post_when_registering_user_test( $_POST );
// }

function press_net_register_func() {
    require_once ABSPATH . WPINC . '/user.php';
    $error = array();

    $account_type = [];
    $account_type[] = $_POST['account_type'];
    // foreach( $_POST['account_type'] as $value ){
    //     $account_type[] = $value;
    // }

    // $account_type = $_POST['type-account'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email_register'];
    $password = $_POST['password_register'];
    $nonce = $_POST['exchange_register'];
    $referer = $_POST['_wp_http_referer'];

    if ( !wp_verify_nonce( $nonce, 'exchange_register' ) ) {
        $error['empty_nonce'] = 'There were problems, please try again later.';
    }
    if ( !$_POST['first_name'] ) {
        $error['first_name'] = 'No First Name.';
    }
    if ( !$_POST['last_name'] ) {
        $error['last_name'] = 'No Last Name.';
    }
    if ( email_exists( $_POST['email_register'] ) ) {
        $error['yes_email'] = 'The user with the specified email is already registered';
    }
    if ( !is_email( $_POST['email_register'] ) ) {
        $error['email_error'] = 'E-mail address is not correct.';
    }
    if ( !$_POST['password_register'] ) {
        $error['password_error'] = 'Password not specified.';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        // $login = preg_replace("/^(.+?)@.+$/", '\\1', $email);
        $login = mb_strtolower($_POST['first_name'] . '-' . $_POST['last_name']);
        if ( username_exists( $login ) ) {
            $login = generate_new_userlogin($login);
        }
        $userdata = array(
            'user_login' => $login,
            'user_pass' => $_POST['password_register'],
            'user_email' => $email,
            'nickname' => $login,
        );
        $user_id = wp_insert_user( $userdata ) ;
        if( !is_wp_error( $user_id ) ) {
            $new_userdata = array(
                'ID' => $user_id,
                'first_name'   => $_POST['first_name'],
	            'last_name'    => $_POST['last_name'],
                'display_name' => $_POST['first_name'] . ' ' . $_POST['last_name'], // '&nbsp'
            );
            wp_update_user( $new_userdata );
            update_user_meta( $user_id, 'account_type', $account_type );
            update_user_meta( $user_id, 'user_identified', 'no' );
            update_user_meta( $user_id, 'parent_user', 0 );
            if ( $_POST['company_id'] ) {
                $user_company = [];
                $user_company[] = $_POST['company_id'];
                update_user_meta( $user_id, 'user_company', $user_company );
            }
            if ( $_POST['media_id'] ) {
                $user_media = [];
                $user_media[] = $_POST['media_id'];
                update_user_meta( $user_id, 'user_media', $user_media );
            }
            if ( $_POST['new_company'] == 'on' || $_POST['new_media'] == 'on' ) {
                adding_post_when_registering_user( $user_id, $_POST );
            }

            $user = get_user_by( 'email', $email );
            $key = get_password_reset_key( $user );
            $url = get_site_url( null, 'email-verification/?key=' . $key . '&email=' . $email . '&login=' . $user->data->user_login );
            $site_name = get_bloginfo('name');
            $admin_email = get_bloginfo('admin_email');
            $mailTo = $email;
            $subject = 'Registration on the site ' . $site_name;
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: admin@dinskinform.ru <admin@dinskinform.ru>\r\n";
            $email = 'E-mail: ' . $email . ' ';
            $login_user = 'Login: ' . $login . ' ';
            $pass = 'Password: ' . $password . ' ';
            $message = '<p>You have successfully registered on the site ' . $site_name . '.</p>';
            $message .= '<p>To confirm your email, please follow the link below: <a href="' . $url . '" target="blank">Confirm E-mail</a></p>';
            $message .= '<p>Your authorization data:</p>';
            $msgotprav = $message ."<br>" . $email . "<br>" . $login_user . "<br>" . $pass . "<br>";
            wp_mail($mailTo, $subject, $msgotprav, $headers);

            $user = get_user_by('ID', $user_id); // %0A
            //$message = 'Новый пользователь - id: ' . $user_id . chr(10) . ' E-mail: ' . $user->user_email . chr(10) . ' Имя пользователя: ' . $user->user_login . chr(10) . ' Время регистрации: ' . $user->user_registered;
            $message = 'New user' . chr(10);
            $message .= 'id: ' . $user_id . chr(10);
            $message .= 'E-mail: ' . $email . chr(10);
            $message .= 'Login: ' . $login . chr(10);
            $message .= 'Registration time: ' . wp_date( 'H:i:s - j-m-Y', strtotime($user->user_registered) );
            // message_to_telegram( $message );
        } else {
            $error['error_no_user'] = 'No user';
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
            wp_die();
        }
        $error['success_send_mail'] = 'An email with instructions has been sent to the email address provided.';
        $error['class'] = 'success';
        $error['login'] = $login;
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
}

// Generate login for new WP user
function generate_new_userlogin($login){
    $users_ids = get_users('fields=ID&number=3&orderby=registered&order=DESC');
    $last_id = max($users_ids);
    $new_id = $last_id+1;
    $user_login = $login . $new_id;
    return $user_login;
}
//Use
// $user = register_new_user( $user_login = generate_new_userlogin(), $user_email = 'name@site.example' );

// Role user
function get_user_role_name( $user_id ){
	if ( ! $user = get_userdata( $user_id ) ) {
		return '';
	}
	$name = wp_roles()->roles[ $user->roles[0] ]['name'];
	$name = translate_user_role( $name );
	return $name;
}

// Регистраниция спикеров и журналистов
add_action('wp_ajax_press_net_register_employee', 'press_net_register_employee');
add_action('wp_ajax_nopriv_press_net_register_employee', 'press_net_register_employee');

function press_net_register_employee_test() {
    $inputs_required = explode(",", $_POST['inputs_required']);
    $error = array();
    foreach ($inputs_required as $value) {
        if ( empty($_POST[$value]) ) {
             $error[$value] = 'No ' . $value;
        }
    }
    if ( count( $error ) > 0 ) {
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    } else {
        echo 'Ok';
    }
    wp_die();
}

function press_net_register_employee() {
    require_once ABSPATH . WPINC . '/user.php';
    $error = array();

    $inputs_required = explode(",", $_POST['inputs_required']);
    foreach ($inputs_required as $value) {
        if ( empty($_POST[$value]) ) {
             $error[$value] = 'No ' . $value;
        }
    }

    if ( !wp_verify_nonce( $_POST['press_net_add_post'], 'press_net_add_post' ) ) {
        $error['empty_nonce'] = 'There were problems, please try again later.';
    }
    if ( email_exists( $_POST['email'] ) ) {
        $error['yes_email'] = 'The user with the specified email is already registered';
    }
    if ( !is_email( $_POST['email'] ) ) {
        $error['email_error'] = 'E-mail address is not correct.';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $password = wp_generate_password();
        $login = mb_strtolower($_POST['first-name'] . '-' . $_POST['last-name']);
        if ( username_exists( $login ) ) {
            $login = generate_new_userlogin($login);
        }
        $userdata = array(
            'user_login' => $login,
            'user_pass' => $password,
            'user_email' => $_POST['email'],
            'nickname' => $login,
        );
        $user_id = wp_insert_user( $userdata ) ;
        if( !is_wp_error( $user_id ) ) {
            $new_userdata = array(
                'ID' => $user_id,
                'first_name'   => $_POST['first-name'],
	            'last_name'    => $_POST['last-name'],
                'display_name' => $_POST['first-name'] . ' ' . $_POST['last-name'], // '&nbsp'
                'description'  => $_POST['description'],
            );
            wp_update_user( $new_userdata );
            $account_type = [];
            $account_type[] = $_POST['account_type'];
            // foreach( $_POST['account_type'] as $value ){
        	// 	$val_at[] = $value;
        	// }
            update_user_meta( $user_id, 'account_type', $account_type );
            update_user_meta( $user_id, 'parent_user', $_POST['author_archive_id'] );
            update_user_meta( $user_id, 'user_identified', 'no' );
            $user_themes = explode(",", $_POST['user_themes_edit']);
            update_user_meta( $user_id, 'user_themes', $user_themes );

            $attachment_id = media_handle_upload( 'employee_image_upload', 0 );
        	if ( !is_wp_error( $attachment_id ) ) {
                $my_post = [
                	'ID' => $attachment_id,
                	'post_excerpt' => 'pn-upload:user-avatar'
                ];
                wp_update_post( wp_slash( $my_post ) );
                $pn_avatar_old = get_the_author_meta( 'pn-avatar', $user_id );
                if ( $pn_avatar_old ) {
                    wp_delete_attachment( $pn_avatar_old, true );
                }
                update_user_meta( $user_id, 'pn-avatar', $attachment_id );
        	}

            if ( empty($_POST['company_id']) ) {
                $user_company = [];
                $user_company[] = $_POST['company_id'];
                update_user_meta( $user_id, 'user_company', $user_company );
            }
            if ( empty($_POST['media_id']) ) {
                $user_media = [];
                $user_media[] = $_POST['media_id'];
                update_user_meta( $user_id, 'user_media', $user_media );
            }
            if ( $_POST['new_company'] == 'on' || $_POST['new_media'] == 'on' ) {
                adding_post_when_registering_user( $user_id, $_POST );
            }

            // if ( $_POST['post_type'] ) {
            //     $post_data = array(
            //         'post_author'   => $user_id,
            //         'post_status'   => 'publish',
            //         'post_type'     => $_POST['post_type'],
            //         'post_title'    => $_POST['post_title'],
            //         'post_content'  => '',
            //     );
            //     $post_id = wp_insert_post( $post_data );
            //     if ($post_id) {
            //         update_post_meta( $post_id, 'job_title', $_POST['job_title'] );
            //         update_post_meta( $post_id, 'website', $_POST['website'] );
            //         update_post_meta( $post_id, 'city', $_POST['city'] );
            //
            //         if ( $_POST['subject'] ) {
            //             wp_set_object_terms( $post_id, $_POST['subject'], MEDIA_CAT );
            //         }
            //     }
            // }

            $user = get_user_by( 'email', $_POST['email'] );
            $key = get_password_reset_key( $user );
            $url = get_site_url( null, 'email-verification/?key=' . $key . '&email=' . $_POST['email'] . '&login=' . $user->data->user_login );
            $site_name = get_bloginfo('name');
            $admin_email = get_bloginfo('admin_email');
            $mailTo = $_POST['email'];
            $subject = 'Registration on the site ' . $site_name;
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: admin@dinskinform.ru <admin@dinskinform.ru>\r\n";
            $email = 'E-mail: ' . $_POST['email'] . ' ';
            $login_user = 'Login: ' . $login . ' ';
            $pass = 'Password: ' . $password . ' ';
            $message = '<p>You have successfully registered on the site ' . $site_name . '.</p>';
            $message .= '<p>To confirm your email, please follow the link below: <a href="' . $url . '" target="blank">Confirm E-mail</a></p>';
            $message .= '<p>Your authorization data:</p>';
            $msgotprav = $message ."<br>" . $email . "<br>" . $login_user . "<br>" . $pass . "<br>";
            // wp_mail($mailTo, $subject, $msgotprav, $headers);

            $user = get_user_by('ID', $user_id); // %0A
            //$message = 'Новый пользователь - id: ' . $user_id . chr(10) . ' E-mail: ' . $user->user_email . chr(10) . ' Имя пользователя: ' . $user->user_login . chr(10) . ' Время регистрации: ' . $user->user_registered;
            $message = 'New user' . chr(10);
            $message .= 'id: ' . $user_id . chr(10);
            $message .= 'E-mail: ' . $email . chr(10);
            $message .= 'Login: ' . $login . chr(10);
            $message .= 'Registration time: ' . wp_date( 'H:i:s - j-m-Y', strtotime($user->user_registered) );
            // message_to_telegram( $message );
        } else {
            $error['error_no_user'] = 'No user';
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
            wp_die();
        }
        $error['success_send_mail'] = 'An email with instructions has been sent to the email address provided.';
        $error['class'] = 'success';
        $error['form_data'] = $_POST;
        $error['form_files'] = $_FILES;
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
}

function adding_post_when_registering_user_test( $post_data ) {
    $error['success'] = 'Success';
    $error['post_title'] = $post_data['post_title'];
    $error['POST'] = $post_data;
    $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
    echo $error_fin;
}

function adding_post_when_registering_user( $post_author, $post_data ) {
    $error = array();
    $post_content = '';

    if ( $post_data['account_type'] == 'expert' ) {
        $post_type = 'company';
        $post_title = $post_data['company_title'];
    } elseif ( $post_data['account_type'] == 'journalist' ) {
        $post_type = 'mass-media';
        $post_title = $post_data['media_title'];
    }

    if ( !$post_title ) {
        $error['empty_post_title'] = 'No Post title';
    }

    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error['POST'] = $post_data;
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $post_status = 'publish';
        $post_arr = array(
            'post_author'   => $post_author,
            'post_status'   => $post_status,
            'post_type'     => $post_type,
            'post_title'    => $post_title,
            'post_content'  => $post_content,
        );
        $post_id = wp_insert_post( $post_arr );
        if ($post_id) {
            // Post type company
            if ( $post_type == 'company' ) {
                update_post_meta( $post_id, 'job_title', $post_data['company_job_title'] );
                if ( empty($post_data['company_website']) ) {
                    update_post_meta( $post_id, 'website', $post_data['company_website'] );
                }
                if ( empty($post_data['city']) ) {
                    update_post_meta( $post_id, 'city', $post_data['company_city'] );
                }
            } elseif ( $post_type == 'mass-media' ) {
                update_post_meta( $post_id, 'job_title', $post_data['media_job_title'] );
                update_post_meta( $post_id, 'website', $post_data['media_website'] );
                update_post_meta( $post_id, 'city', $post_data['media_city'] );
                if ( empty($post_data['format']) ) {
                    update_post_meta( $post_id, 'format', $post_data['format'] );
                }
                if ( empty($post_data['subject']) ) {
                    wp_set_object_terms( $post_id, $post_data['subject'], MEDIA_CAT );
                }
            }
            $error['success'] = 'Success';
            // $error['POST'] = $post_data;
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
        }
        wp_die();
    }
}
