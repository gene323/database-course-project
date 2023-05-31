<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="../../js/utility.js"></script>
</head>

<body>

	<?php
	include('../navbar.php');
	include('../connection.php');
	session_start();
	if (!isset($_SESSION["username"])) {
		header("location: ../index.php?loginModal=1");
	}


	if (isset($_POST['update'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone_number = $_POST['phone_number'];
		$skill_name = $_POST['skill_name'];
		$serial_number = $_POST['serial_number'];

		$sql = "UPDATE chair SET name='$name', email='$email', phone_number='$phone_number' WHERE ID='T0001'";
		if ($conn->query($sql) === FALSE) {
			echo "Error: " . $sql . "<br/>";
		}
		for ($i = 0; $i < count($skill_name); $i++) {
			$sql = "UPDATE skill SET name='$skill_name[$i]' WHERE serial_number='$serial_number[$i]'";
			if ($conn->query($sql) === FALSE) {
				echo "Error: " . $sql . "<br/>";
			}
		}
	}

	if (isset($_POST['insert'])) {
		$sql = "INSERT INTO skill (name, ID) VALUES('', 'T0001')";
		if ($conn->query($sql) === FALSE) {
			echo "Error: " . $sql . "<br/>";
		}
	}

	if (isset($_POST['delete'])) {
		$serial_number = $_POST['delete'];
		$sql = "DELETE FROM skill WHERE serial_number='$serial_number'";
		if ($conn->query($sql) === FALSE) {
			echo "Error: " . $sql . "<br/>";
		}
	}
	?>


	<!-- fetch data of chair and image-->
	<?php
	$row = $conn->query("SELECT * FROM chair")->fetch_assoc();
	$img_row = $conn->query("SELECT * FROM `image`")->fetch_assoc();
	?>

	<!-- echo info of profile -->
	<div class="text-2xl w-fit h-24 m-auto flex">
		<div class="my-auto"> Change user's profile</div>
	</div>

	<div class="mx-auto w-5/6 max-w-full grid grid-cols-2 overflow-auto">
		<img src="<?php echo "../../img/" . $img_row['file_name'] ?>" alt="avatar" class="h-96 max-h-full justify-self-center" />
		<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>" class="grid grid-cols-3 gap-3">
			<label class="text-right col-start-1" for="name">Name:</label>
			<input type='text' value="<?php echo $row['name']; ?>" id="name" name="name"
				class="col-start-2 bg-slate-200 rounded max-w-full">

			<label class="text-right col-start-1" for="email">Email:</label>
			<input type='mail' value="<?php echo $row['email']; ?>" id="email" name="email"
				class="col-start-2 bg-slate-200 rounded max-w-full">

			<label class="text-right col-start-1" for="phoneNumber">Phone number:</label>
			<input type='text' value="<?php echo $row['phone_number']; ?>" id="phoneNumber" name="phone_number"
				class="col-start-2 bg-slate-200 rounded max-w-full">

			<label class="justify-self-end col-start-1">Expertise:</label>
			<?php
			$res = $conn->query("SELECT skill.name, skill.serial_number FROM chair, skill WHERE chair.ID='T0001'");
			while ($row = $res->fetch_assoc()) {
				?>
				<input type="text" class="col-start-2 bg-slate-200 rounded max-w-full" name="skill_name[]"
					value="<?php echo $row['name'] ?>">
				<input type="number" class="hidden" name="serial_number[]" value="<?php echo $row['serial_number'] ?>">
				<button type="submit" class="col-start-3 w-12 max-w-full rounded-md border shadow shadow-red-300 hover:border-red-400" name="delete"
					value="<?php echo $row['serial_number'] ?>">🗑️</button>
				<?php
			}
			?>

			<button type="submit" name="insert"
				class="col-start-2 w-24 max-w-full justify-self-center rounded-md bg-slate-200 hover:bg-slate-400">new</button>

			<button type="submit" name="update"
				class="col-start-2 max-w-full  bg-blue-200 rounded-md hover:bg-blue-400">Submit</button>
		</form>
	</div>


	<div class="max-w-sm w-fit mx-auto mt-10 bg-sky-200 rounded">
		<form action="../upload/upload.php" method="post" enctype="multipart/form-data"
			class="grid grid-col-1 gap-2 justify-items-center">
			<div class="font-semibold">Select Image File to Upload</div>
			<label for="file"
				class="w-40 text-center shadow-md shadow-sky-600 cursor-pointer bg-white border border-black hover:shadow-none">Choose
				image</label>
			<div class="hidden" id="fileName"></div>
			<input type="file" id="file" name="file" style="display:none;" onchange="(() => {
				let a = document.getElementById('fileName');
				a.style.display = 'block';
				a.innerHTML = this.files[0].name;
			})()">
			<button type="submit" name="submit"
				class="bg-blue-400 w-40 rounded-md font-semibold hover:bg-blue-500">Upload</button>
		</form>

		<?php
		$conn->close();
		?>
	</div>

</body>

</html>