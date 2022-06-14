<?php 
require_once 'functions.php';

if (isset($_POST['img'])) {
	$filename    = $_FILES['file']['name'];
	$allowed_ext = array('jpg', 'png','jpeg');
	$file_ext    = strtolower(end(explode('.', $filename)));
	$file_size   = $_FILES['file']['size'];
	$file_tmp    = $_FILES['file']['tmp_name'];
	if(in_array($file_ext, $allowed_ext) === true){
		// Upload Image to server
		$location    = "img/".$filename;
		move_uploaded_file($file_tmp, $location); 
		$name   = explode('.', $filename);
		$cname  = 'img/'.$name[0].'.webp';
		if ($file_ext=='png') {
			$source = imagecreatefrompng($location);
			# code...
		}elseif ($file_ext=='jpg') {
			$source = @imagecreatefromjpeg($location);
			# code...
		}
		// Save the image
		imagewebp($source, $cname);
		// Free up memory
		imagedestroy($source);
		unlink($location);
		
	} 
	echo '<img src="'.$cname.'" width="100px">';
}


?>

<form action="" method="post" id="formImages" enctype="multipart/form-data">
      <input type="file" name="file" id="file" accept="image/*" />
      <button type="submit" name="img"> UNGGAH</button>
</form>

