<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

// Define a destination
$targetFolder = '/uploads'; // Relative to the root

if ( !empty($_FILES) && isset($_FILES["file"]) ) {
	//validate the image size
	if( $_FILES['file']['size'] <17000){
		$tempFile = $_FILES['file']['tmp_name'];
		$targetPath = $_SERVER['DOCUMENT_ROOT']."/dropzone/" . $targetFolder;
		$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file']['name'];

		// Validate the file type
		$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
		$fileParts = pathinfo($_FILES['file']['name']);

		if (in_array($fileParts['extension'],$fileTypes)) {
			move_uploaded_file($tempFile,$targetFile);
			echo 'imagen subida correctamente!';
		}
		else {
			echo 'Tipo de imagen no valido';
		}
	}
	else{
		echo "la imagen es muy pesada";
	}
}
else{
	echo "Image wasn't received";
}

?>