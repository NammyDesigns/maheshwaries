<?php 
require('config.php'); 
function get_images(){
        if ($handle = opendir(IMG_PATH_NEW.THUMB_DIR_NEW)) {
		    $images = "";
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					$images .= '<a href="#'.IMG_PATH_LIVE_NEW.$file.'" rel="image_src">';
					$images .= '<img class="thumb_view" src="'.IMG_PATH_LIVE_NEW.THUMB_DIR_NEW.$file.'" />';
					$images .= '</a>';
				}
			}
			closedir($handle);
		}
    if(empty($images)){
        return "No images have been uploaded";
    }else{
	   return $images;
    }
}
?>

<table style="width:100%">
	<tr>
		<td style="vertical-align:top">
			<div id="library_cont">
				<?php echo get_images(); ?>
			    <div style="clear:both"></div>
			</div>
		</td>
	</tr>
</table>
