<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">	
			    <script>
				    var ajaxurl = '<?php echo site_url(); ?>/wp-admin/admin-ajax.php';
				    var posts_vars = '<?php echo serialize($wp_query->query_vars); ?>';
			    </script>

			    <div class="container">
			    		<div class="row text-center justify-content-center">
			    	    	<button class="col-4" id="loadmore" class="">Показать записи</button>		
			    		</div>
			    </div>
		</main> <!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
