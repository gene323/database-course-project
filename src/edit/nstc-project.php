<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit NSTC project</title>
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
			Insert a new NSTC project
		</button>
	</div>

	<!-- fetch data of NSTC projects -->
	<?PHP
	$sql = "SELECT * FROM nstc_project";
	$res = $conn->query($sql);
	$i = 1;
	?>

	<!-- echo info of NSTC projects -->
	<div class="mt-5 w-1/2 mx-auto">
		<?php
		while ($row = $res->fetch_assoc()) {
			?>

			<!-- body -->
			<div class="flex w-full h-28 gap-1">
				<div class="w-full bg-slate-200 mb-1 overflow-auto rounded-md">
					<?php echo $i . '. ' ?>
					<?php echo $row['title'] . ', ' ?>
					<?php $t = strtotime($row['date_begin']);
					echo date('Y-m', $t) . ', '; ?>
					<?php $t = strtotime($row['date_end']);
					echo date('Y-m', $t) . ', '; ?>
					<?php echo $row['code'] . ', ' ?>
					<?php echo $row['position']; ?>
				</div>
				<button class="bg-blue-200 rounded-md w-12 h-[90%] my-auto hover:bg-blue-400"
					onclick="toggleNSTCProject('<?php echo $row['ID'] ?>', '<?php echo $row['title'] ?>', '<?php echo $row['date_begin'] ?>', '<?php echo $row['date_end'] ?>', '<?php echo $row['code'] ?>', '<?php echo $row['position'] ?>')">
					Edit
				</button>
				<button type="submit"
					onclick="deleteRecord('../upload/nstc-project.php', 'delete', '<?php echo $row['ID'] ?>')"
					class="bg-red-300 rounded-md w-12 h-[90%] my-auto hover:bg-red-400" id="deleteBtn">
					Delete
				</button>
			</div>
			<?php
			$i++;
		}
		?>
	</div>

	<!-- edit NSTC project modal -->
	<div id="editModal" class="hidden h-screen w-full fixed top-0 left-0 bg-black bg-opacity-50">
		<div class="bg-white relative h-80 w-2/3 rounded-md mx-auto top-10">
			<!-- header -->
			<div class="bg-blue-100 w-full flex rounded-t-md">
				<div class="text-2xl mx-auto">
					Update NSTC project
				</div>
			</div>
			<!-- body -->
			<form method="post" action="../upload/nstc-project.php" 
				class="grid grid-cols-3 gap-5 grid-flow-row lg:grid-cols-3">

				<button type="button" class="w-[30px] h-[30px] bg-blue-300 rounded-full absolute right-1 top-1 hover:bg-blue-400"
					onclick="toggleNSTCProject()">X</button>

				<div class="col-span-full mt-2">
					<label>Title: <input type="text" id="editTitle" name="title" value=""
							class="border border-black w-5/6"> </label>
				</div>

				<div class="col-span-full">
					<label>Code: <input type="text" id="editCode" name="code" value="" class="border border-black w-5/6">
					</label>
				</div>

				<div>
					<label>From: <input type="date" id="editDateBegin" name="date_begin" value="" class="border border-black">
					</label>
				</div>

				<div>
					<label>To: <input type="date" id="editDateEnd" name="date_end" value="" class="border border-black">
					</label>
				</div>


				<div>
					<label>Position: <input type="text" id="editPosition" name="position" value="" class="border border-black">
					</label>
				</div>

				<input class="hidden" type="text" id="editID" name="ID" value="">

				<button type="submit" name="update"
					class="row-start-4 col-start-2 bg-blue-200 hover:bg-blue-400">Submit</button>
			</form>
		</div>
	</div>


	<!-- insert NSTC project modal -->
	<div id="insertModal" class="hidden h-screen w-full fixed top-0 left-0 bg-black bg-opacity-50">
		<div class="bg-white relative h-80 w-2/3 rounded-md mx-auto top-10">
			<!-- header -->
			<div class="bg-blue-100 rounded-t-md flex w-full">
				<div class="text-2xl mx-auto">
					Insert a NSTC project
				</div>
			</div>
			<!-- body -->
			<form method="post" action="../upload/nstc-project.php"
				class="grid grid-cols-3 gap-5 grid-flow-row lg:grid-cols-3">

				<button type="button" class="w-[30px] h-[30px] bg-blue-300 rounded-full absolute right-1 top-1 hover:bg-blue-400"
					onclick="toggleInsertModal()">X</button>

				<div class="col-span-full mt-2">
					<label>Title: <input type="text" name="title" class="border border-black w-5/6"> </label>
				</div>

				<div class="col-span-full">
					<label>Code: <input type="text" name="code" class="border border-black w-5/6"> </label>
				</div>

				<div>
					<label>From: <input type="date" name="date_begin" class="border border-black"> </label>
				</div>

				<div>
					<label>To: <input type="date" name="date_end" class="border border-black"> </label>
				</div>


				<div>
					<label>Position: <input type="text" name="position" class="border border-black"> </label>
				</div>

				<button type="submit" name="insert"
					class="row-start-4 col-start-2 justify-self-stretch bg-blue-200 hover:bg-blue-400">
					insert
				</button>
			</form>
		</div>
	</div>

	<?php
	$conn->close();
	?>
</body>