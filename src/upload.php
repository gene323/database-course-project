<?php
// Include the database configuration file
include('connection.php');
$statusMsg = '';

// File upload path
$targetDir = "../img/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
	// Allow certain file formats
	$allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
	if (in_array($fileType, $allowTypes)) {
		// Upload file to server
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
			// Insert image file name into database
			$filename = $_FILES['file']['name'];
			$res = $conn->query("UPDATE `image` SET file_name='$filename', uploaded_on=NOW() WHERE ID='1' ");
			if ($res) {
				$statusMsg = "The file " . $fileName . " has been uploaded successfully.";
			} else {
				$statusMsg = "File upload failed, please try again.";
			}
		} else {
			$statusMsg = "Sorry, there was an error uploading your file.";
		}
	} else {
		$statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
	}
} else {
	$statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
echo 'the site will redirect in 0.5s';
header('refresh:0.5 url=edit/profile.php');
?>