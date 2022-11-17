<?php

class imgUpload{
	/**
	* Image upload and resize class
	*
	* Author		: Kim Sandvold
    * Modified      : TeckniX
	* Created		: 04.04.2009
	* Updated		: 14.12.2011
	* Requirements	: GD library, php 5 >
	*
	* The imgUpload class handles up to three images to upload.
	* Supported file types are jpg, png and gif. Also support for 
	* png's alpha channel.
    *
    * http://downloads.sourceforge.net/project/tinymceimageupl/ 
	*/

	public $re;	
	public $defaultTh = 100;
	public $defaultRe = 500;
	public $defaultQuality = 80;

	public function __construct($thumb, $resized, $orig, $scale){
	
		$this->pathThumb = $thumb;
		$this->pathResized = $resized;
		$this->pathOrig = $orig;
		$this->imgQuality = ($scale != null) ? $scale: $this->defaultQuality; 
	}

	public function imgSize($thumbSize, $reSized){
	
		$this->sizeTh = ($thumbSize == null) ? $this->defaultTh : $thumbSize;
		$this->sizeRe = ($reSized == null) ? $this->defaultRe : $reSized;
		$this->engine();
	}

	private function filename(){
            
        $imagefile_name = ereg_replace(" |,|#","_",$_FILES['vImage']['name']);
        $imagefile_type = substr($imagefile_name, strrpos($imagefile_name,".")+1, strlen($imagefile_name)-strrpos($imagefile_name,"."));
        $imagefile_name = substr($imagefile_name, 0, strrpos($imagefile_name,"."));
		$suffix = "_".date('dmy_His');
		$this->imgName = $imagefile_name.$suffix.'.'.$imagefile_type;
	}

	private function engine(){
	
		$this->filename();
		
        $source = $_FILES['vImage']['tmp_name'];
		$image_size = $_FILES['vImage']['size'];
		$image_type = $_FILES['vImage']['type'];
		
        $target = $this->pathOrig.$this->imgName;
        move_uploaded_file($source, $target);
              
        $imagepath = $this->imgName; 
        $file = $this->pathOrig . $imagepath;
        $save = $this->pathResized . $imagepath;
        $this->CreateImage($file, $save, "", $this->sizeRe, $image_type);
        
        $save = $this->pathThumb. $imagepath;
        $this->CreateImage($file, $save, "1:1", $this->sizeTh, $image_type);
		
		$this->resize($imagepath);
	}

	private function resize($imagepath){
	
		return $this->re = $imagepath;
	}
    
    /**
     * Image Resize function
     * Usage: CreateImage('/path/to/file_name.png', '/path/to/save_file.png', '1:1', '600x');
     * 
     */
    
    function CreateImage($image, $destination, $crop = null, $size = null, $ext) {
        $image = ImageCreateFromString(file_get_contents($image));
    
        if (is_resource($image) === true) {
            $x = 0;
            $y = 0;
            $width = imagesx($image);
            $height = imagesy($image);
    
            /*
            CROP (Aspect Ratio) Section
            */
    
            if (is_null($crop) === true) {
                $crop = array($width, $height);
            } else {
                $crop = array_filter(explode(':', $crop));
    
                if (empty($crop) === true) {
                        $crop = array($width, $height);
                } else {
                    if ((empty($crop[0]) === true) || (is_numeric($crop[0]) === false)) {
                            $crop[0] = $crop[1];
                    } else if ((empty($crop[1]) === true) || (is_numeric($crop[1]) === false)) {
                            $crop[1] = $crop[0];
                    }
                }
    
                $ratio = array(0 => $width / $height, 1 => $crop[0] / $crop[1]);
    
                if ($ratio[0] > $ratio[1]) {
                    $width = $height * $ratio[1];
                    $x = (imagesx($image) - $width) / 2;
                }
    
                else if ($ratio[0] < $ratio[1]) {
                    $height = $width / $ratio[1];
                    $y = (imagesy($image) - $height) / 2;
                }
    
            }
    
            /*
            Resize Section
            */
    
            if (is_null($size) === true) {
                $size = array($width, $height);
            }else {
                $size = array_filter(explode('x', $size));
                if (empty($size) === true || (isset($size[0]) && $size[0] > imagesx($image)) || (isset($size[1]) && $size[1] > imagesy($image))) {
                        $size = array(imagesx($image), imagesy($image));
                } else {
                    if ((empty($size[0]) === true) || (is_numeric($size[0]) === false)) {
                        $size[0] = round($size[1] * $width / $height);
                    } else if ((empty($size[1]) === true) || (is_numeric($size[1]) === false)) {
                        $size[1] = round($size[0] * $height / $width);
                    }
                }
            }

            $imgresult = ImageCreateTrueColor($size[0], $size[1]);
            if (is_resource($imgresult) === true) {
                if($ext==="image/png"){
                ImageAlphaBlending($imgresult, false);
                ImageCopyResampled($imgresult, $image, 0, 0, $x, $y, $size[0], $size[1], $width, $height);
            
                 ImageSaveAlpha($imgresult, true);
                 imagepng($imgresult, $destination, 9);
             
                ImageDestroy($imgresult);
                chmod($destination, 0666);
                return true;
                }else if($ext==="image/gif"){
                $trnprt_indx = imagecolortransparent($image);
			
                // If we have a specific transparent color
			    if ($trnprt_indx >= 0) {
				    // Get the original image's transparent color's RGB values
				    $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
				    // Allocate the same color in the new image resource
				    $trnprt_indx    = imagecolorallocate($imgresult, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);				
				    // Completely fill the background of the new image with allocated color.
				    imagefill($imgresult, 0, 0, $trnprt_indx);				
				    // Set the background color for new image to transparent
				    imagecolortransparent($imgresult, $trnprt_indx);
                
                    ImageCopyResampled($imgresult, $image, 0, 0, $x, $y, $size[0], $size[1], $width, $height);
            
                    imagegif($imgresult, $destination);
             
                    ImageDestroy($imgresult);
                    chmod($destination, 0666);
                    return true;}
                }else{
                ImageSaveAlpha($imgresult, true);
                ImageAlphaBlending($imgresult, true);
                ImageFill($imgresult, 0, 0, ImageColorAllocate($imgresult, 255, 255, 255));
                ImageCopyResampled($imgresult, $image, 0, 0, $x, $y, $size[0], $size[1], $width, $height);
            
                ImageInterlace($imgresult, true);
                ImageJPEG($imgresult, $destination, $this->imgQuality);
                ImageDestroy($imgresult);
                chmod($destination, 0666);
                return true;
                }
            }
        }
        return false;
    }
}
?>
