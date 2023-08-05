<?php
function press_net_is_user_archive() {
    global $current_user;
    $author_id = get_queried_object()->ID;
    if( $author_id == $current_user->ID ){
    	return true;
    }
}

function press_net_current_user_type($user_account_type) {
    global $current_user;
    $account_type = get_the_author_meta( 'account_type', $current_user->ID );
    if ( gettype($account_type) == 'array' || gettype($account_type) == 'object' ) {
        if ( in_array($user_account_type, $account_type) || get_user_role_name( $current_user->ID ) == 'Administrator' ) {
            return true;
        } else {
            return false;
        }
    } else {
        if ( $user_account_type == $account_type || get_user_role_name( $current_user->ID ) == 'Administrator' ) {
            return true;
        } else {
            return false;
        }
    }
}

function press_net_author_type($user_account_type) {
    global $authordata;
    $author_id = $authordata->ID;
    $account_type = get_the_author_meta( 'account_type', $author_id );
    if ( get_user_role_name( $author_id ) == 'Administrator' ) {
        return true;
    } else {
        if ( gettype($account_type) == 'array' || gettype($account_type) == 'object' ) {
            if ( in_array($user_account_type, $account_type) ) {
                return true;
            } else {
                return false;
            }
        } else {
            if ( $user_account_type == $account_type ) {
                return true;
            } else {
                return false;
            }
        }
    }

}

function press_net_user_type() {
    $author_id = get_queried_object()->ID;
    $account_type = get_the_author_meta( 'account_type', $author_id );
    if ( get_user_role_name( $author_id ) == 'Administrator' ) {
        return 'Administrator';
    } else {
        if ( gettype($account_type) == 'array' || gettype($account_type) == 'object' ) {
            return implode( ', ', $account_type );
        } else {
            return $account_type;
        }
    }
}

// User avatar upload
add_action('wp_ajax_press_net_avatar_upload', 'press_net_avatar_upload');
add_action('wp_ajax_nopriv_press_net_avatar_upload', 'press_net_avatar_upload');
function press_net_avatar_upload() {
    if (
    	isset( $_POST['my_image_upload_nonce'] )
    	&& wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
        && $_POST['current_user_id'] == $_POST['author_archive_id']
    ) {
    	$attachment_id = media_handle_upload( 'my_image_upload', 0 );

    	if ( is_wp_error( $attachment_id ) ) {
    		echo "Ошибка загрузки медиафайла.";
    	} else {
            $my_post = [
            	'ID' => $attachment_id,
            	'post_excerpt' => 'pn-upload:user-avatar'
            ];
            wp_update_post( wp_slash( $my_post ) );
            $pn_avatar_old = get_the_author_meta( 'pn-avatar', $_POST['current_user_id'] );
            if ( $pn_avatar_old ) {
                wp_delete_attachment( $pn_avatar_old, true );
            }
            update_user_meta( $_POST['current_user_id'], 'pn-avatar', $attachment_id );
    		echo "Медиафайл был успешно загружен!";
    	}
        wp_die();
    } else {
    	echo "Проверка не пройдена. Невозможно загрузить файл.";
        wp_die();
    }
}

// User avatar delete
add_action('wp_ajax_press_net_avatar_delete', 'press_net_avatar_delete');
add_action('wp_ajax_nopriv_press_net_avatar_delete', 'press_net_avatar_delete');
function press_net_avatar_delete() {
    if ( wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
        && $_POST['current_user_id'] == $_POST['author_archive_id']
    ) {
        $pn_avatar_old = get_the_author_meta( 'pn-avatar', $_POST['author_archive_id'] );
        wp_delete_attachment( $pn_avatar_old, true );
        delete_user_meta($_POST['current_user_id'], 'pn-avatar');
        // if( false === wp_delete_attachment( $pn_avatar_old, true ) ){
        // 	 echo "Не удалось удалить медиа файл";
        // }
        // if ( ! delete_user_meta($_POST['author_archive_id'], 'pn-avatar') ) {
        // 	echo "Оооопс! Ошибочка случилась во время этой операции!";
        // }
        echo "Все ОК!";
    } else {
    	echo "Проверка не пройдена. Невозможно удалить файл.";
    }
    wp_die();
}

// User profile edit
add_action('wp_ajax_user_profile_edits', 'press_net_user_profile_edit');
add_action('wp_ajax_nopriv_user_profile_edits', 'press_net_user_profile_edit');
function press_net_user_profile_edit() {
    $error = array();

    if ( !wp_verify_nonce( $_POST['user_profile_edit'], 'user_profile_edit' ) ) {
        $error['empty_nonce'] = 'The request failed.';
    }
    if ( !$_POST['first-name'] ) {
        $error['first-name'] = 'No First Name';
    }
    if ( !$_POST['last-name'] ) {
        $error['last-name'] = 'No Last Name';
    }
    // if ( $_POST['expert'] || $_POST['journalist'] ) {
    //     // $error['types_success'] = 'Yes types';
    // } else {
    //     $error['types_error'] = 'No Site status';
    // }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $new_userdata = array(
            'ID' => $_POST['author_archive_id'],
            'first_name'   => $_POST['first-name'],
            'last_name'    => $_POST['last-name'],
            'display_name' => $_POST['first-name'] . ' ' . $_POST['last-name'],
            'description' => $_POST['description'],
        );
        wp_update_user( $new_userdata );
        // $val_at = [];
        // if ( $_POST['expert'] ) {
        //     $val_at[] = 'expert';
        // }
        // if ( $_POST['journalist'] ) {
        //     $val_at[] = 'journalist';
        // }
        // update_user_meta( $_POST['author_archive_id'], 'account_type', $val_at );

        if ( $_POST['user_themes_edit'] ) {
            $user_themes = explode(",", $_POST['user_themes_edit']);
            update_user_meta( $_POST['author_archive_id'], 'user_themes', $user_themes );
        }

        $error['class'] = 'success';
        $error['success-end'] = 'Your data has been changed';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    }
    wp_die();
}

// User avatar admin column
add_filter( 'get_avatar_url', 'press_net_get_avatar_url_filter', 10, 3 );
function press_net_get_avatar_url_filter( $url, $id_or_email, $args ){
    $pn_avatar = get_the_author_meta( 'pn-avatar', $id_or_email );
    if ( $pn_avatar ) {
        $url = wp_get_attachment_image_url( $pn_avatar, 'thumbnail' );
    } else {
        $url = get_stylesheet_directory_uri() . '/img/defolt-no-user.svg';
    }
	return $url;
}

function press_net_get_avatar_user_img(){
    $user_id = get_queried_object()->ID;
    $url = get_avatar_url( $user_id, array(
    	'size' => 150
    ) );
    return '<img id="result" src="' . $url . '" alt="">';
}

function press_net_get_is_avatar_user(){
    $user_id = get_queried_object()->ID;
    $avatar = get_the_author_meta( 'pn-avatar', $user_id );
    if ( $avatar ) {
        return true;
    } else {
        return false;
    }
}

function press_net_get_user_link_lk($tab){
    global $current_user;
    $author_url = get_author_posts_url( $current_user->ID );
    $user = get_user_by('id', $current_user->ID);
    if ( $tab ) {
        $param = '?tab=' . $tab;
    } else {
        $param = '';
    }
    $link = $author_url . $param;
    return $link;
}

function press_net_get_param($value){
    if ( $_GET ) {
        $tab = $_GET["tab"];
        if ( $tab ) {
            if ( $tab == $value ) {
                echo 'active';
            }
        } elseif ( $value == 'profile' ) {
            echo 'active';
        }
    } else {
        if ( $value == 'profile' ) {
            echo 'active';
        }
    }
}

function press_net_get_authordata($meta){
    $user_id = get_queried_object()->ID;
    $user_data = get_userdata($user_id);
    return $user_data->$meta;
}

function press_net_get_userdata($meta){
    global $current_user;
    $user_id = $current_user->ID;
    $user_data = get_userdata($user_id);
    return $user_data->$meta;
}

function press_net_get_user_account_type($meta, $input_svg){
    $user_id = get_queried_object()->ID;
    $user_data = get_userdata($user_id);
    $account_type = $user_data->account_type;
    if ( count($account_type) == 0 ) {
        return;
    } else {
        if (in_array($meta, $account_type)) {
            if ( $input_svg == 'input' ) {
                return $meta;
            } elseif ( $input_svg == 'svg' ) {
                return 'active';
            }
        }
    }
}

// Rewrite author base url
add_action( 'init', 'new_author_base' );
function new_author_base() {
	global $wp_rewrite;
	$wp_rewrite->author_base = 'user';
}
add_filter( 'author_link', 'filter_author_link', 10, 3 );
function filter_author_link( $link, $author_id, $author_nicename ) {
	return home_url( '/user/' ) . $author_nicename;
}

// User portfolio add
add_action('wp_ajax_press_net_add_portfolio', 'press_net_user_portfolio_add');
add_action('wp_ajax_nopriv_press_net_add_portfolio', 'press_net_user_portfolio_add');
function press_net_user_portfolio_add() {
    $error = array();
    if ( !wp_verify_nonce( $_POST['press_net_add_post'], 'press_net_add_post' ) ) {
        $error['empty_nonce'] = 'The request failed.';
    }
    if ( $_POST['current_user_id'] != $_POST['author_archive_id'] ) {
        $error['empty_not_enough_rights'] = 'Not Enough Rights';
    }
    if ( !$_POST['post_title'] ) {
        $error['empty_post_title'] = 'No Post title';
    }
    if ( !$_POST['post_link'] ) {
        $error['empty_post_link'] = 'No Post link';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $portfolio = get_user_meta( $_POST['current_user_id'], 'portfolio' );
        if ( !$portfolio ) {
            $portfolio_new = [];
            $portfolio_new[$_POST['post_title']] = $_POST['post_link'];
        } else {
            $portfolio_new = [];
            foreach ($portfolio[0] as $key => $value) {
                $portfolio_new[$key] = $value;
            }
            $portfolio_new[$_POST['post_title']] = $_POST['post_link'];
        }
        update_user_meta( $_POST['author_archive_id'], 'portfolio', $portfolio_new );
        $error['class'] = 'success';
        $error['success-end'] = 'Your data has been changed';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    }
    wp_die();
}

// User portfolio edit
add_action('wp_ajax_press_net_edit_portfolio', 'press_net_user_portfolio_edit');
add_action('wp_ajax_nopriv_press_net_edit_portfolio', 'press_net_user_portfolio_edit');
function press_net_user_portfolio_edit() {
    $error = array();
    if ( !wp_verify_nonce( $_POST['press_net_add_post'], 'press_net_add_post' ) ) {
        $error['empty_nonce'] = 'The request failed.';
    }
    if ( $_POST['current_user_id'] != $_POST['author_archive_id'] ) {
        $error['empty_not_enough_rights'] = 'Not Enough Rights';
    }
    if ( !$_POST['post_title'] ) {
        $error['empty_post_title'] = 'No Post title';
    }
    if ( !$_POST['post_link'] ) {
        $error['empty_post_link'] = 'No Post link';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $portfolio = get_user_meta( $_POST['current_user_id'], 'portfolio' );
        $portfolio_new = [];
        if ( $_POST['post_title'] !== $_POST['post_title_old']) {
            foreach ($portfolio[0] as $key => $value) {
                if ( $key == $_POST['post_title_old'] ) {
                    $portfolio_new[$_POST['post_title']] = $_POST['post_link'];
                } else {
                    $portfolio_new[$key] = $value;
                }
            }
            unset($portfolio_new[$_POST['post_title_old']]);
        } else {
            foreach ($portfolio[0] as $key => $value) {
                if ( $key == $_POST['post_title'] ) {
                    $portfolio_new[$_POST['post_title']] = $_POST['post_link'];
                } else {
                    $portfolio_new[$key] = $value;
                }
            }
        }
        update_user_meta( $_POST['author_archive_id'], 'portfolio', $portfolio_new );
        $error['class'] = 'success';
        $error['success-end'] = 'Your data has been changed';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    }
    wp_die();
}

// User portfolio delete
add_action('wp_ajax_press_net_delete_portfolio', 'press_net_user_portfolio_delete');
add_action('wp_ajax_nopriv_press_net_delete_portfolio', 'press_net_user_portfolio_delete');
function press_net_user_portfolio_delete() {
    $error = array();
    if ( !wp_verify_nonce( $_POST['press_net_add_post'], 'press_net_add_post' ) ) {
        $error['empty_nonce'] = 'The request failed.';
    }
    if ( $_POST['current_user_id'] != $_POST['author_archive_id'] ) {
        $error['empty_not_enough_rights'] = 'Not Enough Rights';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $portfolio = get_user_meta( $_POST['current_user_id'], 'portfolio' );
        $portfolio_new = [];
        foreach ($portfolio[0] as $key => $value) {
            $portfolio_new[$key] = $value;
        }
        unset($portfolio_new[$_POST['post_title']]);
        update_user_meta( $_POST['author_archive_id'], 'portfolio', $portfolio_new );
        $error['class'] = 'success';
        // $error['array_title'] = $_POST['post_title'];
        // $error['array_old'] = $portfolio[0];
        // $error['array'] = $portfolio_new;
        $error['success-end'] = 'Your data has been changed';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    }
    wp_die();
}

function press_net_get_user_posts($post_type, $tab){
    global $authordata;
    $author_id = $authordata->ID;
    $my_posts = get_posts( array(
        'numberposts' => -1,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'post_type'   => $post_type,
        'author'      => $author_id,
        'suppress_filters' => true,
    ) );
    global $post;
    if ( $tab ) {
        foreach( $my_posts as $post ){
            setup_postdata( $post );
            get_template_part( 'press-inc/template-parts/post-template/' . $post_type );
        }
    } else {
        foreach( $my_posts as $post ){
            setup_postdata( $post );
            get_template_part( 'press-inc/template-parts/post-template/company-user-profile' );
        }
    }
    wp_reset_postdata();
}

function press_net_get_user_portfolio() {
    global $authordata;
    $author_id = $authordata->ID;
    $portfolio = get_user_meta( $authordata->ID, 'portfolio' );
    foreach ($portfolio as $values) {
        foreach ($values as $key => $value) {
            ?>
            <div class="content-tab-user__form-add__form post-list-item">
                <div class="content-tab-user__form-add__form__head">
                    <div id="head-title-add-form" class="content-tab-user__form-add__form__head__title">
                        <span class="post-title"><?php echo $key; ?></span>
                    </div>
                    <div class="content-tab-user__form-add__form__head__buttons">
                        <button type="button" name="btn-edit-post-form-open" id="btn-edit-post-form-open" class="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="m6.04 17.63.14-.02 3.94-.69c.05 0 .1-.03.13-.06l9.93-9.94a.23.23 0 0 0 0-.33l-3.9-3.9a.23.23 0 0 0-.16-.06.23.23 0 0 0-.17.06l-9.93 9.94a.24.24 0 0 0-.07.12l-.69 3.94a.79.79 0 0 0 .22.7.8.8 0 0 0 .56.23Zm1.58-4.1 8.5-8.5 1.72 1.73-8.5 8.5-2.09.36.37-2.08Zm13 6.06H3.38a.75.75 0 0 0-.75.75v.85c0 .1.09.18.2.18h18.37c.1 0 .18-.08.18-.18v-.85a.75.75 0 0 0-.75-.75Z"></path>
                            </svg>
                        </button>
                        <button type="button" name="btn-delete-post-form-open-portfolio" id="btn-delete-post-form-open-portfolio" class="button" data-post="<?php //echo $post->ID; ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 7h16M10 11v6M14 11v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <form id="add-post-form">
                    <div class="field-group-two mb24">
                        <div class="field-group">
                            <div class="field-group__title">
                                <span>Post title</span>
                                <span class="field-group__title__required">*</span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="input" name="post_title" id="post_title" placeholder="Post title" required value="<?php echo $key; ?>" />
                            </div>
                            <span class="field-group__warning-input">Field is required</span>
                        </div>
                        <div class="field-group">
                            <div class="field-group__title">
                                <span>Link to publication</span>
                                <span class="field-group__title__required">*</span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="input" name="post_link" id="post_link" placeholder="Link to publication" required value="<?php echo $value; ?>" />
                            </div>
                            <span class="field-group__warning-input">Field is required</span>
                        </div>
                    </div>

                    <div class="buttons-group-post edit-post-portfolio">
                        <button type="button" name="btn-cancel-edit-post-form" id="btn-cancel-edit-post-form" class="button cancel-post-form" data-title="New publication">Cancel</button>
                        <button type="button" name="btn-edit-post-form" id="btn-edit-post-form" class="button save-post-form">Save</button>
                    </div>

                    <input type="hidden" name="post_title_old" id="post_title_old" value="<?php echo $key; ?>" />
                </form>
                <div class="content-tab-user__form-add__form__edit-success">Changes saved</div>
            </div>
            <?php
        }
    }
}

function press_net_get_user_themes() {
    global $authordata;
    $author_id = $authordata->ID;
    $user_themes = get_user_meta( $authordata->ID, 'user_themes' );
    if ( $user_themes ) {
        foreach ($user_themes[0] as $user_theme) {
            echo '<div class="user-themes__items__item">
                <span>' . $user_theme . '</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <title>Delete a theme</title>
                    <path d="M18 6L6 18" stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M6 6L18 18" stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>';
        }
    }
}

function press_net_get_users_parent($type) {
    global $authordata;
    $author_id = $authordata->ID;
    $users_data = array(
        'meta_query' => [
            // 'relation' => 'AND',
    		[
    			'key' => 'parent_user',
    			'value' => $author_id
    		],
            [
                'key' => 'account_type',
                'value' => $type,
                'compare' => 'LIKE'
            ]

    	]
    );
    $users = get_users($users_data);
    foreach ($users as $user) {
        $user_data = get_user_by('id', $user->ID);
        $user_link = get_author_posts_url( $user->ID );
        echo '<div class="parent-user-list__item">
            <a href="' . $user_link . '" title="Go to user"></a>
            <div class="parent-user-list__item__name">' . $user_data->display_name . '</div>
            <button type="button" name="btn-delete-parent-user" id="btn-delete-parent-user" class="button" data-user="' . $user->ID . '" title="Delete">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 7h16M10 11v6M14 11v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"></path>
                </svg>
            </button>
        </div>';
    }
    // return $users;
}

// Parent user delete
add_action('wp_ajax_parent_user_delete', 'press_net_parent_user_delete');
add_action('wp_ajax_nopriv_parent_user_delete', 'press_net_parent_user_delete');
function press_net_parent_user_delete() {
    $error = array();
    if ( !wp_verify_nonce( $_POST['press_net_add_post'], 'press_net_add_post' ) ) {
        $error['empty_nonce'] = 'The request failed.';
    }
    if ( $_POST['current_user_id'] != $_POST['author_archive_id'] ) {
        $error['empty_not_enough_rights'] = 'Not Enough Rights';
    }
    if ( !$_POST['user_id'] ) {
        $error['empty_user_id'] = 'No User id';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        update_user_meta( $_POST['user_id'], 'parent_user', 0 );

        $error['class'] = 'success';
        // $error['success-end'] = 'Your data has been changed';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
    wp_die();
}

// User subscribe
add_action('wp_ajax_subscribe_user_post', 'press_net_subscribe_user_post');
add_action('wp_ajax_nopriv_subscribe_user_post', 'press_net_subscribe_user_post');
function press_net_subscribe_user_post() {
    $error = array();
    if ( !wp_verify_nonce( $_POST['press-network'], 'press-network' ) ) {
        $error['empty_nonce'] = 'The request failed.';
    }
    if ( !$_POST['current_user'] ) {
        $error['empty_not_current_user_id'] = 'Not Enough Rights';
    }
    if ( !$_POST['post_id'] ) {
        $error['empty_not_post_id'] = 'Not post id';
    }
    if ( !$_POST['post_type'] ) {
        $error['empty_not_post_type'] = 'Not post type';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $subscribe_media = get_user_meta( $_POST['current_user'], $_POST['post_type'] );
        if ( $subscribe_media ) {
            if (in_array($_POST['post_id'], $subscribe_media[0])) {
                $result = array();
                array_walk_recursive($subscribe_media, function ($item, $key) use (&$result) {
                    $result[] = $item;
                });
                if ( count($result) > 1 ) {
                    foreach($result as $key => $item){
                        if ($item == $_POST['post_id']){
                            unset($result[$key]);
                        }
                    }
                    update_user_meta( $_POST['current_user'], $_POST['post_type'], $result );
                } else {
                    delete_user_meta( $_POST['current_user'], $_POST['post_type'] );
                }
            } else {
                $result = array();
                array_walk_recursive($subscribe_media, function ($item, $key) use (&$result) {
                    $result[] = $item;
                });
                array_push($result, $_POST['post_id']);
                update_user_meta( $_POST['current_user'], $_POST['post_type'], $result );
            }
        } else {
            $subscribe_media = array();
            array_push($subscribe_media, $_POST['post_id']);
            update_user_meta( $_POST['current_user'], $_POST['post_type'], $subscribe_media );
        }
        $error['class'] = 'success';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
    wp_die();
}

function press_net_subscribe_user_post_single_is($post_id, $post_type) {
    global $current_user;
    $subscribe_post = get_user_meta( $current_user->ID, $post_type );
    if ( $subscribe_post ) {
        if (in_array($post_id, $subscribe_post[0])) {
            // return true;
            return ['subscribe' => '', 'unfollow' => ' active'];
        } else {
            // return false;
            return ['subscribe' => ' active', 'unfollow' => ''];
        }
    } else {
        return ['subscribe' => ' active', 'unfollow' => ''];
    }
}

function press_net_subscribe_user_post_archive_is($post_id, $post_type) {
    global $current_user;
    $subscribe_post = get_user_meta( $current_user->ID, $post_type );
    if ( $post_type == 'subscribe_media' ) {
        $title_sub = 'Subscribe to this media';
        $title_unf = 'Unfollow this media';
    } elseif ( $post_type == 'subscribe_request' ) {
        $title_sub = 'Subscribe to this request';
        $title_unf = 'Unfollow this request';
    }
    if ( $subscribe_post ) {
        if (in_array($post_id, $subscribe_post[0])) {
            return ['btn_class' => ' active', 'title' => $title_unf];
        } else {
            return ['btn_class' => '', 'title' => $title_sub];
        }
    } else {
        return ['btn_class' => '', 'title' => $title_sub];
    }
}
