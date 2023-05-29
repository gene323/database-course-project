<?php 
include('../connection.php');
session_start();

if (!isset($_SESSION['username'])) {
	header("location: ../login.php");
}

if (isset($_POST['update'])) {
	$old_ISBN = $_POST['old_ISBN'];
	$new_ISBN = $_POST['new_ISBN'];
	$author = $_POST['author'];
	$title = $_POST['title'];
	$date = $_POST['date'];
	$publishing_house = $_POST['publishing_house'];
	$sql = "UPDATE literature
			SET ISBN='$new_ISBN', author='$author', title='$title', date='$date', publishing_house='$publishing_house'
			WHERE ISBN='$old_ISBN' ";

	if ($conn->query($sql) === FALSE) {
		?>
		<script>
			alert("update error. perhaps ISBN is duplicated")
		</script>
		<?php
	}
}

if (isset($_POST['insert'])) {
	$ISBN = $_POST['ISBN'];
	$author = $_POST['author'];
	$title = $_POST['title'];
	$publishing_house = $_POST['publishing_house'];
	$date = $_POST['date'];
	$sql = "INSERT INTO literature
			(ISBN, author, title, date, publishing_house)
			VALUES('$ISBN', '$author','$title','$date', '$publishing_house')";
	if ($conn->query($sql) === FALSE) {
		?>
		<script>
			alert("insert error. perhaps ISBN is duplicated")
		</script>
		<?php
	}
}

if (isset($_POST['delete'])) {
	$ISBN = $_POST['ID'];
	$sql = "DELETE FROM literature WHERE ISBN='$ISBN'";
	if ($conn->query($sql) === FALSE) {
		?>
		<script>
			alert("delete error")
		</script>
		<?php
	}
}

header("location: ../edit/literature.php");
?>