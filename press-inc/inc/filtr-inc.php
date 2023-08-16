<?php
add_action('wp_ajax_filtr_requests', 'press_net_filtr_requests');
add_action('wp_ajax_nopriv_filtr_requests', 'press_net_filtr_requests');
function press_net_filtr_requests() {
    $post_type = $_POST['post_type'];
    $orderby = 'date';
    $order = 'DESC';
    if ( !empty($_POST['sort']) ) {
        if ( $_POST['sort'] == 'deadline' ) {
            $orderby = 'meta_value_num';
            $order = 'ASC';
        }
    }
    $args = array(
    	'post_type'   => $post_type,
        'orderby'     => $orderby, // title, date
    	'order'       => $order, // ASC, DESC
    	// 'suppress_filters' => true,
        'fields' => 'ids'
    );

    $args['tax_query'] = ['relation' => 'AND'];

    if ( !empty($_POST['categories']) ) {
        $args['tax_query'][] = [
            'taxonomy' => REQUESTS_CAT,
			'field'    => 'id',
			'terms'    => explode(",", $_POST['categories'])
        ];
    }

    if ( !empty($_POST['media_categories']) ) {
        $args['tax_query'][] = [
            'taxonomy' => MEDIA_CAT,
			'field'    => 'id',
			'terms'    => $_POST['media_categories']
        ];
    }

    $args['meta_query'] = ['relation' => 'AND'];

    if ( !empty($_POST['request_type']) ) {
        $args['meta_query'][] = [
            'key' => 'request_type',
            'value' => explode(",", $_POST['request_type'])
        ];
    }

    if ( !empty($_POST['favorites']) ) {
        $args['meta_query'][] = [
            'key' => 'favorites_request',
            'value' => $_POST['current_user'],
            'compare' => 'LIKE'
        ];
    }

    if ( !empty($_POST['sort']) ) {
        if ( $_POST['sort'] == 'deadline' ) {
            $args['meta_key'] = $_POST['sort'];
        }
    }

    $posts = press_net_filtr_requests_query($args);

    if ( $post_type == MEDIA ) {
        $posts = press_net_filtr_requests_query($args, -1);
    }

    $posts_query = press_net_requests_query($args);

    $posts_query_json = json_encode($posts_query);

    $posts_json = json_encode($posts, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

    echo json_encode(array('posts' => $posts, 'posts_query' => $posts_query_json));

    wp_die();
}

function press_net_filtr_requests_query($args, $posts_per_archive_page=10, $paged=1) {
    $args['posts_per_archive_page'] = $posts_per_archive_page;
    $args['paged'] = $paged;
    $posts = get_posts( $args );

    global $post;
    $posts_obj = [];
    foreach ($posts as $post) {
        $post_obj = get_post( $post );
        if ( $post_obj->post_type == REQUESTS ) {
            $media_parent = get_post( $post_obj->mass_media_parent_id );
            $media_parent_date = get_the_date('d.m.Y H:i', $media_parent->ID);
            $media_parent_url = get_permalink($media_parent->ID);
            $post_url = get_permalink($post_obj->ID);
            $thumbnail_url = get_the_post_thumbnail_url( $post_obj->ID, 'full' );
            $post_date = get_the_date('d.m.Y H:i', $post_obj->ID);
            $meta_btn_subs = press_net_subscribe_user_post_archive_is($post_obj->ID, 'subscribe_request');
            $meta_btn_fav = press_net_favorites_user_post_is($post_obj->ID);
            $meta_btn_read = press_net_mark_read_post_is($post_obj->ID);
            $deadline = press_net_downcounter($post_obj->deadline, $format='timestamp');
            $posts_obj[] = [
                'id' => $post_obj->ID,
                'post_date' => $post_date,
                'title' => $post_obj->post_title,
                'url' => $post_url,
                'thumbnail_url' => $thumbnail_url,
                'deadline' => $deadline,
                'media_parent_id' => $post_obj->mass_media_parent_id,
                'media_parent_title' => $media_parent->post_title,
                'media_parent_url' => $media_parent_url,
                'media_parent_city' => $media_parent->city,
                'meta_btn_subs' => $meta_btn_subs,
                'meta_btn_fav' => $meta_btn_fav,
                'meta_btn_read' => $meta_btn_read,
            ];
        } elseif ( $post_obj->post_type == MEDIA ) {
            $post_url = get_permalink($post_obj->ID);
            $thumbnail_url = get_the_post_thumbnail_url( $post_obj->ID, 'thumbnail' );
            $meta_btn_subs = press_net_subscribe_user_post_archive_is($post_obj->ID, 'subscribe_media');
            $cur_terms = get_the_terms( $post_obj->ID, MEDIA_CAT );
            if( is_array( $cur_terms ) ){
                $post_term = [];
                foreach( $cur_terms as $cur_term ){
                    $post_term[] = $cur_term->name;
                }
            }
            $posts_obj[] = [
                'id' => $post_obj->ID,
                'title' => $post_obj->post_title,
                'url' => $post_url,
                'thumbnail_url' => $thumbnail_url,
                'meta_btn_subs' => $meta_btn_subs,
                'city' => $post_obj->city,
                'terms' => implode(",", $post_term)
            ];
        }
    }
    wp_reset_postdata();
    $posts_fin = json_encode($posts_obj, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

    return $posts_fin;
}

function press_net_requests_query($args, $numberposts=-1) {
    $args['numberposts'] = $numberposts;
    $posts = get_posts( $args );
    wp_reset_postdata();
    return $posts; // ceil( count($posts)/10 );
}
