<?php
/**
 * HoneyBadger functions and definitions
 *
 * @package HoneyBadger Abhijit test
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}
remove_filter ('the_content', 'wpautop'); 

add_action('admin_init', 'loadjs');
function loadjs() {
      wp_enqueue_script("CNdevadminCommon", get_template_directory_uri()."/js/adminCommon.js", false, "1.0");
}

//import metabox js
function functions_access() {
   wp_register_script('cpt_js_script', get_bloginfo("template_url").'/js/meta-box.js', array('jquery'), '', true);
   wp_enqueue_script('cpt_js_script');
}
add_action('admin_enqueue_scripts', 'functions_access');



add_theme_support('post-thumbnails');
if ( ! function_exists( 'HoneyBadger_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function HoneyBadger_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on HoneyBadger, use a find and replace
	 * to change 'HoneyBadger' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'HoneyBadger', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'HoneyBadger' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'HoneyBadger_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // HoneyBadger_setup
add_action( 'after_setup_theme', 'HoneyBadger_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function HoneyBadger_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'HoneyBadger' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'HoneyBadger_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function HoneyBadger_scripts() {

	//          //
	//  STYLES  //
	//          //

	// Reset to clear User Agent Styles & Load _s Basic Styles
	/*wp_register_style( 'reset', get_template_directory_uri() . '/css/HoneyBadger.css' );
	wp_enqueue_style('reset');*/

	// Load Webflow > Normalize > css
	wp_register_style( 'wf-normalize', get_template_directory_uri() . '/css/wf-normalize.css' );
	wp_enqueue_style('wf-normalize');
	
	// Load Webflow > Main > css 
	wp_register_style( 'webflow', get_template_directory_uri() . '/css/webflow.css' );
	wp_enqueue_style('webflow');
	
	// Load Webflow > Site > css
	wp_register_style( 'road-to-ruins.webflow', get_template_directory_uri() . '/css/road-to-ruins.webflow.css' );
	wp_enqueue_style('road-to-ruins.webflow');

	// Superfish > css
	wp_register_style( 'superfish', get_template_directory_uri() . '/css/superfish.css' );
	//wp_enqueue_style('superfish');

	// HoneyBadger > Theme > Stylesheet ("End All" Stylesheet)
	wp_register_style( 'HoneyBadger-style', get_stylesheet_uri() );
	wp_enqueue_style('HoneyBadger-style');
	
	//           //
	//  SCRIPTS  //
	//           //

	wp_register_script( 'site-tracking', get_template_directory_uri() . '/js/site-tracking.js', array(), '1.0', false );

	//wp_enqueue_script( 'site-tracking' ); //uncomment this when adding analytics.

	// Load jQuery...straight from WP
	wp_enqueue_script( 'jquery' );

	// Load Webflow's Required jQuery Version (1.11.1) > jQuery 1.11.1 > js
	wp_register_script( 'jquery-wf', get_template_directory_uri() . '/js/jquery-wf.js', array(), '1.11.1', true );
	wp_enqueue_script('jquery-wf');

	// Load Webflow > Main > js
	wp_register_script( 'webflowjs', get_template_directory_uri() . '/js/webflow.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('webflowjs');

	// Skip Link Focus Fix
	wp_register_script( 'HoneyBadger-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script('HoneyBadger-skip-link-focus-fix');

	// Navigation > HoneyBadger
	wp_register_script( 'HoneyBadger-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script('HoneyBadger-navigation');

	// Superfish > js
	wp_register_script( 'superfishjs', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '1.0.0', true );
	//wp_enqueue_script('superfishjs');

	// Superfish > HoneyBadger > js
	wp_register_script( 'superfish-HoneyBadger', get_template_directory_uri() . '/js/superfish-HoneyBadger.js', array('jquery'), '1.0.0', true );
	//wp_enqueue_script('superfish-HoneyBadger');

	// Threaded Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//
	// Alright, let's get IE8 up to speed along with out-of-date client browsers
	//

	// Let's check for IE8 and enqueue respond.js NOTE: html5shiv is already loaded within modernizr.js above
	if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 8' ) ) {
		// Load respond.js
		wp_enqueue_script( 'respondjs', get_template_directory_uri() . '/js/respond.min.js', array(), '1.0.0', true );
	}

	// Modernizr (detect and 'modinize' older non-supportive browsers)
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script("CNdevadminCommon", get_template_directory_uri()."/js/customjs.js", false, "1.0");

}
add_action( 'wp_enqueue_scripts', 'HoneyBadger_scripts' );


/**
 *
 * Declaration for WooCommerce Support
 *
**/
/*function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );*/

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/************************/
/*   Add Breadcrumbs    */
/************************/
function the_breadcrumbs() {
    global $post;
    echo '<ul id="breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo '</a></li><li class="separator">&#8250;</li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li class="separator">&#8250;</li><li> ');
            if (is_single()) {
                echo '</li><li class="separator">&#8250;</li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator">&#8250;</li>';
                }
                echo $output;
                echo '<title="'.$title.'"> '.$title.' ';
            } else {
                echo '<li>'.get_the_title().'</li>';
            }
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
}


//post ajax function call at time of load more cick
function posts_ajax_func() {
		$nopost = 4; //no of posts
		$post_type = $_POST['post_type']; //post type
		$category = intval($_POST['category']); //post category id
		$start_value = $_POST['start_val']; //start value
		
		if($category != '' )
		{
			$arg = array('post_type'=>$post_type, 'numberposts'=>-1, 'category'=>$category, 'post_status'=>'publish');
		}
		else{
			$arg = array('post_type'=>$post_type, 'numberposts'=>-1, 'post_status'=>'publish');
		}	
		$myposts = get_posts($arg); //get all posts from the post type
		
		$start_index = $start_value; //start index of testimonial array
		$end_index = ( $start_index + $nopost ) - 1; //end index of testimonial array
		?>
		

	<?php
		for($i=0; $i<$nopost; $i++,$start_index++) {
			if( !empty($myposts[$start_index]->ID) ) {
		

	?>			
	<!--========================= Single post start ======================== -->
	        		<div class="blog_box">

	        			<div class="w-col w-col-3 w-col-stack col _0-5-0-5">
					          <a class="w-inline-block post-div-link-block" href="<?php echo get_permalink( $myposts[$start_index]->ID ); ?>">
					            <div class="post-div">
					              <div class="w-clearfix post-details-div">
					                <div class="post-details category">
					                		<?php if($category != '' ){
					                			echo get_cat_name($category);
													}else{
															$post_categories = get_the_category($myposts[$start_index]->ID);                
                                                        	$output_cat = '';
	                                                        if($post_categories){
	                                                            foreach($post_categories as $post_categories_single) {
	                                                                $output_cat = $post_categories_single->name ;
	                                                                break;
	                                                            }
                                                        
                                                        	}

                                                        		echo $output_cat;
														}?>
					                </div>
					                <div class="post-details date"><?php echo get_the_time( 'm/d/Y', $myposts[$start_index]->ID ); ?></div>
					              </div>					             

					              <?php $post_thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id($myposts[$start_index]->ID) );
		         						if(get_the_post_thumbnail($myposts[$start_index]->ID))
		                                { ?>
		                            		<img class="featured-image-thumb" src="<?php echo $post_thumbnail_url;?>" alt="<?php echo get_the_title($myposts[$start_index]->ID)?>">
		                            	<?php }else{ ?>

		              						<img class="featured-image-thumb" src="<?php echo get_template_directory_uri(); ?>/images/no_product_img.jpg" alt="<?php echo get_the_title($myposts[$start_index]->ID)?>">
		              					<?php } ?> 

					              <p class="post-blurb"> 
					              			<span class="post_listing_title"><?php echo $myposts[$start_index]->post_title;?></span>
					              <?php echo get_the_popular_excerpt($myposts[$start_index]->post_content,100);?></p><a class="button read-more" href="<?php echo get_permalink( $myposts[$start_index]->ID ); ?>">read more</a>
					            </div>
					          </a>
        				</div>			
					</div>
			<!--========================= Single post end ======================== -->	
<?php
			 				
		}
	} ?>

<?php
	die();
}
// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_posts_ajax_func', 'posts_ajax_func' );
add_action( 'wp_ajax_posts_ajax_func', 'posts_ajax_func' );


// Cut post content 
function get_the_popular_excerpt($str_content, $word_count){
		$excerpt = $str_content;
		$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
		$excerpt = strip_shortcodes($excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt = substr($excerpt, 0, $word_count);
		$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
		$excerpt = $excerpt.' &nbsp;...';
		return $excerpt;
}


// Add meta box for Show page start

add_action( 'add_meta_boxes', 'createshowpageMetabox' );
function createshowpageMetabox() {
	global $post;
	if( $post->ID == 10 || $post->ID == 6 )
	{
		add_meta_box( 'show_advanced', 'Featured Video Section', 'showpageMetabox', 'page', 'normal', 'high' );
	}
	if( $post->ID == 8)
	{
		add_meta_box( 'show_advanced', 'Missions Meta Box', 'missionpageMetabox', 'page', 'normal', 'high' );
	}

	if($post->ID == 10)
	{
		add_meta_box( 'show_advanced12', 'Episodes Section', 'showEpisodesMetabox', 'page', 'normal', 'high' );
	}
		
}

function showpageMetabox( $post ) {
	global $post;
    $vimeo_video_id = get_post_meta( $post->ID, 'vimeo_video_id', true );  
    $vimeo_video_img = get_post_meta( $post->ID, 'vimeo_video_img', true );

?>
			<table class='repeaterTable form-table'>		
				<tr class='form-field'>
					<th scope="row"> <label for="artistimg"> Vimeo Video ID:</label> </th>
					<td> 
					
					<input type="text" name="vimeo_video_id" id="vimeo_video_id" value="<?php echo $vimeo_video_id;?>">

					</td>							
				</tr>
				<tr>
					<th scope="row"> <label for="artistimg">Vimeo Video Image:</label> </th>
					<td>
						<p>
						<input class="code" name="vimeo_video_img" id="vimeo_video_img" type="text" value="<?php echo $vimeo_video_img;?>" />
		                <input class="upload_image_button button-secondary" type="button" value="<?php echo empty($vimeo_video_img)?'Upload Image':'Change Image';?>"/>
						</p>

						<div class="show_upload_image">
							<?php echo !empty($vimeo_video_img)? '<img src="'.$vimeo_video_img.'" style="max-width:200px;" />':'';?>
						</div>									

					</td>
				</tr>
			</table>

<?php } 

/*======================= Mission Page meta box start ======================================*/

function missionpageMetabox( $post ) {
global $post;
    $archeologist_1_name = get_post_meta( $post->ID, 'archeologist_1_name', true );  
    $archeologist_1_twitter = get_post_meta( $post->ID, 'archeologist_1_twitter', true );
    $archeologist_1_bio = get_post_meta( $post->ID, 'archeologist_1_bio', true );
    $archeologist_1_image = get_post_meta( $post->ID, 'archeologist_1_image', true );


    $archeologist_2_name = get_post_meta( $post->ID, 'archeologist_2_name', true );  
    $archeologist_2_twitter = get_post_meta( $post->ID, 'archeologist_2_twitter', true );
    $archeologist_2_bio = get_post_meta( $post->ID, 'archeologist_2_bio', true );
    $archeologist_2_image = get_post_meta( $post->ID, 'archeologist_2_image', true );


?>

			<table class='repeaterTable form-table'>		
				<tr class='form-field'>
					<th scope="row"> <label for="artistimg"> Archeologist #1 Name:</label> </th>
					<td>					
					<input type="text" name="archeologist_1_name" id="archeologist_1_name" value="<?php echo $archeologist_1_name;?>">
					</td>							
				</tr>

				<tr class='form-field'>
					<th scope="row"> <label for="artistimg"> Archeologist #1 Twitter:</label> </th>
					<td> 					
					<input type="text" name="archeologist_1_twitter" id="archeologist_1_twitter" value="<?php echo $archeologist_1_twitter;?>">
					</td>							
				</tr>

				<tr class='form-field'>
					<th scope="row"> <label for="artistimg"> Archeologist #1 Bio:</label> </th>
					<td>					
					<textarea name="archeologist_1_bio" id="archeologist_1_bio" rows="10" cols="30"><?php echo $archeologist_1_bio;?></textarea>
					</td>							
				</tr>
				<tr>
					<th scope="row"> <label for="artistimg">Archeologist #1 Image:</label> </th>
					<td>
						<p>
						<input class="code" name="archeologist_1_image" id="archeologist_1_image" type="text" value="<?php echo $archeologist_1_image;?>" />
		                <input class="upload_image_button button-secondary" type="button" value="<?php echo empty($archeologist_1_image)?'Upload Image':'Change Image';?>"/>
						</p>

						<div class="show_upload_image">
							<?php echo !empty($archeologist_1_image)? '<img src="'.$archeologist_1_image.'" style="max-width:200px;" />':'';?>
						</div>									

					</td>
				</tr>
				<tr> <td colspan="2"><hr></td></tr>

				<tr class='form-field'>
					<th scope="row"> <label for="artistimg"> Archeologist #2 Name:</label> </th>
					<td>					
					<input type="text" name="archeologist_2_name" id="archeologist_2_name" value="<?php echo $archeologist_2_name;?>">
					</td>							
				</tr>

				<tr class='form-field'>
					<th scope="row"> <label for="artistimg"> Archeologist #2 Twitter:</label> </th>
					<td> 					
					<input type="text" name="archeologist_2_twitter" id="archeologist_2_twitter" value="<?php echo $archeologist_2_twitter;?>">
					</td>							
				</tr>

				<tr class='form-field'>
					<th scope="row"> <label for="artistimg"> Archeologist #2 Bio:</label> </th>
					<td>					
					<textarea name="archeologist_2_bio" id="archeologist_2_bio" rows="10" cols="30"><?php echo $archeologist_2_bio;?></textarea>
					</td>							
				</tr>

				<tr>
					<th scope="row"> <label for="artistimg">Archeologist #2 Image:</label> </th>
					<td>
						<p>
						<input class="code" name="archeologist_2_image" id="archeologist_2_image" type="text" value="<?php echo $archeologist_2_image;?>" />
		                <input class="upload_image_button button-secondary" type="button" value="<?php echo empty($archeologist_2_image)?'Upload Image':'Change Image';?>"/>
						</p>

						<div class="show_upload_image">
							<?php echo !empty($archeologist_2_image)? '<img src="'.$archeologist_2_image.'" style="max-width:200px;" />':'';?>
						</div>									

					</td>
				</tr>
		</table>




<?php }

/*======================= Mission Page meta box end ======================================*/



/* ================ Show page episode meta box ================================*/


function showEpisodesMetabox( $post ) {

	$individualepisode_title_val = get_post_meta( $post->ID, 'individualepisode_title', true );
    $individualepisode_title_repeaterData = get_post_meta( $post->ID, 'individualepisode_title', true );


    $individualepisode_summery = get_post_meta( $post->ID, 'individualepisode_summery', true );
    $individualepisode_video_id = get_post_meta( $post->ID, 'individualepisode_video_id', true );
    $individualepisode_img = get_post_meta( $post->ID, 'individualepisode_img', true );



    $section_title = get_post_meta( $post->ID, 'section_title', true );

	?>
		<style>
			.inside {
				    overflow-x: auto;
				}
		</style>
	    <script type="text/javascript"> 
	    var individualepisode_title_val = '<?php echo $individualepisode_title_val; ?>';    
	    </script>
    <div class="add-images">
        <p><b>Individual Episode Video Section</b></p>

        	<table class='section_title form-table'>		
				<tr class='form-field'>
					<th scope="row"> <label for="artistimg"> Section Title:</label> </th>
					<td> 
					
					<input type="text" name="section_title" id="section_title" required value="<?php echo $section_title;?>">

					</td>							
				</tr>
			</table>
        <p><a href="" class="individualepisode-add-another-img">Add Row</a></p>
        <table class="individualepisode-repeater-table form-table">
            <tr class="individualepisode-repeaterRow">
                <th>Sl</th>
                <th>Image</th>
                <th>Episode Title</th>
                <th>Episode Summary</th>
                <th>Vimeo Video Id</th>
                <th>Action</th>
            </tr>

        <?php
                if( !empty($individualepisode_title_repeaterData) ) {
                    $i = 1; $j=0;
                    foreach($individualepisode_title_repeaterData as $individualepisode_title_single) {
            ?>
                        <tr class="individualepisode-repeaterRow">
                            <td class="individualepisode-repeater_sl"><?php echo $i; ?></td>

                             <td>
                                <p><input class="code" name="individualepisode_img[]" type="hidden" value="<?php echo $individualepisode_img[$j]; ?>" />
                                    
                                    <input class="upload_image_button button-secondary" type="button" value="<?php echo empty($individualepisode_img[$j])?'Upload Image':'Change Image';?>"/>
                                </p>                               

                                <div class="show_upload_image">
									<?php echo !empty($individualepisode_img[$j])? '<img src="'.$individualepisode_img[$j].'" style="max-width:100px;" />':'';?>
								</div>

                            </td>

                            <td><input class="code" type="text" name="individualepisode_title[]" required value="<?php echo $individualepisode_title_single; ?>" /></td>
                            <td><textarea class="code" name="individualepisode_summery[]"><?php echo $individualepisode_summery[$j]; ?></textarea></td>

                            <td><input class="code" type="text" name="individualepisode_video_id[]" required value="<?php echo $individualepisode_video_id[$j];?>" /></td>

                            <td><a href="" class="individualepisode-deleteWidget">Delete</a></td>
                        </tr>
            <?php
                        $i++;
                        $j++;
                    }
                } 
            ?>
        </table>
    </div>


<?php } 

/* ================ Show page episode meta box end ================================*/



add_action( 'save_post', 'saveSliderMetabox' );
function saveSliderMetabox( $post_id ) {
	global $post;	

	if( $_POST ) {
		
		if($post->ID == 10 || $post->ID == 6 )
		{
			update_post_meta( $post->ID, 'vimeo_video_id', $_POST['vimeo_video_id'] );
			update_post_meta( $post->ID, 'vimeo_video_img', $_POST['vimeo_video_img'] );
		}
		if($post->ID == 8)
		{
				update_post_meta( $post->ID, 'archeologist_1_name', $_POST['archeologist_1_name'] );
				update_post_meta( $post->ID, 'archeologist_1_twitter', $_POST['archeologist_1_twitter'] );
				update_post_meta( $post->ID, 'archeologist_1_bio', $_POST['archeologist_1_bio'] );
				update_post_meta( $post->ID, 'archeologist_1_image', $_POST['archeologist_1_image'] );


				update_post_meta( $post->ID, 'archeologist_2_name', $_POST['archeologist_2_name'] );
				update_post_meta( $post->ID, 'archeologist_2_twitter', $_POST['archeologist_2_twitter'] );
				update_post_meta( $post->ID, 'archeologist_2_bio', $_POST['archeologist_2_bio'] );
				update_post_meta( $post->ID, 'archeologist_2_image', $_POST['archeologist_2_image'] );


		}
		if($post->ID == 10)
		{
			update_post_meta( $post->ID, 'section_title', $_POST['section_title'] );

			update_post_meta( $post->ID, 'individualepisode_title', $_POST['individualepisode_title'] );
			update_post_meta( $post->ID, 'individualepisode_summery', $_POST['individualepisode_summery'] );
			update_post_meta( $post->ID, 'individualepisode_video_id', $_POST['individualepisode_video_id'] );
			update_post_meta( $post->ID, 'individualepisode_img', $_POST['individualepisode_img'] );

		}

		if($post->post_type == 'post'){             
            update_post_meta( $post->ID, 'construcimg', $_POST['construcimg'] );
       }

	}

} 

// Add meta box for Show page end


// Custom pagination code 
function pagination($wp_query,$display=true,$ajax=false,$p_cur=1) {

	global $wp_rewrite;

	if($ajax)
		$current=$p_cur;
	else
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$pagination = array(
			'base' => @add_query_arg('page2','%#%'),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'prev_text' => __('«'),
			'next_text' => __('»'),
			'type' => 'list'
		);
		//if( $wp_rewrite->using_permalinks() )
		//$pagination['base'] = user_trinaailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	if(!$display)
		return paginate_links($pagination );
	else
		return paginate_links( $pagination );
}






// Add meta box for post banner images start

add_action( 'add_meta_boxes', 'createpostMetabox' );
function createpostMetabox() {
	global $post;	
	add_meta_box( 'show_advanced', 'Post Banner Meta box', 'construcimgMetabox', 'post', 'normal', 'high' );
}



function construcimgMetabox( $post ) {
    global $post;

    $construcimg = get_post_meta( $post->ID, 'construcimg', true );
    $construcrepeaterData = get_post_meta( $post->ID, 'construcimg', true );
?>
    <script type="text/javascript"> var construcimg = '<?php echo $construcimg; ?>'; </script>
    <div class="add-construc-images">
        <p><a href="" class="add-construc-another-img">Add Image Row</a></p>
        <table class="repeater-construc-table form-table">
            <tr class="repeaterconstrucRow">
                <th>Sl. No.</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
                if( !empty($construcrepeaterData) ) {
                    $i = 1;
                    foreach($construcrepeaterData as $construcrepeater_indi) {
            ?>
                        <tr class="repeaterconstrucRow">
                            <td class="repeater_construc_sl"><?php echo $i; ?></td>
                            <td>
                                <p>
                                    <input class='code' name='construcimg[]' type='hidden' value="<?php echo $construcrepeater_indi; ?>" />
                                    <input class='upload_image_button button-secondary' type='button' value='Upload' />
                                </p>
                                <?php if( !empty($construcrepeater_indi) ) { ?>
                                        <div class='show_upload_image'>
                                            <img src='<?php echo $construcrepeater_indi; ?>' style='max-width:200px;' />
                                        </div>
                                <?php } ?>
                            </td>
                            <td><a href="" class="deleteconstrucWidget">Delete</a></td>
                        </tr>
            <?php
                        $i++;
                    }
                } 
            ?>
        </table>
    </div>

<?php
}
// Add meta box for post banner images end



function my_custom_comment($comment, $args, $depth){
		$GLOBALS['comment'] = $comment; 
		extract($args, EXTR_SKIP);
		//var_dump($comment);die;
		?>
		<div class="w-row rw comment">
		
		<div class="w-col w-col-2 col _0-10-0-0"><div class="w-clearfix user-image-div">
		<img alt="image" src="<?php echo get_template_directory_uri();?>/images/default-image.png" class="user-image">
			<div class="user-name"><?php comment_author( $comment->comment_ID ); ?></div>
		</div>
		</div>
		<div class="w-col w-col-10 col _0-0-0-10">
			<div class="user-comment-div">
				<div class="comment-details">posted by: <b><?php comment_author( $comment->comment_ID ); ?></b> on <?php comment_date( 'm/d/Y ', $comment->comment_ID )?>  at <?php comment_date( 'g : i a', $comment->comment_ID );?></div>
				<p><?php comment_text( $comment->comment_ID );?></p>
				</div>
			</div>
		</div>
        <?php
	}



//Search only post
	function SearchFilter($query) {
	if ($query->is_search) {
	$query->set('post_type', 'post');
	}
	return $query;
	}
	add_filter('pre_get_posts','SearchFilter');