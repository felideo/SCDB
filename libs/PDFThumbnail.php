<?php
namespace Libs;

//https://github.com/spatie/pdf-to-image
class PDFThumbnail {
	public static function creatThumbnail($path_to_pdf){
		$thumb = new \Imagick($path_to_pdf . "[0]");

		// $thumb->setImageBackgroundColor('#ffffff');
		// $thumb->setbackgroundcolor('#ffffff');
		// $thumb->setimagecolorspace('#ffffff');
  //   	$thumb->recolorimage('#ffffff');
		// $thumb->setImageColorspace(0);

  		$thumb->floodFillPaintImage("rgb(255, 0, 255)", 2500, "rgb(255,255,255)", 0 , 0, false);

    	//make fuchsia transparent
    	// $thumb->paintTransparentImage("rgb(255,0,255)", 0, 10);



		$thumb->setimageformat("jpeg");
		$thumb->thumbnailimage(500, 500); // width and height
		$thumb->writeimage('uploads/zzz.jpg');
		$thumb->clear();
		$thumb->destroy();
		exit;
	}
}

