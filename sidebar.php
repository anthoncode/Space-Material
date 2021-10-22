<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package space_material
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<!-- widget-area sidebar-1-area mt-3r card -->
<!-- <aside id="secondary" class=""> -->
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
<!-- </aside> -->
<!-- #secondary -->
