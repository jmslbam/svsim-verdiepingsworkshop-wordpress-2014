<?php

function ll_portfolio_init() {
	register_post_type( 'll-portfolio', array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'query_var'         => true,
		'rewrite'           => true,
		'labels'            => array(
			'name'                => __( 'Portfolio items', 'svsim' ),
			'singular_name'       => __( 'Portfolio item', 'svsim' ),
			'all_items'           => __( 'Portfolio items', 'svsim' ),
			'new_item'            => __( 'New Portfolio item', 'svsim' ),
			'add_new'             => __( 'Add New', 'svsim' ),
			'add_new_item'        => __( 'Add New Portfolio item', 'svsim' ),
			'edit_item'           => __( 'Edit Portfolio item', 'svsim' ),
			'view_item'           => __( 'View Portfolio item', 'svsim' ),
			'search_items'        => __( 'Search Portfolio items', 'svsim' ),
			'not_found'           => __( 'No Portfolio items found', 'svsim' ),
			'not_found_in_trash'  => __( 'No Portfolio items found in trash', 'svsim' ),
			'parent_item_colon'   => __( 'Parent Portfolio item', 'svsim' ),
			'menu_name'           => __( 'Portfolio items', 'svsim' ),
		),
	) );

}
add_action( 'init', 'll_portfolio_init' );

function ll_portfolio_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['ll-portfolio'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Portfolio item updated. <a target="_blank" href="%s">View Portfolio item</a>', 'svsim'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'svsim'),
		3 => __('Custom field deleted.', 'svsim'),
		4 => __('Portfolio item updated.', 'svsim'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Portfolio item restored to revision from %s', 'svsim'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Portfolio item published. <a href="%s">View Portfolio item</a>', 'svsim'), esc_url( $permalink ) ),
		7 => __('Portfolio item saved.', 'svsim'),
		8 => sprintf( __('Portfolio item submitted. <a target="_blank" href="%s">Preview Portfolio item</a>', 'svsim'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Portfolio item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio item</a>', 'svsim'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Portfolio item draft updated. <a target="_blank" href="%s">Preview Portfolio item</a>', 'svsim'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'll_portfolio_updated_messages' );
