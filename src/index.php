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
			const el = document.getElementById("chairName");
			let i = 0;
			el.addEventListener('click', () => {
				if (++i > 9) {
					window.location.href = "login.php";
				}
			})
		});
	</script>
</head>

<body>
	<!-- header -->
	<div class="bg-blue-300 w-full h-10">
		<span class="text-3xl absolute left-[15%]">
			帥哥個人網頁
		</span>
	</div>

	<?php
	include("connection.php");
	session_start();
	session_unset();
	// Include the database configuration file
	// Get images from the database
	$res = $conn->query("SELECT * FROM image");

	if ($res->num_rows > 0) {
		$row = $res->fetch_assoc();
		$imageURL = '../img/' . $row["file_name"];
		?>

		<!-- image and information of chair -->
		<div class="grid grid-cols-2 content-center mx-auto max-h-full w-4/5 mt-20 mb-10">
			<img src="<?php echo $imageURL; ?>" alt="" class="w-[400px] col-span-1 rounded-full shadow-2xl shadow-black" />
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

		<div class="row-start-3 col-start-1 text-2xl">industry academy cooperation project</div>
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

		<div class="row-start-3 col-start-2 text-2xl">NSTC project</div>
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

		<div class="row-start-5 col-start-1 text-2xl">literature</div>
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


	<?php
	$conn->close();
	?>

</body>

</html>