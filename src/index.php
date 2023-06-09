<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lee's website</title>
	<link href="../dist/output.css" rel="stylesheet">
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"
		integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script>
		$(document).ready(() => {
			const name = document.getElementById("chairName");
			let i = 1;
			name.addEventListener('click', () => {
				if (++i > 5) {
					document.getElementById('loginModal').style.display = 'block';
				}
			})

			const modal = document.getElementById('loginModal');
			modal.addEventListener('click', (event) => {
				if (event.target === document.getElementById('loginModal')) {
					document.getElementById('loginModal').style.display = 'none';
					i = 0;
				}
			}, false);

			const urlParams = new URLSearchParams(window.location.search);
			if (urlParams.get('loginModal') == 1) {
				document.getElementById('loginModal').style.display = 'block';
			}
			if (urlParams.get('loginFail') == 1) {
				document.getElementById('wrongHint').style.display = 'block';
			}
		});
	</script>
</head>

<body>

	<?php
	include("connection.php");
	session_start();
	session_unset();
	if (isset($_POST['username'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$username = stripcslashes($username);
		$password = stripcslashes($password);
		$username = $conn->real_escape_string($username);
		$password = $conn->real_escape_string($password);

		$sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
		$res = $conn->query($sql);
		$row = $res->fetch_assoc();
		$count = $res->num_rows;

		if ($count == 1) {
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			header("refresh:0.2 url=edit/profile.php");
		} else {
			header("location: index.php?loginModal=1&loginFail=1");
		}
	}

	?>

	<!-- header -->
	<div class="bg-blue-200 w-full h-10">
		<span class="text-3xl absolute left-[15%]">
			帥哥個人網頁
		</span>
	</div>

	<?php
	// Include the database configuration file
	// Get images from the database
	$res = $conn->query("SELECT * FROM image");

	if ($res->num_rows > 0) {
		$row = $res->fetch_assoc();
		$imageURL = '../img/' . $row["file_name"];
		?>

		<!-- image and information of chair -->
		<div class="grid grid-cols-2 content-center mx-auto max-h-full w-4/5 mt-20 mb-10">
			<img src="<?php echo $imageURL; ?>" alt=""
				class="w-3/5 place-self-center col-span-1 rounded shadow-2xl shadow-black" />
			<?php
	} else { ?>
			<div class="flex h-[500rem]">
				<img src="../img/default.jpg" alt="" class="w-[400rem] my-auto" />
			</div>
			<?php
	}

	$res = $conn->query("SELECT * FROM chair");
	$chair_row = $res->fetch_assoc();
	?>
		<div class="grid grid-cols-1 gap-y-5">
			<div class="text-3xl" id="chairName">
				<?php echo $chair_row['name'] ?>
			</div>
			<div class=" ">
				<a href="mailto:<?php echo $chair_row['email'] ?>" class="text-xl">✉️ <?php echo $chair_row['email'] ?></a>
			</div>
			<div class="">
				<?php echo '☎️ ' . $chair_row['phone_number'] ?>
			</div>

			<div class="">
				<div class="text-2xl font-semibold">專長</div>
				<?php
				$res = $conn->query("SELECT skill.name FROM `skill`, `chair` WHERE chair.ID='T0001'");
				while ($skill_row = $res->fetch_assoc()) {
					echo "<div class='m-2'>" . "✔" . $skill_row['name'] . "</div>";
				}
				?>
			</div>
		</div>
	</div>


	<!-- chair's set -->
	<div class="grid grid-cols-2 w-4/5 mx-auto gap-3">
		<!-- body -->

		<div class="row-start-1 col-start-1 text-2xl">Paper</div>
		<div
			class="grid grid-cols-1 content-start max-h-96 h-96 overflow-auto rounded-md bg-slate-200 border-8 border-slate-200 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:'none'] [scrollbar-width:'none']">
			<?php
			$res = $conn->query("SELECT * FROM journal_article");
			$i = 1;
			while ($paper_row = $res->fetch_assoc()) {
				?>
				<div class="w-full h-28 bg-white rounded-md mb-1 overflow-auto text-lg">
					<?php echo $i . '. ' ?>
					<?php echo $paper_row['author'] . ',' ?>
					<b class="text-blue-500">
						<?php echo '"' . $paper_row['title'] . '"'; ?>
					</b>
					<i>
						<?php echo ', ' . $paper_row['organization'] . ', ' ?>
					</i>
					<?php echo 'vol.' . $paper_row['volume'] . ', '; ?>
					<?php echo 'no.' . $paper_row['number'] . ', '; ?>
					<?php echo 'pp.' . $paper_row['page'] . ', '; ?>
					<?php $t = strtotime($paper_row['date']);
					echo date('Y-m', $t);
					?>
				</div>
				<?php
				$i++;
			}
			?>
		</div>

		<div class="row-start-1 col-start-2 text-2xl">conference proceedings</div>
		<div
			class="grid grid-cols-1 content-start max-h-96 h-96 overflow-auto rounded-md bg-slate-200 border-8 border-slate-200 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:'none'] [scrollbar-width:'none']">
			<?php
			$res = $conn->query("SELECT * FROM conference_proceeding");
			$i = 1;
			while ($cp_row = $res->fetch_assoc()) {
				?>
				<div class="w-full h-28 bg-white rounded-md mb-1 overflow-auto text-lg">
					<?php echo $i . '. ' ?>
					<?php echo $cp_row['author'] . ', ' ?>
					<b class="text-blue-500">
						<?php echo '"' . $cp_row['title'] . '"' ?>
					</b>
					<?php echo ', ' . $cp_row['conference'] . ', ' ?>
					<?php $t = strtotime($cp_row['date']);
					echo date('Y-m', $t) . ', '; ?>
					<?php echo 'pp. ' . $cp_row['page'] . ', ' ?>
					<?php echo $cp_row['place'] . ', ' ?>
				</div>
				<?php
				$i++;
			}
			?>
		</div>

		<div class="row-start-3 col-start-1 text-2xl mt-5">industry academy cooperation project</div>
		<div
			class="grid grid-cols-1 content-start max-h-96 h-96 overflow-auto rounded-md bg-slate-200 border-8 border-slate-200 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:'none'] [scrollbar-width:'none']">
			<?php
			$res = $conn->query("SELECT * FROM industry_academy_cooperation_project");
			$i = 1;
			while ($iacp_row = $res->fetch_assoc()) {
				?>
				<div class="w-full h-28 bg-white rounded-md mb-1 overflow-auto text-lg">
					<?php echo $i . '. ' ?>
					<?php echo $iacp_row['title'] . ', '; ?>
					<?php $t = strtotime($iacp_row['date_begin']);
					echo date('Y-m', $t) . ', '; ?>
					<?php $t = strtotime($iacp_row['date_end']);
					echo date('Y-m', $t) . ', '; ?>
					<?php echo $iacp_row['position']; ?>
				</div>
				<?php
				$i++;
			}
			?>
		</div>

		<div class="row-start-3 col-start-2 text-2xl mt-5">NSTC project</div>
		<div
			class="grid grid-cols-1 content-start max-h-96 h-96 overflow-auto rounded-md bg-slate-200 border-8 border-slate-200 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:'none'] [scrollbar-width:'none']">
			<?php
			$res = $conn->query("SELECT * FROM nstc_project");
			$i = 1;
			while ($nstc_row = $res->fetch_assoc()) {
				?>
				<div class="w-full h-28 bg-white rounded-md mb-1 overflow-auto text-lg">
					<?php echo $i . '. ' ?>
					<b class="text-blue-500">
						<?php echo $nstc_row['title'] . ', '; ?>
					</b>
					<?php $t = strtotime($nstc_row['date_begin']);
					echo date('Y-m', $t) . ', '; ?>
					<?php $t = strtotime($nstc_row['date_end']);
					echo date('Y-m', $t) . ', '; ?>
					<?php echo $nstc_row['code'] . ', '; ?>
					<?php echo $nstc_row['position']; ?>
				</div>
				<?php
				$i++;
			}
			?>
		</div>

		<div class="row-start-5 col-start-1 text-2xl mt-5">literature</div>
		<div
			class="row-start-6 grid grid-cols-1 content-start max-h-96 h-96 overflow-auto rounded-md bg-slate-200 border-8 border-slate-200 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:'none'] [scrollbar-width:'none']">
			<?php
			$res = $conn->query("SELECT * FROM literature");
			$i = 1;
			while ($literature_row = $res->fetch_assoc()) {
				?>
				<div class="w-full h-28 bg-white rounded-md mb-1 overflow-auto text-lg">
					<?php echo $literature_row['publishing_house'] . ', ' ?>
					<?php echo $literature_row['title'] . ', ' ?>
					<?php echo $literature_row['author'] . ', ' ?>
					<?php echo $literature_row['ISBN'] . ', ' ?>
					<?php echo $literature_row['date']; ?>
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<div class="w-full h-full hidden fixed left-0 top-0 z-10 bg-black bg-opacity-70" id="loginModal">
		<form class="bg-white shadow-md rounded relative px-8 pt-6 pb-8 mb-4 w-96 m-auto top-1/3" id="loginForm"
			method="POST" action="<?=$_SERVER['PHP_SELF'] ?>">
			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="username">
					Username
				</label>
				<input
					class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
					id="username" name="username" type="text" placeholder="Username">
			</div>
			<div class="mb-6">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="password">
					Password
				</label>
				<input
					class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
					id="password" name="password" type="password" placeholder="******">
			</div>
			<div class="hidden text-red-500 text-center font-semibold mb-6" id="wrongHint">
				Wrong username or password
			</div>
			<div class="flex items-center justify-between">
				<input
					class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
					type="submit" value="Sign In">
				<a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
					href="https://youtu.be/pEg_d2f6myw">
					Forgot Password?
				</a>
			</div>
		</form>
	</div>

	<!-- footer -->
	<div class="w-full h-10 bg-blue-200 mt-5 text-center">
		&copy;2023 Feng Chia University. All rights reserved.
	</div>

	<?php
	$conn->close();
	?>

</body>

</html>