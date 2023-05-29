<?php
include('../connection.php');
session_start();

if (!isset($_SESSION['username'])) {
	header("location: ../login.php");
}

if (isset($_POST['update_conference_proceeding'])) {
	$id = $_POST['ID'];
	$author = $_POST['author'];
	$title = $_POST['title'];
	$conference = $_POST['conference'];
	$page = $_POST['page'];
	$date = $_POST['date'];
	$place = $_POST['place'];
	$sql = "UPDATE conference_proceeding
			SET author='$author', title='$title', conference='$conference',  page='$page', date='$date', place='$place'
			WHERE ID='$id' ";

	if ($conn->query($sql) === FALSE) {
		?>
		<script>
			alert("error")
		</script>
		<?php
	}

}

if (isset($_POST['insert_conference_proceeding'])) {
	$author = $_POST['author'];
	$title = $_POST['title'];
	$date = $_POST['date'];
	$page = $_POST['page'];
	$conference = $_POST['conference'];
	$place = $_POST['place'];
	$sql = "INSERT INTO `conference_proceeding`
			(author, title, conference, date, page, place)
			VALUES('$author', '$title', '$conference' ,'$date', '$page', '$place')";
	if ($conn->query($sql) === TRUE) {

	} else {
		echo "error" . "<br/>";
	}
}

if (isset($_POST['delete_conference_proceeding'])) {
	$id = $_POST['ID'];
	$sql = "DELETE FROM conference_proceeding WHERE ID='$id'";
	if ($conn->query($sql) === FALSE) {
		echo "error";
	}
}

header('location: ../edit/conference-proceeding.php');
?>