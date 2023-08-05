<?php
// Post type Requests
add_action( 'init', 'press_net_register_post_type_requests' );
function press_net_register_post_type_requests(){
    $tax_name = 'Requests categories';
    $tax_singular_name = 'Request category';
    $tax_slug = 'requests-cat';

    $post_type_name = 'Requests';
    $post_type_singular_name = 'Request';
    $post_type_slug = 'requests';
    $menu_icon = 'dashicons-pressthis';
    register_taxonomy( $tax_slug, [ $post_type_slug ], [
		'label'                 => '',
		'labels'                => [
			'name'              => esc_html__( $tax_name, 'press-net' ),
			'singular_name'     => esc_html__( $tax_singular_name, 'press-net' ),
			'search_items'      => esc_html__( 'Search ' . $tax_singular_name, 'press-net' ),
			'all_items'         => esc_html__( 'All ' . $tax_name, 'press-net' ),
			'view_item '        => esc_html__( 'View ' . $tax_singular_name, 'press-net' ),
			'parent_item'       => esc_html__( 'Parent ' . $tax_singular_name, 'press-net' ),
			'parent_item_colon' => esc_html__( 'Parent ' . $tax_singular_name . ':', 'press-net' ),
			'edit_item'         => esc_html__( 'Edit ' . $tax_singular_name, 'press-net' ),
			'update_item'       => esc_html__( 'Update ' . $tax_singular_name, 'press-net' ),
			'add_new_item'      => esc_html__( 'Add ' . $tax_singular_name, 'press-net' ),
			'new_item_name'     => esc_html__( 'New ' . $tax_singular_name, 'press-net' ),
			'menu_name'         => esc_html__( $tax_name, 'press-net' ),
			'back_to_items'     => esc_html__( '← Back to ' . $tax_name, 'press-net' ),
		],
		'description'           => '',
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => true,
		'rest_base'             => null,
	] );

    register_post_type( $post_type_slug, [
		'label'  => null,
		'labels' => [
			'name'               => esc_html__( $post_type_name, 'press-net' ),
			'singular_name'      => esc_html__( $post_type_singular_name, 'press-net' ),
			'add_new'            => esc_html__( 'Add ' . $post_type_singular_name, 'press-net' ),
			'add_new_item'       => esc_html__( 'Add new ' . $post_type_singular_name, 'press-net' ),
			'edit_item'          => esc_html__( 'Update ' . $post_type_singular_name, 'press-net' ),
			'new_item'           => esc_html__( 'New ' . $post_type_singular_name, 'press-net' ),
			'view_item'          => esc_html__( 'View ' . $post_type_singular_name, 'press-net' ),
			'search_items'       => esc_html__( 'Search ' . $post_type_singular_name, 'press-net' ),
			'not_found'          => esc_html__( 'No ' . $post_type_singular_name . ' found', 'press-net' ),
			'not_found_in_trash' => esc_html__( 'No ' . $post_type_singular_name . ' found in Trash', 'press-net' ),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__( $post_type_name, 'press-net' ),
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
		'show_in_rest'        => true,
		'rest_base'           => null,
		'menu_position'       => null,
		'menu_icon'           => $menu_icon,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [ $tax_slug ],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

// Post type Mass media
add_action( 'init', 'press_net_register_post_type_mass_media' );
function press_net_register_post_type_mass_media(){
    $tax_name = 'Mass media categories';
    $tax_singular_name = 'Mass media category';
    $tax_slug = 'mass-media-cat';

    $post_type_name = 'Mass media';
    $post_type_singular_name = 'Mass media';
    $post_type_slug = 'mass-media';
    $menu_icon = 'dashicons-media-spreadsheet';
    register_taxonomy( $tax_slug, [ $post_type_slug ], [
		'label'                 => '',
		'labels'                => [
			'name'              => esc_html__( $tax_name, 'press-net' ),
			'singular_name'     => esc_html__( $tax_singular_name, 'press-net' ),
			'search_items'      => esc_html__( 'Search ' . $tax_singular_name, 'press-net' ),
			'all_items'         => esc_html__( 'All ' . $tax_name, 'press-net' ),
			'view_item '        => esc_html__( 'View ' . $tax_singular_name, 'press-net' ),
			'parent_item'       => esc_html__( 'Parent ' . $tax_singular_name, 'press-net' ),
			'parent_item_colon' => esc_html__( 'Parent ' . $tax_singular_name . ':', 'press-net' ),
			'edit_item'         => esc_html__( 'Edit ' . $tax_singular_name, 'press-net' ),
			'update_item'       => esc_html__( 'Update ' . $tax_singular_name, 'press-net' ),
			'add_new_item'      => esc_html__( 'Add ' . $tax_singular_name, 'press-net' ),
			'new_item_name'     => esc_html__( 'New ' . $tax_singular_name, 'press-net' ),
			'menu_name'         => esc_html__( $tax_name, 'press-net' ),
			'back_to_items'     => esc_html__( '← Back to ' . $tax_name, 'press-net' ),
		],
		'description'           => '',
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => true,
		'rest_base'             => null,
	] );

    register_post_type( $post_type_slug, [
		'label'  => null,
		'labels' => [
			'name'               => esc_html__( $post_type_name, 'press-net' ),
			'singular_name'      => esc_html__( $post_type_singular_name, 'press-net' ),
			'add_new'            => esc_html__( 'Add ' . $post_type_singular_name, 'press-net' ),
			'add_new_item'       => esc_html__( 'Add new ' . $post_type_singular_name, 'press-net' ),
			'edit_item'          => esc_html__( 'Update ' . $post_type_singular_name, 'press-net' ),
			'new_item'           => esc_html__( 'New ' . $post_type_singular_name, 'press-net' ),
			'view_item'          => esc_html__( 'View ' . $post_type_singular_name, 'press-net' ),
			'search_items'       => esc_html__( 'Search ' . $post_type_singular_name, 'press-net' ),
			'not_found'          => esc_html__( 'No ' . $post_type_singular_name . ' found', 'press-net' ),
			'not_found_in_trash' => esc_html__( 'No ' . $post_type_singular_name . ' found in Trash', 'press-net' ),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__( $post_type_name, 'press-net' ),
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
		'show_in_rest'        => true,
		'rest_base'           => null,
		'menu_position'       => null,
		'menu_icon'           => $menu_icon,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [ $tax_slug ],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

// Post type My companies
add_action( 'init', 'press_net_register_post_type_company' );
function press_net_register_post_type_company(){
    $tax_name = 'Companies categories';
    $tax_singular_name = 'Company category';
    $tax_slug = 'company-cat';

    $post_type_name = 'Companies';
    $post_type_singular_name = 'Company';
    $post_type_slug = 'company';
    $menu_icon = 'dashicons-building';
    register_taxonomy( $tax_slug, [ $post_type_slug ], [
		'label'                 => '',
		'labels'                => [
			'name'              => esc_html__( $tax_name, 'press-net' ),
			'singular_name'     => esc_html__( $tax_singular_name, 'press-net' ),
			'search_items'      => esc_html__( 'Search ' . $tax_singular_name, 'press-net' ),
			'all_items'         => esc_html__( 'All ' . $tax_name, 'press-net' ),
			'view_item '        => esc_html__( 'View ' . $tax_singular_name, 'press-net' ),
			'parent_item'       => esc_html__( 'Parent ' . $tax_singular_name, 'press-net' ),
			'parent_item_colon' => esc_html__( 'Parent ' . $tax_singular_name . ':', 'press-net' ),
			'edit_item'         => esc_html__( 'Edit ' . $tax_singular_name, 'press-net' ),
			'update_item'       => esc_html__( 'Update ' . $tax_singular_name, 'press-net' ),
			'add_new_item'      => esc_html__( 'Add ' . $tax_singular_name, 'press-net' ),
			'new_item_name'     => esc_html__( 'New ' . $tax_singular_name, 'press-net' ),
			'menu_name'         => esc_html__( $tax_name, 'press-net' ),
			'back_to_items'     => esc_html__( '← Back to ' . $tax_name, 'press-net' ),
		],
		'description'           => '',
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => true,
		'rest_base'             => null,
	] );

    register_post_type( $post_type_slug, [
		'label'  => null,
		'labels' => [
			'name'               => esc_html__( $post_type_name, 'press-net' ),
			'singular_name'      => esc_html__( $post_type_singular_name, 'press-net' ),
			'add_new'            => esc_html__( 'Add ' . $post_type_singular_name, 'press-net' ),
			'add_new_item'       => esc_html__( 'Add new ' . $post_type_singular_name, 'press-net' ),
			'edit_item'          => esc_html__( 'Update ' . $post_type_singular_name, 'press-net' ),
			'new_item'           => esc_html__( 'New ' . $post_type_singular_name, 'press-net' ),
			'view_item'          => esc_html__( 'View ' . $post_type_singular_name, 'press-net' ),
			'search_items'       => esc_html__( 'Search ' . $post_type_singular_name, 'press-net' ),
			'not_found'          => esc_html__( 'No ' . $post_type_singular_name . ' found', 'press-net' ),
			'not_found_in_trash' => esc_html__( 'No ' . $post_type_singular_name . ' found in Trash', 'press-net' ),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__( $post_type_name, 'press-net' ),
		],
		'description'            => '',
		'public'                 => true,
        'publicly_queryable'     => false,
		'show_in_menu'           => true,
		'show_in_rest'        => true,
		'rest_base'           => null,
		'menu_position'       => null,
		'menu_icon'           => $menu_icon,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [ $tax_slug ],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => false,
	] );
}
