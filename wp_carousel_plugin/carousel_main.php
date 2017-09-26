<?php
/*

*/

//Exit if accessed directly
if (!defined('ABSPATH')){
	exit ;
}

function cs_enqueue_style() {
    wp_enqueue_style('mycss-css', plugin_dir_url(__FILE__) . 'mycss.css');
}
add_action('wp_enqueue_scripts', 'cs_enqueue_style');

function carousel_admin(){
	include('cs_carousel_admin1.php');	
}
add_action('admin_menu', 'cs_carousel_admin_actions');

/*function wptuts_scripts_with_the_lot()
{    
    wp_register_script( 'myjs-js', plugin_dir_url( __FILE__ ) . 'myjs.js');   
 	wp_enqueue_script( 'myjs-js' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_with_the_lot' );
*/

function wptuts_styles_with_the_lot()
{
    wp_register_style( 'mycss-css', plugin_dir_url(__FILE__) . 'mycss.css');
    
    wp_enqueue_style( 'mycss-css' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_styles_with_the_lot' );

function carousel_cpt() {   
    $labels = array(
			'name' => 'Carousels',
			'singular_name' => 'Carousel',
			'add_new' => 'Add New' ,
			'add_new_item' => 'Add New Carousel',
			'edit_item' => 'Edit Carousel',
			'all_items' => 'All Carousels',
			'view_items' => 'View Carousels');
        
		
	$args = array(
		'labels' => $labels,
		'public' => true
    );

    register_post_type( 'carousel', $args );
}

add_action( 'init', 'carousel_cpt' );


function cs_carousel_admin_actions(){
	global $my_settings_page ;
		
	$my_settings_page = add_options_page("Carousel Options", "Carousel Options", 1, "CarouselOptions", "carousel_admin");
	
	add_action('admin_enqueue_scripts', 'my_admin_enqueue_scripts' ) ;
}

function my_admin_enqueue_scripts($hook_suffix){
	global $my_settings_page;
	//echo "hooksuffix " . var_dump($hook_suffix) ;
	//echo "in my_admin_enqueue_scripts function <br>" ;
	if($my_settings_page == $hook_suffix)
	//echo "They equal!" ;
	//echo plugin_dir_url( __FILE__ ) . 'myjs.js' ;
	//echo "<br/>" ;
		wp_enqueue_script('myjs-js', plugin_dir_url( __FILE__ ) . 'myjs.js', array(), '5.0') ;
		//http://www.christinshelton.com/Wordpress/wp-content/plugins/carousel/myjs.js

}

function cs_turn_carousel(){
	//put the links inbetween <li> tags
	$c = get_option('count') ;
	if (!empty($c)) {
		wp_enqueue_script('carouseljs', plugin_dir_url(__FILE__) . 'carousel.js', array('jquery'), '1.0', true);
	?>
    <div id="enlarged"></div>
	<div id="carousel">
    <?php		
		//if ($i > 0) {
	?>
		<a href="#prev" class="carousel-prev">&lt;</a>
	<?php
		//} //end prev arrow
	?>
        	<!--<ul style="width: <?php //echo $c * 100; ?>%;"> -->
            <ul>
	<?php
	//need the count of each type
	$ic = get_option('icount') ;
	
	//echo "icount: " . $ic . "<br>";
	$vc = get_option('vcount') ;
	for($q = 0; $q < $ic; $q++){
		$img = "img" . $q ;
		$$img = get_option($img) ;
		$background = (!empty($img)) ? 'url(' . $img . ')' : 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';
		//echo "keys: " . $img . "<br>";
		//$background = $$img ;
		
		//create <li> tag here
		//add bg image as well
	?>
   		<li style="background: <?php echo $background; ?>;">
   			<a class="carousel-link" href="<?php echo $$img ; ?>"><?php echo $$img ; ?></a>
   		</li>
    
	<?php	
	} //end for loop	
		//if ($i > 0) {
	?>
		
	<?php
		//}//end next arrow
	?>
		</ul>
        
        <a href="#next" class="carousel-next">&gt;</a>
		</div>
	<?php
	}//close if empty statement
} //end function

?>
