<?php

class customize_menu_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = array(), $id=0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent .'<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>'.'<div class="menu_item_description">' . $item->description . '</div>';
                $post=get_post(url_to_postid($item->url));
                if(preg_match("/^(archive|event|papers|regulations)/iu",$post->post_type))$output .= "<div class=\"post_type_name inactive rtl-align-left\" style=\"background-image:url('".get_the_post_type_thumbnail($post->post_type)."')\"><a href=\"".get_the_post_type_permalink($post->post_type)."\">".get_the_post_type_name($post->post_type)."</a></div>";
		else $output .= "<div class=\"post_type_name inactive empty rtl-align-left\"><a href=\"#\"></a></div>";
                //print_r($item);exit;
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		

	}
}