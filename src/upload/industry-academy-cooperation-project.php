<?php
include('../connection.php');
session_start();

if (!isset($_SESSION['username'])) {
	header("location: ../login.php");
}

if (isset($_POST['update'])) {
	$ID = $_POST['ID'];
	$title = $_POST['title'];
	$date_begin = $_POST['date_begin'];
	$date_end = $_POST['date_end'];
	$position = $_POST['position'];
	$sql = "UPDATE industry_academy_cooperation_project
			SET title='$title', date_begin='$date_begin', date_end='$date_end', position='$position'
			WHERE ID='$ID' ";

	if ($conn->query($sql) === FALSE) {
		?>
		<script>
			alert("update error. perhaps ISBN is duplicated")
		</script>
		<?php
	}
}

if (isset($_POST['insert'])) {
	$title = $_POST['title'];
	$date_begin = $_POST['date_begin'];
	$date_end = $_POST['date_end'];
	$position = $_POST['position'];
	$sql = "INSERT INTO industry_academy_cooperation_project
			(title, date_begin, date_end, position)
			VALUES('$title', '$date_begin', '$date_end', '$position')";
	if ($conn->query($sql) === FALSE) {
		?>
		<script>
			alert("insert error. perhaps ISBN is duplicated")
		</script>
		<?php
	}
}

if (isset($_POST['delete'])) {
	$ID = $_POST['ID'];
	$sql = "DELETE FROM industry_academy_cooperation_project WHERE ID='$ID'";
	if ($conn->query($sql) === FALSE) {
		?>
		<script>
			alert("delete error")
		</script>
		<?php
	}
}

header("location: ../edit/industry-academy-cooperation-project.php");
?>