<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit journal article</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="../../js/utility.js"></script>
</head>

<body>
	<script>
		window.onscroll = () => { toggleTopImg() };
	</script>

	<?php
	include('../navbar.php');
	include('../connection.php');
	session_start();
	if (!isset($_SESSION["username"])) {
		header("location: ../index.php?loginModal=1");
	}
	?>

	<!-- back to top button -->
	<div class="fixed bottom-2 right-5 hidden" id="backToTop">
		<a href="#"><img src="../img/up-arrow-svgrepo-com.svg" alt="up arrow svg" width="50px"></a>
	</div>

	<!-- insert modal button -->
	<div class="flex justify-center mt-5">
		<button type="button" onclick="toggleInsertModal()" id="insertBtn"
			class="w-72 h-8 bg-blue-300 hover:bg-blue-400">
			Insert a new journal article
		</button>
	</div>

	<!-- fetch data of journal articles -->
	<?PHP
	$sql = "SELECT * FROM journal_article";
	$res = $conn->query($sql);
	$i = 1;
	?>

	<!-- echo info of journal articles -->
	<div class="mt-5 w-1/2 mx-auto">
		<?php
		while ($row = $res->fetch_assoc()) {
			?>

			<!-- journal article body -->
			<div class="flex w-full h-28 gap-1">
				<div class="w-full bg-slate-200 mb-1 overflow-auto rounded-md">
					<?php echo $i . '. ' ?>
					<?php echo $row['author'] . ',' ?>
					<b class="text-blue-500">
						<?php echo '"' . $row['title'] . '"'; ?>
					</b>
					<i>
						<?php echo ', ' . $row['organization'] . ', ' ?>
					</i>
					<?php echo 'vol.' . $row['volume'] . ', '; ?>
					<?php echo 'no.' . $row['number'] . ', '; ?>
					<?php echo 'pp.' . $row['page'] . ', '; ?>
					<?php $t = strtotime($row['date']);
					echo date('Y-m', $t); ?>
				</div>
				<button class="bg-blue-200 rounded-md w-12 h-[90%] my-auto hover:bg-blue-400"
					onclick="toggleJournalArticle('<?php echo $row['ID'] ?>', '<?php echo $row['author'] ?>', '<?php echo $row['title'] ?>', '<?php echo $row['volume'] ?>', '<?php echo $row['number'] ?>', '<?php echo $row['page'] ?>', '<?php echo $row['date'] ?>', '<?php echo $row['organization'] ?>')">
					Edit
				</button>
				<button name="delete_paper" type="submit"
					onclick="deleteRecord('../upload/journal-article.php', 'delete_paper', '<?php echo $row['ID'] ?>')"
					class="bg-red-300 rounded-md w-12 h-[90%] my-auto hover:bg-red-400" id="deleteBtn">
					Delete
				</button>
			</div>
			<?php
			$i++;
		}
		?>
	</div>

	<!-- edit journal article modal -->
	<div id="editModal" class="hidden h-screen w-full fixed top-0 left-0 bg-black bg-opacity-50">
		<div class="bg-white relative h-80 w-2/3 rounded-md mx-auto top-10">
			<!-- header -->
			<div class="bg-blue-100 w-full flex rounded-t-md">
				<div class="text-2xl mx-auto">
					Update journal article
				</div>
			</div>
			<!-- body -->
			<form method="post" action="../upload/journal-article.php"
				class="grid grid-cols-3 gap-5 grid-flow-row lg:grid-cols-3">

				<button type="button" class="w-[30px] h-[30px] bg-blue-300 rounded-full absolute right-1 top-1 hover:bg-blue-400"
					onclick="toggleJournalArticle()">X</button>

				<div class="col-span-full mt-2">
					<label>Author: <input type="text" id="editAuthor" name="author" value=""
							class="border border-black w-5/6"> </label>
				</div>
				<div class="col-span-full">
					<label>title: <input type="text" id="editTitle" name="title" value=""
							class="border border-black w-5/6"> </label>
				</div>

				<div class="col-span-full">
					<label>organization: <input type="text" id="editOrganization" name="organization" value=""
							class="border border-black w-5/6"> </label>
				</div>

				<div class="">
					<label>Volume: <input type="number" id="editVolume" name="volume" value=""
							class="border border-black"> </label>
				</div>
				<div class="">
					<label>Number: <input type="number" id="editNumber" name="number" value=""
							class="border border-black"> </label>
				</div>
				<div class="">
					<label>Page: <input type="text" id="editPage" name="page" value="" class="border border-black">
					</label>
				</div>
				<div>
					<label>Date: <input type="date" id="editDate" name="date" value="" class="border border-black">
					</label>
				</div>

				<input class="hidden" type="text" name="ID" id="editID" value="">

				<button type="submit" name="update_paper"
					class="row-start-6 col-start-2 justify-self-stretch bg-blue-200 hover:bg-blue-400">
					Submit
				</button>
			</form>
		</div>
	</div>


	<!-- insert journal article modal -->
	<div id="insertModal" class="hidden h-screen w-full fixed top-0 left-0 bg-black bg-opacity-50">
		<div class="bg-white relative h-80 w-2/3 rounded-md mx-auto top-10">
			<!-- header -->
			<div class="bg-blue-100 rounded-t-md flex w-full">
				<div class="text-2xl mx-auto">
					Insert a joural article
				</div>
			</div>
			<!-- body -->
			<form method="post" action="../upload/journal-article.php"
				class="grid grid-cols-3 gap-5 grid-flow-row lg:grid-cols-3">

				<button type="button" class="w-[30px] h-[30px] bg-blue-300 rounded-full absolute right-1 top-1 hover:bg-blue-400"
					onclick="toggleInsertModal()">X</button>

				<div class="col-span-full mt-2">
					<label>Author: <input type="text" name="author" class="border border-black w-5/6"> </label>
				</div>

				<div class="col-span-full">
					<label>Title: <input type="text" name="title" class="border border-black w-5/6"> </label>
				</div>

				<div class="col-span-full">
					<label>Organization: <input type="text" name="organization" class="border border-black w-5/6"> </label>
				</div>

				<div>
					<label>Volume: <input type="number" name="volume" class="border border-black"> </label>
				</div>

				<div>
					<label>Number: <input type="number" name="number" class="border border-black"> </label>
				</div>

				<div>
					<label>Page: <input type="text" name="page" class="border border-black"> </label>
				</div>

				<div class="">
					<label>Date: <input type="date" name="date" class="border border-black"> </label>
				</div>

				<button type="submit" name="insert_paper"
					class="row-start-6 col-start-2 justify-self-stretch bg-blue-200 hover:bg-blue-400">
					insert
				</button>
			</form>
		</div>
	</div>

	<?php
	$conn->close();
	?>
</body>