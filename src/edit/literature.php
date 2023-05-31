<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit literature</title>
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
		<a href="#"><img src="../img/up-arrow-svgrepo-com.svg" alt="up arrow svg" width="50px" /></a>
	</div>

	<!-- insert modal button -->
	<div class="flex justify-center mt-5">
		<button type="button" onclick="toggleInsertModal()" id="insertBtn"
			class="w-72 h-8 bg-blue-300 hover:bg-blue-400">
			Insert a new literature
		</button>
	</div>

	<!-- fetch data of literatures -->
	<?PHP
	$sql = "SELECT * FROM literature";
	$res = $conn->query($sql);
	$i = 1;
	?>

	<!-- echo info of literature -->
	<div class="mt-5 w-1/2 mx-auto">
		<?php
		while ($row = $res->fetch_assoc()) {
			?>

			<!-- body -->
			<div class="flex w-full h-28 gap-1">
				<div class="w-full bg-slate-200 mb-1 overflow-auto rounded-md">
					<?php echo $i . '. ' ?>
					<?php echo 'ISBN: ' . $row['ISBN'] . ',' ?>
					<?php echo $row['author'] . ',' ?>
					<b class="text-blue-500">
						<?php echo '"' . $row['title'] . '"'; ?>
					</b>
					<?php echo ', 出版社: ' . $row['publishing_house'] . ', ' ?>
					<?php $t = strtotime($row['date']);
					echo date('Y-m-d', $t); ?>
				</div>
				<button class="bg-blue-200 rounded-md w-12 h-[90%] my-auto hover:bg-blue-400"
					onclick="toggleLiterature('<?php echo $row['ISBN'] ?>', '<?php echo $row['author'] ?>','<?php echo $row['title'] ?>','<?php echo $row['date'] ?>','<?php echo $row['publishing_house'] ?>')">
					Edit
				</button>
				<button type="submit"
					onclick="deleteRecord('../upload/literature.php', 'delete', '<?php echo $row['ISBN'] ?>')"
					class="bg-red-300 rounded-md w-12 h-[90%] my-auto hover:bg-red-400" id="deleteBtn">
					Delete
				</button>
			</div>
			<?php
			$i++;
		}
		?>
	</div>

	<!-- edit literature modal -->
	<div id="editModal" class="hidden h-screen w-full fixed top-0 left-0 bg-black bg-opacity-50">
		<div class="bg-white relative h-80 w-2/3 rounded-md mx-auto top-10">
			<!-- header -->
			<div class="bg-blue-100 w-full flex rounded-t-md">
				<div class="text-2xl mx-auto">
					Update literature
				</div>
			</div>
			<!-- body -->
			<form method="post" action="../upload/literature.php"
				class="grid grid-cols-3 gap-5 grid-flow-row lg:grid-cols-3">

				<button type="button" class="w-[30px] h-[30px] bg-blue-300 rounded-full absolute right-1 top-1 hover:bg-blue-400"
					onclick="toggleLiterature()">X</button>

				<div class="col-span-full mt-2">
					<label>Author: <input type="text" id="editAuthor" name="author" value=""
							class="border border-black"> </label>
				</div>
				<div class="col-span-full">
					<label>Title: <input type="text" id="editTitle" name="title" value=""
							class="border border-black w-5/6"> </label>
				</div>

				<div class="col-span-full" >
					<label>Publishing House: <input type="text" id="editPublishingHouse" name="publishing_house"
							value="" class="border border-black">
					</label>
				</div>

				<div>
					<label>ISBN: <input type="text" id="editNewISBN" name="new_ISBN" value="" class="border border-black">
					</label>
				</div>

				<div>
					<label>Date: <input type="date" id="editDate" name="date" value="" class="border border-black">
					</label>
				</div>

				<input class="hidden" type="text" id="editOldISBN" name="old_ISBN" value="">

				<button type="submit" name="update"
					class="row-start-5 col-start-2 bg-blue-200 hover:bg-blue-400">Submit</button>
			</form>
		</div>
	</div>


	<!-- insert literature modal -->
	<div id="insertModal" class="hidden h-screen w-full fixed top-0 left-0 bg-black bg-opacity-50">
		<div class="bg-white relative h-80 w-2/3 rounded-md mx-auto top-10">
			<!-- header -->
			<div class="bg-blue-100 rounded-t-md flex w-full">
				<div class="text-2xl mx-auto">
					Insert a literature
				</div>
			</div>
			<!-- body -->
			<form method="post" action="../upload/literature.php"
				class="grid grid-cols-3 gap-5 grid-flow-row lg:grid-cols-3">

				<button type="button" class="w-[30px] h-[30px] bg-blue-300 rounded-full absolute right-1 top-1 hover:bg-blue-400"
					onclick="toggleInsertModal()">X</button>

				<div class="col-span-full mt-2">
					<label>Author: <input type="text" name="author" class="border border-black"> </label>
				</div>

				<div class="col-span-full">
					<label>Title: <input type="text" name="title" class="border border-black w-5/6"> </label>
				</div>

				<div class="col-span-full">
					<label>Publishing house: <input type="text" name="publishing_house" class="border border-black"> </label>
				</div>

				<div class="">
					<label>ISBN: <input type="text" name="ISBN" class="border border-black w-5/6" required> </label>
				</div>

				<div class="">
					<label>Date: <input type="date" name="date" class="border border-black"> </label>
				</div>

				<button type="submit" name="insert"
					class="row-start-5 col-start-2 justify-self-stretch bg-blue-200 hover:bg-blue-400">
					insert
				</button>
			</form>
		</div>
	</div>

	<?php
	$conn->close();
	?>
</body>