<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){

	$('.alerts').delay(2000).fadeOut('slow');

	$('#upload_form').submit(function(){
		
		$('.alert_info').css({display:'block'});
	});
});
</script>
<link href="css/advimage.css" rel="stylesheet" type="text/css" />
<?php
require('config.php');

if(isset($_POST['submit'])){
	include ('class.upload.php');
	
	// params : thumb path, resized path, original path(deletes after session), image quality(0-100)
	$imgUpload = new imgUpload(
		IMG_PATH."/".substr(THUMB_DIR,1), 
		IMG_PATH."/", 
		IMG_PATH_TEMP, 
		IMAGE_QUALITY
	);
	// params : thumb width, resized width
	$imgUpload->imgSize(
		DEFAULT_THUMB_WIDTH, 
		$_POST['img_width']
	);
	
	$image = $imgUpload->re;
	@unlink(IMG_PATH_TEMP.$image); 
	echo '<div class=\'alerts alert_ok\'>Upload is complete!</div>';
}
?>
<div class="alerts alert_info" style="display:none">Uploading.. please wait!</div>

<form action="upload.php" id="upload_form" method="post" name="dirSelector" enctype="multipart/form-data">
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>Select Image</td>
			<td><input type="file" name="vImage" id="vImage" /></td>
		</tr>
		<tr>
			<td>Image Width (px)</td>
			<td><input type="text" name="img_width" style="width:50px" id="img_width" value="<?php echo DEFAULT_IMG_WIDTH; ?>" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" id="submit" name="submit" value="Upload" /></td>
		</tr>
	</table>
</form>

<div class="info">
	<?php echo UPLOAD_INFO; ?>
</div>