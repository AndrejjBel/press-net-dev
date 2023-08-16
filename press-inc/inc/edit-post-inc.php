<?php
function press_net_rights_edit_post($post_id) {
    global $user_ID;
    $post_obj = get_post( $post_id );
    if ( $post_obj ) {
        if ( $user_ID == $post_obj->post_author ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function press_net_edit_post_obj($post_id) {
    $post_obj = get_post( $post_id );
    return $post_obj;
}

function press_net_terms_post($post_id, $term_slag, $all=1) {
    $cur_terms = get_the_terms( $post_id, $term_slag );
    if( is_array( $cur_terms ) ){
        if ( $all == 1 ) {
            $terms_id = [];
            $term_name = [];
            foreach( $cur_terms as $cur_term ){
        		$terms_id[] = $cur_term->term_id;
                $term_name[] = $cur_term->name;
        	}
            return ['term_name' => implode(",", $term_name), 'terms_id' => implode(",", $terms_id)];
        } else {
            $terms_id = [];
            foreach( $cur_terms as $cur_term ){
                if ( $cur_term->parent == 0 ) {
                    $terms_child = get_term_children( $cur_term->term_id, $term_slag );
                    if ( !$terms_child ) {
                        $term_name = $cur_term->name;
                    }
                } else {
                    $term_name = $cur_term->name;
                }
                $terms_id[] = $cur_term->term_id;
        	}
            return ['term_name' => $term_name, 'terms_id' => implode(",", $terms_id)];
        }
    }
}

// Edit post
add_action('wp_ajax_edit_post_page', 'press_net_post_edit_page');
add_action('wp_ajax_nopriv_edit_post_page', 'press_net_post_edit_page');
function press_net_post_edit_page() {
    $error = array();
    $post_content = '';
    if ( !wp_verify_nonce( $_POST['press-network'], 'press-network' ) ) {
        $error['empty_nonce'] = 'The request failed';
    }
    if ( !$_POST['current_user'] ) {
        $error['empty_not_logged_user'] = 'Not logged user';
    }
    if ( $_POST['current_user'] != $_POST['post_author'] ) {
        $error['empty_not_enough_rights'] = 'Not enough rights';
    }
    if ( !$_POST['post_id'] ) {
        $error['empty_post_id'] = 'No Post id';
    }
    if ( !$_POST['post_title'] ) {
        $error['empty_post_title'] = 'No Post title';
    }
    if ( !$_POST['description'] ) {
        $error['empty_post_description'] = 'No Post description';
    }
    if ( !$_POST['rubric'] ) {
        $error['empty_post_rubric'] = 'No Post rubric';
    }
    if ( !$_POST['request_type'] ) {
        $error['empty_post_request_type'] = 'No Post request type';
    }
    if ( !$_POST['mass_media_parent_id'] ) {
        $error['empty_post_media_parent_id'] = 'No Post media parent';
    }
    if ( !$_POST['deadline'] ) {
        $error['empty_post_deadline'] = 'No Post deadline';
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $request_post = [
            'ID' => $_POST['post_id'],
            'post_title' => $_POST['post_title'],
            'post_content' => $_POST['description'],
            'meta_input' => [
                'request_type' => $_POST['request_type'],
                'mass_media_parent_id' => $_POST['mass_media_parent_id'],
                'deadline' => strtotime($_POST['deadline']),
                'signs_number_from' => $_POST['signs_number_from'],
                'signs_number_upto' => $_POST['signs_number_upto'],
            ],
        ];
        // Updating
        wp_update_post( wp_slash( $request_post ) );
        $rubrics = explode(",", $_POST['rubric']);
        $rubrics_num = [];
        foreach ($rubrics as $rubric) {
            $rubrics_num[] = (int)$rubric;
        }
        wp_set_object_terms( $_POST['post_id'], $rubrics_num, REQUESTS_CAT );

        $error['success'] = 'Success';
        $error['url'] = get_permalink($_POST['post_id']);
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
}
