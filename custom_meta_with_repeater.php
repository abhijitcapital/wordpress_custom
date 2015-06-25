<?php
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
        
       
            update_post_meta( $post->ID, 'section_title', $_POST['section_title'] );

            update_post_meta( $post->ID, 'individualepisode_title', $_POST['individualepisode_title'] );
            update_post_meta( $post->ID, 'individualepisode_summery', $_POST['individualepisode_summery'] );
            update_post_meta( $post->ID, 'individualepisode_video_id', $_POST['individualepisode_video_id'] );
            update_post_meta( $post->ID, 'individualepisode_img', $_POST['individualepisode_img'] );

      

       

    }

} 
/*==================== Js file =================================*/
?>

<script>
jQuery(document).ready(function(){

/* show page episode meta box */
    var slnumloc, 
               individualepisodehtml = '<tr class="individualepisode-repeaterRow"><td class="individualepisode-repeater_sl"></td><td><p><input class="code" name="individualepisode_img[]" type="hidden" value="" /><input class="upload_image_button button-secondary" type="button" value="Upload Image"/></p><div class="show_upload_image"><img src="" style="max-width:100px;" /></div></td><td><input class="code" type="text" name="individualepisode_title[]" required value="" /></td><td><textarea class="code" name="individualepisode_summery[]"></textarea></td><td><input class="code" type="text" name="individualepisode_video_id[]" required value="" /></td><td><a href="" class="individualepisode-deleteWidget">Delete</a></td></tr>';

             //add row
        jQuery('a.individualepisode-add-another-img').on('click',function(e){
            e.preventDefault();         
            slnumloc = jQuery('body .individualepisode-repeater-table').find('.individualepisode-repeaterRow');
            jQuery('.individualepisode-repeater-table').append( individualepisodehtml ); //add new row
            jQuery('body .individualepisode-repeater-table tr:last').find('.individualepisode-repeater_sl').text( slnumloc.length ); //repeater sl no

        });

        //delete row
        jQuery('body').on('click', 'a.individualepisode-deleteWidget', function(e){
            e.preventDefault();
            jQuery(this).closest('tr').remove();
            return false;
        });
});
</script>


















});