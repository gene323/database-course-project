<?php
include('../connection.php');
session_start();

if (!isset($_SESSION['username'])) {
	header("location: ../login.php");
}

if (isset($_POST['update_paper'])) {
	$id = $_POST['ID'];
	$author = $_POST['author'];
	$title = $_POST['title'];
	$volume = $_POST['volume'];
	$number = $_POST['number'];
	$page = $_POST['page'];
	$date = $_POST['date'];
	$organization = $_POST['organization'];
	$sql = "UPDATE journal_article
			SET author='$author', title='$title', volume='$volume', number='$number', page='$page', date='$date', organization='$organization'
			WHERE ID='$id' ";

	if ($conn->query($sql) === FALSE) {
		?>
		<script>
			alert("error")
		</script>
		<?php
	}
}

if (isset($_POST['insert_paper'])) {
	$id = $_POST['ID'];
	$author = $_POST['author'];
	$title = $_POST['title'];
	$date = $_POST['date'];
	$volume = $_POST['volume'];
	$number = $_POST['number'];
	$page = $_POST['page'];
	$organization = $_POST['organization'];
	$sql = "INSERT INTO `journal_article`
			(ID, author, title, date, volume, number, page, organization)
			VALUES('$id', '$author', '$title', '$date', '$volume', '$number', '$page', '$organization')";
	if ($conn->query($sql) === TRUE) {

	} else {
		echo "error" . "<br/>";
	}
	$_POST = array();
}

if (isset($_POST['delete_paper'])) {
	$id = $_POST['ID'];
	$sql = "DELETE FROM journal_article WHERE ID='$id'";
	if ($conn->query($sql) === FALSE) {
		echo "error";
	}
}

header("location: ../edit/journal-article.php");
?>