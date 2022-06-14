<?php 
function resizeImages($filesave=false, $ext){
    // tentukan ukuran width yang diharapkan
    $width_size = 700;
    // $percent = 0.5;
    // mendapatkan ukuran width dan height dari image
    list( $width, $height ) = getimagesize($filesave);
    if ($ext == 'png') {
	    $source = imagecreatefrompng($filesave);
    	# code...
    }elseif ($ext == 'jpg') {
	    $source = imagecreatefromjpeg($filesave);
    	# code...
    }
    // mendapatkan nilai pembagi supaya ukuran skala image yang dihasilkan sesuai dengan aslinya
    $k = $width / $width_size;
    // menentukan width yang baru
    $newwidth = $width/$k;
    // $newwidth = $width*$percent;
    // menentukan height yang baru
    $newheight = $height/$k;
    // $newheight = $height*$percent;
     
    // fungsi untuk membuat image yang baru
    $thumb  = imagecreatetruecolor($newwidth, $newheight);
    // men-resize image yang baru
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    // menyimpan image yang baru
    $random_image_id = rand();
    $resize_image = $filesave;
    imagewebp($thumb, $filesave+".webp");
    imagedestroy($thumb);

    return $resize_image;
}