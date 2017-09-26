<?php
/*
Plugin Name: Test for AlgaeCal - CPT
Plugin URI: http://christinshelton.com/Wordpress
Description: Test for AlgaeCal
Version: 99.99.99
Author: Christin Shelton
Author URI: http://christinshelton.com/Wordpress
License: Free to use - IJN
*/

//include for PART TWO of TEST
function carousel_admin(){
	include('christinshelton_wordpress_script.php');	
}

add_action('init', 'carousel_admin');


function create_post_your_post() {
	register_post_type( 'your_post',
		array(
			'labels'       => array(
				'name'       => __( 'Carousel' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'has_archive'  => true,
			'supports'     => array(
				//'title',
				//'editor',
				//'excerpt',
				//'thumbnail',
				'custom-fields'
			/*), 
			'taxonomies'   => array(
				'post_tag',
				'category',*/
			)
		)
	);
	//register_taxonomy_for_object_type( 'category', 'your_post' );
	//register_taxonomy_for_object_type( 'post_tag', 'your_post' );
}
add_action( 'init', 'create_post_your_post' );

function wptuts_scripts_with_the_lot()
{    
    wp_register_script( 'browse-js', plugin_dir_url( __FILE__ ) . 'browse.js');   
 	wp_enqueue_script( 'browse-js' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_with_the_lot' );

function add_your_fields_meta_box() {
	add_meta_box(
		'your_fields_meta_box', // $id
		'Your Fields', // $title
		'show_your_fields_meta_box', // $callback
		'your_post', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );

function show_your_fields_meta_box() {
	
	global $post;  
		$meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

	<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <!-- All fields will go here -->
    <p>
	<label for="your_fields[text]">How many images?</label>
	<br>
	<input type="text" name="your_fields[text1]" id="your_fields[text1]" class="regular-text" value="">
    <p>
	<label for="your_fields[text]">How many videos?</label>
	<br>
	<input type="text" name="your_fields[text2]" id="your_fields[text1]" class="regular-text" value="">
</p>
<?php 

	for($t = 0; $t < $meta['text1']; $t++){
		$img = "image" . $t ;
	?>
	<p>
	<label for="your_fields[image]">Image Upload</label><br>
	<input type="text" name="your_fields[<?php echo $img ; ?>]" id="your_fields["<?php echo $img ; ?>"]" class="meta-image regular-text" value="">
	<input type="button" class="button image-upload" value="Browse">
</p>
<?php
	}
	
	for($u = 0; $u < $meta['text2']; $u++){
		$vid = "video" . $u ;
	?>
	<p>
	<label for="your_fields[video]">Video Upload</label><br>
	<input type="text" name="your_fields[<?php echo $vid ; ?>]" id="your_fields[<?php echo $vid ; ?>]" class="regular-text" value="">
</p>
<?php
	}
?>

<div class="image-preview"><img src="<?php echo $meta['image']; ?>" style="max-width: 250px;"></div>
    
<?php 
}
	
function save_your_fields_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'your_fields', true );
	$new = $_POST['your_fields'];
	//return $new ;
	//echo "New: " . var_dump($new) . "<br>" ;
	
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'your_fields', $new );
		
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'your_fields', $old );
	}
}
add_action( 'save_post', 'save_your_fields_meta' );

function cs_carousel1(){

	$args = array(
		'post_type' => 'your_post',
	);  

	$your_loop = new WP_Query( $args ); 
	if ( $your_loop->have_posts() ) { while ( $your_loop->have_posts() ) { $your_loop->the_post();}}
	$meta = get_post_meta( $post->ID, 'your_fields', true ); 
	var_dump($meta);
}
?>