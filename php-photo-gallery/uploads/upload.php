<?php

// In an application, this could be moved to a config file
$upload_errors = array(
	// http://www.php.net/manual/en/features.file-upload.errors.php
	UPLOAD_ERR_OK 				=> "No errors.",
	UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
  UPLOAD_ERR_NO_FILE 		=> "No file.",
  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
);
$error = $_FILES['file_upload']['error'];
$message = $upload_errors[$error];


if(isset($_POST['submit'])){
  // process the form data
  $tmp_file = $_FILES['file_upload']['tmp_name'];
  $target_file = basename($_FILES['file_upload']['name']);
  $upload_dir = "/media/sf_sandbox/php-photo-gallery/uploads";


if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)){
  $message = "File uploaded successfully";
}else{
    $error = $_FILES['file_upload']['error'];
    $message = $upload_errors[$errors];
}
}
echo "<pre>";
print_r($_FILES['file_upload']);
echo "</pre>";
echo "<hr>";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
  <head>
    <title>Upload</title>
  </head>
  <body>
    <?php if(!empty($message)) {echo "<p>{$message}</p>";} ?>
<form action="upload.php" enctype="multipart/form-data" method="POST">
  <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
  <input type="file" name="file_upload" />
  <input type="submit" name="submit" value="Upload" />
</form>
  </body>
</html>
