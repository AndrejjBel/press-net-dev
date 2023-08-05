<?php
function press_net_meta_smi() {
    global $post;
    $cur_terms = get_the_terms( $post->ID, MEDIA_CAT );
    if( is_array( $cur_terms ) ){
        $post_term = [];
        foreach( $cur_terms as $cur_term ){
            $post_term[] = $cur_term->name;
        }
        echo '<span>' . implode(",", $post_term) . '.</span>';
    }
    if ( $post->city ) {
        echo ' <span>' . $post->city . '</span>';
    }
}

function press_net_media_subject() {
    global $post;
    $cur_terms = get_the_terms( $post->ID, MEDIA_CAT );
    if( is_array( $cur_terms ) ){
        $post_term = [];
        foreach( $cur_terms as $cur_term ){
            $post_term[] = $cur_term->name;
        }
        echo '<span>' . implode(",", $post_term) . '</span>';
    }
}

function press_net_requests_deadline() {
    global $post;
    $deadline = $post->deadline;
    return $deadline;
}

/**
 * Count for Deadline date
 *
 * @param string $date - $post->deadline
 * @param string $format - 'datetime', 'timestamp', default: 'datetime'
 */
function press_net_downcounter($date, $format='datetime'){
    if ( $format == 'datetime' ) {
        $check_time = strtotime($date) - time();
    } elseif ( $format == 'timestamp' ) {
        $check_time = $date - time();
    }

    if( $check_time <= 0 ){
        return 'Deadline';
    } else {
        $days = floor($check_time/86400);
        $hours = floor(($check_time%86400)/3600);
        $minutes = floor(($check_time%3600)/60);
        $seconds = $check_time%60;

        $str = '';
        if($days > 0) $str .= num_word($days, array('day','days','days')).' ';
        if($days < 1 && $hours > 0) $str .= num_word($hours, array('hour','hours','hours')).' ';
        // if($days < 0 && $hours < 0) $str .= 'Deadline';

        // if($days > 0) $str .= num_word($days, array('day','days','days')).' ';
        // if($hours > 0) $str .= num_word($hours, array('hour','hours','hours')).' ';
        // if($minutes > 0) $str .= num_word($minutes, array('minute','minutes','minutes')).' ';
        // if($seconds > 0) $str .= num_word($seconds, array('second','seconds','seconds'));

        return $str;
    }

}

function press_net_downcounter_test($date, $format='datetime'){
    if ( $format == 'datetime' ) {
        $check_time = strtotime($date) - time();
    } elseif ( $format == 'timestamp' ) {
        $check_time = $date - time();
    }

    // if($check_time <= 0){
    //     return false;
    // }
    // $days = floor($check_time/86400);
    // $hours = floor(($check_time%86400)/3600);
    // $minutes = floor(($check_time%3600)/60);
    // $seconds = $check_time%60;

    // $str = '';
    // if($days > 0) $str .= num_word($days,array('day','days','days')).' ';
    // if($days < 1 && $hours > 0) $str .= num_word($hours,array('hour','hours','hours')).' ';
    // if($days < 0 && $hours < 0) $str .= 'Deadline';

    // if($days > 0) $str .= num_word($days,array('день','дня','дней')).' ';
    // if($hours > 0) $str .= declension($hours,array('час','часа','часов')).' ';
    // if($minutes > 0) $str .= declension($minutes,array('минута','минуты','минут')).' ';
    // if($seconds > 0) $str .= declension($seconds,array('секунда','секунды','секунд'));

    return $check_time;
}


function press_net_user_media_parent_list( $post_type='mass-media' ) {
    global $current_user;
    $my_posts = get_posts( array(
    	'numberposts' => -1,
    	'orderby'     => 'date',
    	'order'       => 'DESC',
    	'post_type'   => $post_type,
        'author'      => $current_user->ID,
    	'suppress_filters' => true,
    ) );
    global $post;
    if ( count($my_posts) > 0 ) {
        foreach( $my_posts as $post ){
        	setup_postdata( $post );
        	echo '<span data-post-id="' . $post->ID . '">' . get_the_title($post->ID) . '</span>';
        }
    } else {
        echo '<span data-post-id="0">Need to publish ' . $post_type . '</span>';
    }
    wp_reset_postdata();
}

function press_net_media_parent_meta($post_id, $suff = '', $preff = '') {
    $media_post = get_posts( array(
    	'p' => $post_id
    ) );
    echo '<a href="'. get_permalink($post_id) . '" title="Go to ' . get_the_title($post_id) . '">' . get_the_title($post_id) . ', ' . get_post_meta( $post_id, 'city', true ).  '</a>';
    wp_reset_postdata();
}

function press_net_media_requests_list($post_id) {
    $my_posts = get_posts( array(
    	'numberposts' => -1,
    	'orderby'     => 'date',
    	'order'       => 'DESC',
    	'post_type'   => 'requests',
    	'suppress_filters' => true,
        'meta_query' => [
    		[
    			'key' => 'mass_media_parent_id',
    			'value' => $post_id
    		]
    	]
    ) );
    foreach( $my_posts as $post_rm ){
    ?>
        <div class="archive-posts__item">
            <div class="archive-posts__item__logo">
                <svg width="32" height="32" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="60" height="60" fill="white"/>
                    <circle cx="30" cy="30" r="30" fill="#EFF4FA"/>
                    <path d="M22.2724 29.6914H16.169V37.9819C16.169 40.169 17.9491 42 20.1871 42H38.294C41.1422 42 43.431 39.7112 43.431 36.8629V18.4H22.2724V29.6914ZM18.0509 38.0328V31.5733H22.2724V37.9819C22.2724 39.1517 21.306 40.0672 20.1871 40.0672C19.0681 40.0672 18.0509 39.2026 18.0509 38.0328ZM24.1543 20.2819H41.4983V36.8629C41.4983 38.6431 40.0233 40.1181 38.2431 40.1181H23.544C23.9509 39.5078 24.1543 38.7957 24.1543 38.0328V30.6578V29.6914V20.2819Z" fill="#BDC2C9"/>
                    <path d="M28.5285 25.3681H33.0043C33.5129 25.3681 33.9707 24.9612 33.9707 24.4017C33.9707 23.8422 33.5129 23.4862 33.0043 23.4862H28.5285C28.0198 23.4862 27.5621 23.8931 27.5621 24.4526C27.5621 25.0121 27.969 25.3681 28.5285 25.3681Z" fill="#BDC2C9"/>
                    <path d="M28.5285 29.0302H37.2767C37.7854 29.0302 38.2431 28.6233 38.2431 28.0638C38.2431 27.5043 37.8362 27.0974 37.2767 27.0974H28.5285C28.0198 27.0974 27.5621 27.5043 27.5621 28.0638C27.5621 28.6233 27.969 29.0302 28.5285 29.0302Z" fill="#BDC2C9"/>
                    <path d="M28.5285 32.6922H37.2767C37.7854 32.6922 38.2431 32.2853 38.2431 31.7259C38.2431 31.1664 37.8362 30.7595 37.2767 30.7595H28.5285C28.0198 30.7595 27.5621 31.1664 27.5621 31.7259C27.5621 32.2853 27.969 32.6922 28.5285 32.6922Z" fill="#BDC2C9"/>
                    <path d="M28.5285 36.3543H37.2767C37.7854 36.3543 38.2431 35.9474 38.2431 35.3879C38.2431 34.8284 37.8362 34.4216 37.2767 34.4216H28.5285C28.0198 34.4216 27.5621 34.8284 27.5621 35.3879C27.5621 35.9474 27.969 36.3543 28.5285 36.3543Z" fill="#BDC2C9"/>
                </svg>
            </div>
            <div class="archive-posts__item__title requests">
                <span class="request-title">
                    <a href="<?php echo get_permalink($post_rm->ID);?>" class="archive-posts__item__link" title="Go to <?php echo get_the_title($post_rm->ID); ?>"><?php echo get_the_title($post_rm->ID); ?></a>
                </span>
                <div class="requests-media-meta">
                    <?php press_net_media_parent_meta($post_rm->mass_media_parent_id); ?>
                    <span class="requests-media-meta__date"><?php echo get_the_date('d.m.Y H:i', $post_rm->ID); ?></span>
                </div>
            </div>
            <div class="archive-posts__item__meta requests">
                <span class="archive-posts__item__meta__deadline" title="Time to deadline">
                    <?php echo press_net_downcounter($post_rm->deadline, $format='timestamp');?>
                </span>
            </div>
        </div>
    <?php
    }
    wp_reset_postdata();
}

function press_net_author_requests_list() {
    global $authordata;
    $author_id = $authordata->ID;
    $my_posts = get_posts( array(
    	'numberposts' => -1,
    	'orderby'     => 'date',
    	'order'       => 'DESC',
    	'post_type'   => 'requests',
        'author'      => $author_id,
    	'suppress_filters' => true,
    ) );
    foreach( $my_posts as $post_rm ){
    ?>
        <div class="archive-posts__item">
            <div class="archive-posts__item__logo">
                <svg width="32" height="32" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="60" height="60" fill="white"/>
                    <circle cx="30" cy="30" r="30" fill="#EFF4FA"/>
                    <path d="M22.2724 29.6914H16.169V37.9819C16.169 40.169 17.9491 42 20.1871 42H38.294C41.1422 42 43.431 39.7112 43.431 36.8629V18.4H22.2724V29.6914ZM18.0509 38.0328V31.5733H22.2724V37.9819C22.2724 39.1517 21.306 40.0672 20.1871 40.0672C19.0681 40.0672 18.0509 39.2026 18.0509 38.0328ZM24.1543 20.2819H41.4983V36.8629C41.4983 38.6431 40.0233 40.1181 38.2431 40.1181H23.544C23.9509 39.5078 24.1543 38.7957 24.1543 38.0328V30.6578V29.6914V20.2819Z" fill="#BDC2C9"/>
                    <path d="M28.5285 25.3681H33.0043C33.5129 25.3681 33.9707 24.9612 33.9707 24.4017C33.9707 23.8422 33.5129 23.4862 33.0043 23.4862H28.5285C28.0198 23.4862 27.5621 23.8931 27.5621 24.4526C27.5621 25.0121 27.969 25.3681 28.5285 25.3681Z" fill="#BDC2C9"/>
                    <path d="M28.5285 29.0302H37.2767C37.7854 29.0302 38.2431 28.6233 38.2431 28.0638C38.2431 27.5043 37.8362 27.0974 37.2767 27.0974H28.5285C28.0198 27.0974 27.5621 27.5043 27.5621 28.0638C27.5621 28.6233 27.969 29.0302 28.5285 29.0302Z" fill="#BDC2C9"/>
                    <path d="M28.5285 32.6922H37.2767C37.7854 32.6922 38.2431 32.2853 38.2431 31.7259C38.2431 31.1664 37.8362 30.7595 37.2767 30.7595H28.5285C28.0198 30.7595 27.5621 31.1664 27.5621 31.7259C27.5621 32.2853 27.969 32.6922 28.5285 32.6922Z" fill="#BDC2C9"/>
                    <path d="M28.5285 36.3543H37.2767C37.7854 36.3543 38.2431 35.9474 38.2431 35.3879C38.2431 34.8284 37.8362 34.4216 37.2767 34.4216H28.5285C28.0198 34.4216 27.5621 34.8284 27.5621 35.3879C27.5621 35.9474 27.969 36.3543 28.5285 36.3543Z" fill="#BDC2C9"/>
                </svg>
            </div>
            <div class="archive-posts__item__title requests">
                <span class="request-title">
                    <a href="<?php echo get_permalink($post_rm->ID);?>" class="archive-posts__item__link" title="Go to <?php echo get_the_title($post_rm->ID); ?>"><?php echo get_the_title($post_rm->ID); ?></a>
                </span>
                <div class="requests-media-meta">
                    <?php press_net_media_parent_meta($post_rm->mass_media_parent_id); ?>
                    <span class="requests-media-meta__date"><?php echo get_the_date('d.m.Y H:i', $post_rm->ID); ?></span>
                </div>
            </div>
            <div class="archive-posts__item__meta requests">
                <span class="archive-posts__item__meta__deadline" title="Time to deadline">
                    <?php echo press_net_downcounter($post_rm->deadline, $format='timestamp');
                    ?>
                </span>
            </div>
        </div>
    <?php
    }
    wp_reset_postdata();
}

function press_net_get_authors_media($type) {
    $users_data = array(
        'meta_query' => [
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
            <div class="parent-user-list__item__name">' . $user_data ->display_name . '</div>
            <button type="button" name="btn-delete-parent-user" id="btn-delete-parent-user" class="button" data-user="' . $user->ID . '" title="Delete">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 7h16M10 11v6M14 11v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"></path>
                </svg>
            </button>
        </div>';
    }
}

add_action('wp_ajax_press_net_post_list_json', 'press_net_media_company_list_json');
add_action('wp_ajax_nopriv_press_net_post_list_json', 'press_net_media_company_list_json');
function press_net_media_company_list_json() {
    $post_type = $_POST['post_type'];
    $orderby = 'title';
    $order = 'ASC';
    if ( $_POST['orderby'] ) {
        $orderby = $_POST['orderby'];
    }
    if ( $_POST['order'] ) {
        $order = $_POST['order'];
    }
    $my_posts = get_posts( array(
    	'numberposts' => -1,
    	'orderby'     => $orderby, // title, date
    	'order'       => $order, // ASC, DESC
    	'post_type'   => $post_type,
    	'suppress_filters' => true,
    ) );
    global $post;
    if ( count($my_posts) > 0 ) {
        $post_arr = [];
        foreach( $my_posts as $post ){
        	setup_postdata( $post );
        	$post_arr[] = [
                'id' => $post->ID,
                'title' => get_the_title($post->ID)
            ];
        }
    }
    wp_reset_postdata();
    $post_arr_fin = json_encode($post_arr, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    echo $post_arr_fin;
    wp_die();
}
