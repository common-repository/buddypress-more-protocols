<?php
/*
Plugin Name: BuddyPress More Protocols
Description: Increases number of supported protocols for BuddyPress's users links. For now additional supported protocols are only apt (ubuntu) and magnet (torrent), but suggestions are welcome :D [Aggiungiamo il supporto per i protocolli apt:// magnet:// e "chi più ne ha più ne metta" :D]
Version:1.0.2
Author: scienzedellevanghe
Licennse: GPLv2
*/
if(defined('BP_VERSION')){
	add_action( 'init', 'bp_activity_filter_kses_moreprotocols', 1); 
	function bp_activity_filter_kses_moreprotocols(){
		remove_filter( 'bp_get_activity_action',                'bp_activity_filter_kses', 1 );
		remove_filter( 'bp_get_activity_content_body',          'bp_activity_filter_kses', 1 );
		remove_filter( 'bp_get_activity_content',               'bp_activity_filter_kses', 1 );
		remove_filter( 'bp_get_activity_parent_content',        'bp_activity_filter_kses', 1 );
		remove_filter( 'bp_get_activity_latest_update',         'bp_activity_filter_kses', 1 );
		remove_filter( 'bp_get_activity_latest_update_excerpt', 'bp_activity_filter_kses', 1 );
		remove_filter( 'bp_get_activity_feed_item_description', 'bp_activity_filter_kses', 1 );
		remove_filter( 'bp_activity_content_before_save',       'bp_activity_filter_kses', 1 );
		remove_filter( 'bp_activity_action_before_save',        'bp_activity_filter_kses', 1 );

		add_filter( 'bp_get_activity_action',                'bp_activity_filter_kses_fixed', 1 );
		add_filter( 'bp_get_activity_content_body',          'bp_activity_filter_kses_fixed', 1 );
		add_filter( 'bp_get_activity_content',               'bp_activity_filter_kses_fixed', 1 );
		add_filter( 'bp_get_activity_parent_content',        'bp_activity_filter_kses_fixed', 1 );
		add_filter( 'bp_get_activity_latest_update',         'bp_activity_filter_kses_fixed', 1 );
		add_filter( 'bp_get_activity_latest_update_excerpt', 'bp_activity_filter_kses_fixed', 1 );
		add_filter( 'bp_get_activity_feed_item_description', 'bp_activity_filter_kses_fixed', 1 );
		add_filter( 'bp_activity_content_before_save',       'bp_activity_filter_kses_fixed', 1 );
		add_filter( 'bp_activity_action_before_save',        'bp_activity_filter_kses_fixed', 1 );


		function bp_activity_filter_kses_fixed( $content ) {
			global $allowedtags;

			$activity_allowedtags = $allowedtags;
			$activity_allowedtags['span']          = array();
			$activity_allowedtags['span']['class'] = array();
			$activity_allowedtags['div']           = array();
			$activity_allowedtags['div']['class']  = array();
			$activity_allowedtags['div']['id']     = array();
			$activity_allowedtags['a']['class']    = array();
			$activity_allowedtags['img']           = array();
			$activity_allowedtags['img']['src']    = array();
			$activity_allowedtags['img']['alt']    = array();
			$activity_allowedtags['img']['class']  = array();
			$activity_allowedtags['img']['width']  = array();
			$activity_allowedtags['img']['height'] = array();
			$activity_allowedtags['img']['class']  = array();
			$activity_allowedtags['img']['id']     = array();
			$activity_allowedtags['img']['title']  = array();
			$activity_allowedtags['code']          = array();

			$activity_allowedtags = apply_filters( 'bp_activity_allowed_tags', $activity_allowedtags );
			return wp_kses( $content, $activity_allowedtags, array('apt','magnet') );
		}
	}
}
?>