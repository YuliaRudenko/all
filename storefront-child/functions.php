<?php

// добавляем bootstrap

function wpt_register_js() {
    wp_register_script('jquery.bootstrap.min', get_stylesheet_directory_uri() . '/libraries/bootstrap/bootstrap.min.js', 'jquery');
    wp_enqueue_script('jquery.bootstrap.min');
}
add_action( 'init', 'wpt_register_js' );
function wpt_register_css() {
    wp_register_style( 'bootstrap.min', get_stylesheet_directory_uri() . '/libraries/bootstrap/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap.min' );
}
add_action( 'wp_enqueue_scripts', 'wpt_register_css' );


// регистрируем новый пост тайп

add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type( 'books', [
		'label'  => null,
		'labels' => [
			'name'               => 'All books',
			'singular_name'      => 'Book',
			'add_new'            => 'Add new book',
			'menu_name'          => 'Books'
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => true, // показывать ли в меню адмнки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 2,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}


// подключаем loadmore.js

function loadmore_script() {
     wp_enqueue_script('loadmore', get_stylesheet_directory_uri() . '/assets/js/loadmore.js', array('jquery'));
}
 
add_action('wp_enqueue_scripts', 'loadmore_script');



// получаем посты нужного типа

function loadmore_get_posts(){
    $args = unserialize(stripslashes($_POST['query']));
    $args['post_type'] = 'books';
 
    query_posts($args);
    // если посты есть
    if(have_posts()) :
        while(have_posts()): the_post();?>
        	<div class="col-12 col-md-4 col-lg-3">
	        	<a href="<?php the_permalink(); ?>">
	        		<h2><?php the_title();?></h2>
	        		<?php the_content();?>
	        	</a>
        	</div>
        	<?php
        endwhile;
    endif;
    die();
}

add_action('wp_ajax_loadmore', 'loadmore_get_posts');
add_action('wp_ajax_nopriv_loadmore', 'loadmore_get_posts');
?>