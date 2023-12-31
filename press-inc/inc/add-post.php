<?php
// Add post
add_action('wp_ajax_press_net_add_post', 'press_net_post_add');
add_action('wp_ajax_nopriv_press_net_add_post', 'press_net_post_add');
function press_net_post_add() {
    $error = array();
    $post_content = '';
    if ( !wp_verify_nonce( $_POST['press_net_add_post'], 'press_net_add_post' ) ) {
        $error['empty_nonce'] = 'The request failed';
    }
    if ( $_POST['post_type'] != REQUESTS ) {
        if ( $_POST['current_user_id'] != $_POST['author_archive_id'] ) {
            $error['empty_not_enough_rights'] = 'Not Enough Rights';
        }
    } elseif ( $_POST['post_type'] == REQUESTS ) {
        if ( !$_POST['current_user_id'] ) {
            $error['empty_not_enough_rights'] = 'Not Enough Rights';
        }
    }

    if ( !$_POST['post_title'] ) {
        $error['empty_post_title'] = 'No Post title';
    }
    // Post type company
    if ( $_POST['post_type'] == COMPANY ) {
        if ( !$_POST['job_title'] ) {
            $error['empty_job_title'] = 'No Job title';
        }
    }
    if ( $_POST['post_type'] == MEDIA ) {
        if ( !$_POST['job_title'] ) {
            $error['empty_job_title'] = 'No Job title';
        }
        if ( !$_POST['website'] ) {
            $error['empty_website'] = 'No website';
        }
        if ( !$_POST['city'] ) {
            $error['empty_city'] = 'No city';
        }
    }
    if ( $_POST['post_type'] == PORTFOLIO ) {
        if ( !$_POST['link'] ) {
            $error['empty_link'] = 'No link';
        }
        // if ( !$_POST['portf_date'] ) {
        //     $error['empty_portf_date'] = 'No portfolio date';
        // }
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error['POST'] = $_POST;
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $post_status = 'publish';
        if ( $_POST['description'] ) {
            $description = $_POST['description'];
        } else {
            $description = '';
        }
        $post_data = array(
            'post_author'   => $_POST['author_archive_id'],
            'post_status'   => $post_status,
            'post_type'     => $_POST['post_type'],
            'post_title'    => stripslashes($_POST['post_title']),
            'post_content'  => $description,
        );
        $post_id = wp_insert_post( $post_data );
        if ($post_id) {
            if ( $_POST['city_obj'] ) {
                $array = json_decode(stripslashes($_POST['city_obj']));
                update_post_meta( $post_id, 'city_obj', $array );
            }
            // Post type company
            if ( $_POST['post_type'] == COMPANY ) {
                update_post_meta( $post_id, 'job_title', $_POST['job_title'] );
                if ( $_POST['website'] ) {
                    update_post_meta( $post_id, 'website', $_POST['website'] );
                }
                if ( $_POST['city'] ) {
                    update_post_meta( $post_id, 'city', $_POST['city'] );
                }
            } elseif ( $_POST['post_type'] == MEDIA ) {
                update_post_meta( $post_id, 'job_title', $_POST['job_title'] );
                update_post_meta( $post_id, 'website', $_POST['website'] );
                update_post_meta( $post_id, 'city', $_POST['city'] );
                if ( $_POST['format_obj'] ) {
                    // update_post_meta( $post_id, 'format', $_POST['format'] );
                    wp_set_object_terms( $post_id, tax_arr($_POST['format_obj']), FORMAT );
                }
                if ( $_POST['subject_obj'] ) {
                    wp_set_object_terms( $post_id, tax_arr($_POST['subject_obj']), MEDIA_CAT );
                }
            } elseif ( $_POST['post_type'] == REQUESTS ) {
                update_post_meta( $post_id, 'request_type', $_POST['request_type'] );
                update_post_meta( $post_id, 'signs_number_from', $_POST['signs_number_from'] );
                update_post_meta( $post_id, 'signs_number_upto', $_POST['signs_number_upto'] );
                update_post_meta( $post_id, 'deadline', strtotime($_POST['deadline']) );
                update_post_meta( $post_id, 'mass_media_parent_id', $_POST['mass_media_parent_id'] );
                if ( $_POST['rubric'] ) {
                    $rubrics = explode(",", $_POST['rubric']);
                    $rubrics_num = [];
                    foreach ($rubrics as $rubric) {
                        $rubrics_num[] = (int)$rubric;
                    }
                    wp_set_object_terms( $post_id, $rubrics_num, REQUESTS_CAT );
                }
            } elseif ( $_POST['post_type'] == PORTFOLIO ) {
                update_post_meta( $post_id, 'portfolio_link', $_POST['link'] );
                update_post_meta( $post_id, 'portfolio_date', strtotime($_POST['portf_date']) );
            }
            if ( !empty( $_FILES['my_image_upload']['tmp_name'] ) and $_FILES['my_image_upload']['error'] == 0 ) {
                $attachment_id = media_handle_upload( 'my_image_upload', 0 );

            	if ( is_wp_error( $attachment_id ) ) {
            		echo "Media upload error.";
                    $error['upload_error'] = 'Media upload error';
            	} else {
                    set_post_thumbnail( $post_id, $attachment_id );
            		echo "The media file has been successfully uploaded!";
            	}
            }
            $error['success'] = 'Success';
            $error['POST'] = $_POST;
            // $error['content'] = $content;
            // $error['post_status'] = $post_status;
            // $error['post_url'] = wp_unslash($post_url);
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
        }
        wp_die();
    }
}

// Edit post
add_action('wp_ajax_press_net_edit_post', 'press_net_post_edit');
add_action('wp_ajax_nopriv_press_net_edit_post', 'press_net_post_edit');
function press_net_post_edit() {
    $error = array();
    $post_content = '';
    if ( !wp_verify_nonce( $_POST['press_net_add_post'], 'press_net_add_post' ) ) {
        $error['empty_nonce'] = 'The request failed';
    }
    if ( $_POST['current_user_id'] != $_POST['author_archive_id'] ) {
        $error['empty_not_enough_rights'] = 'Not Enough Rights';
    }
    if ( !$_POST['post_title'] ) {
        $error['empty_post_title'] = 'No Post title';
    }
    // Post type company
    if ( $_POST['post_type'] == COMPANY ) {
        if ( !$_POST['job_title'] ) {
            $error['empty_job_title'] = 'No Job title';
        }
    }
    if ( $_POST['post_type'] == PORTFOLIO ) {
        if ( !$_POST['link'] ) {
            $error['empty_link'] = 'No link';
        }
        // if ( !$_POST['portf_date'] ) {
        //     $error['empty_portf_date'] = 'No portfolio date';
        // }
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $city_obj = json_decode(stripslashes($_POST['city_obj']));
        $my_post = [
            'ID' => $_POST['post_id'],
            'post_title' => stripslashes($_POST['post_title']),
            // 'meta_input' => [
            //     'job_title' => $_POST['job_title'],
            //     'website' => $_POST['website'],
            //     'city' => $_POST['city'],
            //     'city_obj' => $city_obj,
            // ],
        ];
        // Обновляем
        wp_update_post( wp_slash($my_post) );
        if ( $_POST['job_title'] ) {
            update_post_meta( $_POST['post_id'], 'job_title', $_POST['job_title'] );
        }
        if ( $_POST['website'] ) {
            update_post_meta( $_POST['post_id'], 'website', $_POST['website'] );
        }
        if ( $_POST['city'] ) {
            update_post_meta( $_POST['post_id'], 'city', $_POST['city'] );
        }
        if ( $_POST['city_obj'] ) {
            $array = json_decode(stripslashes($_POST['city_obj']));
            update_post_meta( $_POST['post_id'], 'city_obj', $array );
        }
        if ( $_POST['link'] ) {
            update_post_meta( $_POST['post_id'], 'portfolio_link', $_POST['link'] );
        }
        if ( $_POST['portf_date'] ) {
            update_post_meta( $_POST['post_id'], 'portfolio_date', strtotime($_POST['portf_date']) );
        } else {
            delete_post_meta( $_POST['post_id'], 'portfolio_date' );
        }

        if ( $_POST['format_obj'] ) {
            wp_set_object_terms( $_POST['post_id'], tax_arr($_POST['format_obj']), FORMAT );
        }
        if ( $_POST['subject_obj'] ) {
            wp_set_object_terms( $_POST['post_id'], tax_arr($_POST['subject_obj']), MEDIA_CAT );
        }

        if ( !empty( $_FILES['my_image_upload']['tmp_name'] ) and $_FILES['my_image_upload']['error'] == 0 ) {
            $attachment_id = media_handle_upload( 'my_image_upload', 0 );

        	if ( is_wp_error( $attachment_id ) ) {
        		echo "Media upload error.";
                $error['upload_error'] = 'Media upload error';
        	} else {
                set_post_thumbnail( $_POST['post_id'], $attachment_id );
        		echo "The media file has been successfully uploaded!";
        	}
        }

        if ( $_POST['logo-delete'] == 'yes' ) {
            $thumb_id = get_post_thumbnail_id( $_POST['post_id'] );
            delete_post_thumbnail( $_POST['post_id'] );
            wp_delete_attachment( $thumb_id, true );
        }

        $error['success'] = 'Success';
        $error['city_obj'] = $city_obj;
        // $error['company_city_obj'] = $_POST['company_city_obj'];
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    }
}

// Delete post
add_action('wp_ajax_press_net_delete_post', 'press_net_post_delete');
add_action('wp_ajax_nopriv_press_net_delete_post', 'press_net_post_delete');
function press_net_post_delete() {
    if ( wp_verify_nonce( $_POST['press_net_add_post'], 'press_net_add_post' )
        && $_POST['current_user_id'] == $_POST['author_archive_id']
    ) {
        // $post_id = $_POST['post_id'];
        // global $wpdb;
        // $wpdb->delete( $wpdb->postmeta, [ 'post_id'=>$post_id ] );
        // clean_post_cache( $post_id );
        wp_delete_post($_POST['post_id'], true);
        echo 'Post deleted';
    } else {
        echo 'Error!';
    }
    wp_die();
}

function tax_arr($tax_obj) {
    $tax_arr = explode(',', $tax_obj);
    $tax_arr_new = [];
    foreach ($tax_arr as $tax) {
        $tax_arr_new[] = (int) $tax;
    }
    return $tax_arr_new;
}
