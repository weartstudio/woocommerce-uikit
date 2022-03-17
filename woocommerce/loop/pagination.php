<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>
<nav class="woocommerce-pagination">
	<?php
	$paginate_links = paginate_links(
		apply_filters(
			'woocommerce_pagination_args',
			array( // WPCS: XSS ok.
				'base'      => $base,
				'format'    => $format,
				'add_args'  => false,
				'current'   => max( 1, $current ),
				'total'     => $total,
				'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
				'next_text' => is_rtl() ? '&larr;' : '&rarr;',
				'type'      => 'array',
				'end_size'  => 3,
				'mid_size'  => 3,
			)
		)
	);

	if ( is_array( $paginate_links ) ) { ?>
		<ul class="pagination uk-pagination uk-flex-center">
		<?php foreach ($paginate_links as $paginate_link) { ?>

			<li class="page-item">
				<?php
				$paginate_link = str_replace( 'page-numbers', 'page-link', $paginate_link );
				echo wp_kses_post($paginate_link)
				?>
			</li>

		<?php } ?>
		</ul>
	<?php } ?>
</nav>
