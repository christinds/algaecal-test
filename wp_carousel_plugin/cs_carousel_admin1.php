<?php
//Exit if accessed directly
if (!defined('ABSPATH')){
	exit ;
}
?>

<div id="wrap">

<?php

if(isset($_POST['submit_check'])) {
	//URLs 
	//echo "<h1>URL form submitted!!<h1>" ;
	/*$all_options = wp_load_alloptions() ;
	$my_options = array() ;
	
	foreach($all_options as $name => $value){
		$my_options[$name] = $value ;
	}
	
	print_r($my_options) ;*/
	
	$icount = $_POST['imagetotal'] ;
	//echo "total images: " . $icount . "<br>" ;
	update_option('icount', $icount) ;
	
	$vcount = $_POST['videototal'] ;
	update_option('vcount', $vcount) ;
	//$o = 0 ;
	foreach($_POST as $key => $value){	
	//echo $key ." => ". $value . "<br>" ;	
		//$count_all++ ;
		if(stristr($key, 'img')){
			//echo "Value from _POST: " . $value . "<br>" ;
			update_option($key, $value) ;
			//echo $o++ . "<br>" ;
			//$opt = 'img' . $count ;
			//echo "Value from get_option: " . get_option($key) ;
		}elseif (stristr($key, 'vid')){
			update_option($key, $value) ;
			//$vcount++;
		}else{}
		
	}
	
	$count = $vcount + $icount ;
	
	update_option('count', $count) ;
	$c = get_option('count') ; 	
	$ic = get_option('icount') ;
	//echo "ic: ". $ic  . "<br>" ;
	
	?>
	<div class="updated">
        <p><strong><?php _e('Options saved.' ); ?></strong></p>
    </div>
        
<?php
}elseif($_POST['cs_carousel_hidden'] == 'Y') {
	
	//echo "carousel not very well hidden! <br>" ;

        //JS form created
?>		
		<!-- form -->
		<!--<p id="paraform">
        	In paraform <br>
        		<p id="images_urls">
        			In images paragraph <br>
        		</p>
        		<p id="videos_urls">
        			In videos paragraph <br>
        		</p>
        		<p id="sub_urls"></p>
        </p>-->
        <!-- end form -->
        
       <!-- <div class="updated">
        <p><strong><?php //_e('Options saved.' ); ?></strong></p>
        </div>
        </div>  end wrap div -->
  
<?php      
	
}else{
	//original/UNsubmitted page

?>
	<h2>Test for AlgaeCal</h2>
     
    <form name="cs_carousel_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" />
        <input type="hidden" name="cs_carousel_hidden" value="Y" />
       <h3>How many images would you like to add?</h3> <input type="text" id="imagetotal" /><br>
       <h3>How many videos would you like to add?</h3> <input type="text" id="videototal" /><br>
        <hr />  
       <!-- <p class="submit">-->
       <input type="button" name="createboxes" id="createboxes" value="Create Boxes" onclick="addboxes()" /> <br>
       <!-- <input type="submit" value="Test Button" id="submit" onclick="addboxes()" /> -->
       <!-- </p> -->
    </form>
    </div> <!-- end wrap div -->
<?php	
}//end else

?>